<?php

namespace App\Http\Controllers\System\Settings\Pages;

use Illuminate\Http\Request;
use App\Models\Pages\SocialLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;


class SocialLinkController extends Controller
{


    /**
     * Display a listing of social links.
     */
    public function index(Request $request)
    {
        $links = SocialLink::first();
        return Inertia('System/Settings/Pages/SocialLinks/Index', [
            'links' => $links,
        ]);
    }



    public function update(Request $request)
    {
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
}
