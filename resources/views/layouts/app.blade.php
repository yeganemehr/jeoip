<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JeoIP</title>
    <meta name="description" content="JeoIP — IP information's Tool">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/assets/favicon/favicon-16x16.png') }}">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <meta name="theme-color" content="#ffffff">

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    @yield('background')

    <main class="layout-main">
        @yield('content')
    </main>

    <footer class="footer">
        <x-footer />
    </footer>
</body>
</html>
