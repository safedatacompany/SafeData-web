<?php

namespace App\Http\Controllers\System\Settings\Pages;

use Illuminate\Http\Request;
use App\Models\Pages\SocialLink;
use App\Models\Pages\PhoneNumbers;
use App\Http\Controllers\Controller;

class SocialLinkController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', SocialLink::class);

        $links = SocialLink::first();
        $phone_numbers = PhoneNumbers::select('id', 'phone_number')->get();
        return Inertia('System/Settings/Pages/SocialLinks/Index', [
            'links' => $links,
            'phone_numbers' => $phone_numbers,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('viewAny', SocialLink::class);

        $phone_number = $request->validate([
            'phone_number' => 'required|unique:phone_numbers,phone_number',
            'user_id' => 'required|exists:users,id',
        ]);
        PhoneNumbers::create($phone_number);
    }

    public function update(Request $request)
    {
        $this->authorize('viewAny', SocialLink::class);

        $data = $request->validate([
            'facebook'      => 'required|url|max:255',
            'instagram'       => 'required|url|max:1024',
            'telegram'      => 'nullable|url|max:255',
            'email' => 'email|max:255',
        ]);

        $socialLink = SocialLink::first();
        $socialLink->updateOrCreate([], $data);

        return redirect()->back();
    }

    public function updateAllPhones(Request $request)
    {
        $this->authorize('viewAny', SocialLink::class);

        $validated = $request->validate([
            'existing_phones' => 'nullable|array',
            'existing_phones.*.id' => 'required|exists:phone_numbers,id',
            'existing_phones.*.phone_number' => 'required|string|max:255',
            'new_phones' => 'nullable|array',
            'new_phones.*.phone_number' => 'required|string|max:255',
            'new_phones.*.user_id' => 'required|exists:users,id',
        ]);

        // Update existing phone numbers
        if (!empty($validated['existing_phones'])) {
            foreach ($validated['existing_phones'] as $phoneData) {
                $phoneNumber = PhoneNumbers::find($phoneData['id']);
                if ($phoneNumber) {
                    // Check for uniqueness excluding current record
                    $exists = PhoneNumbers::where('phone_number', $phoneData['phone_number'])
                        ->where('id', '!=', $phoneData['id'])
                        ->exists();
                    
                    if (!$exists) {
                        $phoneNumber->update(['phone_number' => $phoneData['phone_number']]);
                    }
                }
            }
        }

        // Create new phone numbers
        if (!empty($validated['new_phones'])) {
            foreach ($validated['new_phones'] as $phoneData) {
                // Check if phone number already exists
                $exists = PhoneNumbers::where('phone_number', $phoneData['phone_number'])->exists();
                if (!$exists) {
                    PhoneNumbers::create($phoneData);
                }
            }
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->authorize('viewAny', SocialLink::class);

        $phoneNumber = PhoneNumbers::findOrFail($id);

        $phoneNumber->delete();

        return redirect()->back();
    }
}
