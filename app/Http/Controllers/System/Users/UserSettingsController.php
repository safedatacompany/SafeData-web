<?php

namespace App\Http\Controllers\System\Users;

use App\Http\Controllers\Controller;
use App\Models\System\Users\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingsController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $data = $request->validate([
            'font_scale' => 'required',
            'font_weight' => 'required',
            'theme' => 'required',
            'language_id' => 'required',
            'direction' => 'required',
        ]);

        // Handle different data structures
        $updateData = [
            'language_id' => is_array($data['language_id']) ? $data['language_id']['id'] : $data['language_id'],
            'font_scale' => is_array($data['font_scale']) ? $data['font_scale']['value'] : $data['font_scale'],
            'font_weight' => is_array($data['font_weight']) ? $data['font_weight']['value'] : $data['font_weight'],
            'theme' => is_array($data['theme']) ? $data['theme']['name'] : $data['theme'],
            'direction' => is_array($data['direction']) ? $data['direction']['value'] : $data['direction'],
        ];

        // Update or create user settings
        $settings = UserSettings::where('user_id', $user->id)->first();
        if ($settings) {
            $settings->update($updateData);
        } else {
            UserSettings::create(array_merge($updateData, ['user_id' => $user->id]));
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
