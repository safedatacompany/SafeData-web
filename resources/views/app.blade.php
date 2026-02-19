<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <meta name="google-site-verification" content="PL8s3YFl7fsF0kQF30kI1ZFnDMG2UqRWrbP_q5DLS0c" />

    {{-- icon --}}
    <link rel="icon" href="{{ asset('img/logo/full_logo.png') }}" type="image/x-icon" />

    {{-- <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" /> --}}

    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body>
    @routes
    @inertia
</body>

</html>
