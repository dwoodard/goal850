<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <meta property="og:title" content="Goal850">
        <meta property="og:site_name" content="Goal850">
        <meta property="og:url" content="https://goal850.com">
        <meta property="og:description" content="Monitor, protect, and build your credit — 100% free. Get real-time alerts, full credit reports, and a bonus privacy scan ($20 value) with Goal850. No strings attached. Your credit journey to GOAT status starts here.">
        <meta property="og:type" content="website">
        <meta property="og:image" content="https://goal850.com/images/og/GOAL850-OGBackgrouund.jpeg">

        <title inertia>{{ config('app.name', 'Goal 850') }}</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
