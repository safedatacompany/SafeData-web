<?php

namespace App\Http\Controllers\Profile;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\System\Settings\Settings\Theme;
use App\Models\System\Settings\Settings\FontSize;
use App\Models\System\Settings\Settings\Language;


class ProfileController extends Controller
{
    public function Index()
    {
        return Inertia::render('Profile/Index', [
            'theme' => Theme::query()->select('id', 'name')->get(),
        ]);
    }
}
