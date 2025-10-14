<?php

use App\Http\Controllers\Pages\Frontend\AboutController;
use App\Http\Controllers\Pages\Frontend\AcademicsController;
use App\Http\Controllers\Pages\Frontend\AdmissionController;
use App\Http\Controllers\Pages\Frontend\CalendarController;
use App\Http\Controllers\Pages\Frontend\CampusController;
use App\Http\Controllers\Pages\Frontend\HomeController;
use App\Http\Controllers\Pages\Frontend\NewsController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Route::redirect('/', '/control');

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/admission', [AdmissionController::class, 'index'])->name('admission.index');
Route::get('/academics', [AcademicsController::class, 'index'])->name('academic.index');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/campus', [CampusController::class, 'index'])->name('campus.index');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');

// Route Locale
Route::post('lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    if (in_array($locale, ['en', 'ar', 'ckb']))
        App::setLocale($locale);
})->name('lang');
