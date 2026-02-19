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

    <body class="font-sans antialiased text-white bg-slate-950 overflow-x-hidden">

        <!-- Background Decoration -->
        <div class="bg-main-decoration fixed inset-0 -z-10">
            <div class="blob top-0 -left-20 w-96 h-96 bg-purple-600/30 absolute rounded-full blur-3xl"></div>
            <div class="blob -bottom-20 -right-20 w-[500px] h-[500px] bg-pink-600/20 absolute rounded-full blur-3xl animation-delay-2000"></div>
            <div class="blob top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-blue-600/10 absolute rounded-full blur-3xl animation-delay-4000"></div>
        </div>

        <div class="flex min-h-screen w-full">

            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-h-screen relative z-10">

                <!-- Navigation (Mobile) -->
                @include('layouts.navigation')

                <!-- Header -->
                @isset($header)
                    <header class="bg-transparent border-b border-white/10 sticky top-0 z-40 backdrop-blur-md">
                        <div class="max-w-6xl mx-auto py-8 px-6 sm:px-8 lg:px-10">
                            <h1 class="text-3xl font-black text-white italic tracking-tighter uppercase drop-shadow-[0_0_10px_rgba(255,255,255,0.2)]">
                                {{ $header }}
                            </h1>
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 py-10 w-full">
                    <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-10 w-full">
                        {{ $slot }}
                    </div>
                </main>

            </div>

        </div>
        
        <!-- Global Notification System -->
        <x-alert />
    </body>
</html>

