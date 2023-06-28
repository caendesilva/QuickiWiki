<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col relative pb-8" x-data="{ sidebarOpen: false }">
            <nav id="navbar" class="absolute w-full h-16 sm:h-8 sm:left-64 sm:w-[calc(100vw_-_16rem)]">
                @include('layouts.navigation')
            </nav>
            <aside id="sidebar" @class(["fixed z-10 w-64 h-screen hidden sm:block", WikiSettings::STICKY_SIDEBAR ? 'sm:fixed' : 'sm:absolute']) :class="{'block': sidebarOpen, 'hidden': ! sidebarOpen}">
                @include('layouts.sidebar')
            </aside>

            <!-- Page Content -->
            <main id="main" class="relative top-8 px-4 sm:px-0 sm:left-64 sm:w-[calc(100vw_-_16rem)] min-h-[calc(100vh_-_2rem)]">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
