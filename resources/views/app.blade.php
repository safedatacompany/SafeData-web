<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    {{-- Primary Meta Tags --}}
    <title>{{ config('app.name', 'Safe Data Company') }}</title>
    <meta name="title" content="{{ config('app.name', 'Safe Data Company') }}" />
    {{-- <meta name="description" content="Safe Data Company – Your trusted partner for data security, software development, web hosting, and IT solutions." /> --}}
    <meta name="author" content="Safe Data Company" />
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="safe data, data security, software development, web hosting, IT services, IT solutions" />
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Theme Color (browser toolbar / PWA) --}}
    <meta name="theme-color" content="#4361ee" />
    <meta name="msapplication-TileColor" content="#4361ee" />

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ config('app.name', 'Safe Data Company') }}" />
    <meta property="og:description" content="Safe Data Company – Your trusted partner for data security, software development, web hosting, and IT solutions." />
    <meta property="og:image" content="{{ asset('img/logo/full_logo.png') }}" />
    <meta property="og:image:alt" content="Safe Data Company Logo" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:site_name" content="{{ config('app.name', 'Safe Data Company') }}" />
    <meta property="og:locale" content="{{ str_replace('-', '_', app()->getLocale()) }}" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:title" content="{{ config('app.name', 'Safe Data Company') }}" />
    <meta name="twitter:description" content="Safe Data Company – Your trusted partner for data security, software development, web hosting, and IT solutions." />
    <meta name="twitter:image" content="{{ asset('img/logo/full_logo.png') }}" />
    <meta name="twitter:image:alt" content="Safe Data Company Logo" />

    {{-- Google Site Verification --}}
    <meta name="google-site-verification" content="PL8s3YFl7fsF0kQF30kI1ZFnDMG2UqRWrbP_q5DLS0c" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('img/logo/full_logo.png') }}" type="image/png" />
    <link rel="apple-touch-icon" href="{{ asset('img/logo/full_logo.png') }}" />

    {{-- Structured Data (JSON-LD) --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ config('app.name', 'Safe Data Company') }}",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('img/logo/full_logo.png') }}",
        "description": "Safe Data Company – Your trusted partner for data security, software development, web hosting, and IT solutions.",
        "sameAs": []
    }
    </script>

    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body>
    @routes
    @inertia
</body>

</html>
