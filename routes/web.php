<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Route::redirect('/', '/control');

// Route Locale
Route::post('lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    if (in_array($locale, ['en', 'ar', 'ckb']))
        App::setLocale($locale);
})->name('lang');
