<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class=''>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia        

        <script 
        src="https://widgets.leadconnectorhq.com/loader.js"  
        data-resources-url="https://widgets.leadconnectorhq.com/chat-widget/loader.js" 
        data-widget-id="6791a86c46f09b3e3cabe181"></script>
    </body>
</html>
