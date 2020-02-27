<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')@hasSection('title') | @endif{{ config('app.name') }} </title>
        <!-- Fonts & Stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-purple-500 text-white">
        @yield('body')
        @include('partials.errors')
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
