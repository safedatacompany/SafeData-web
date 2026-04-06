<?php

use App\Http\Controllers\Pages\Frontend\HomeController;
use App\Models\Pages\Client;
use App\Models\Pages\Hosting;
use App\Models\Pages\PhoneNumbers;
use App\Models\Pages\Product;
use App\Models\Pages\Service;
use App\Models\Pages\SocialLink;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

// Route::redirect('/', '/control');

Route::get('/robots.txt', function () {
    $content = implode(PHP_EOL, [
        'User-agent: *',
        'Allow: /',
        'Disallow: /admin',
        'Disallow: /control',
        'Disallow: /login',
        'Disallow: /register',
        'Disallow: /password',
        'Disallow: /lang',
        '',
        'Sitemap: ' . url('/sitemap.xml'),
    ]) . PHP_EOL;

    return response($content, 200)
        ->header('Content-Type', 'text/plain; charset=UTF-8');
})->name('robots');

Route::get('/sitemap.xml', function () {
    $lastModified = now()->toAtomString();

    try {
        $latestContentUpdatedAt = collect([
            Service::query()->max('updated_at'),
            Product::query()->max('updated_at'),
            Hosting::query()->max('updated_at'),
            Client::query()->max('updated_at'),
            SocialLink::query()->max('updated_at'),
            PhoneNumbers::query()->max('updated_at'),
        ])->filter()->max();

        if ($latestContentUpdatedAt) {
            $lastModified = Carbon::parse($latestContentUpdatedAt)->toAtomString();
        }
    } catch (\Throwable $exception) {
        // Keep default timestamp when DB data is unavailable.
    }

    $urls = [
        [
            'loc' => url('/'),
            'lastmod' => $lastModified,
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ],
        [
            'loc' => url('/en'),
            'lastmod' => $lastModified,
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ],
        [
            'loc' => url('/ar'),
            'lastmod' => $lastModified,
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ],
        [
            'loc' => url('/ckb'),
            'lastmod' => $lastModified,
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ],
    ];

    return response()
        ->view('sitemap', ['urls' => $urls], 200)
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

// Default routes (will use first branch or session branch)
Route::middleware('track.visitors')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/{locale}', [HomeController::class, 'localizedIndex'])
        ->where('locale', 'en|ar|ckb')
        ->name('home.localized');

    Route::post('/send-mail', [HomeController::class, 'sendMail'])
        ->name('send.mail')
        ->middleware('mail.config');
});

// Route Locale
Route::match(['get', 'post'], 'lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    if (in_array($locale, ['en', 'ar', 'ckb'])) {
        App::setLocale($locale);
    }

    return back();
})->name('lang');
