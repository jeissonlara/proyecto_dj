<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Remix Crossover') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-white bg-slate-950 overflow-x-hidden selection:bg-purple-500/30">

    <!-- Background Decoration -->
    <div class="bg-main-decoration fixed inset-0 -z-10">
        <div class="blob top-0 -left-20 w-96 h-96 bg-purple-600/30 absolute rounded-full blur-3xl"></div>
        <div class="blob -bottom-20 -right-20 w-[500px] h-[500px] bg-pink-600/20 absolute rounded-full blur-3xl animation-delay-2000"></div>
        <div class="blob top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-blue-600/10 absolute rounded-full blur-3xl animation-delay-4000"></div>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center px-6">

       <div class="text-5xl sm:text-6xl lg:text-7xl 
         font-black tracking-wide 
         uppercase 
         text-center 
         relative mb-12 px-4">

     <span class="electric-glow">
        REMIX CROSSOVER
     </span>

</div>


        <div class="w-full sm:max-w-2xl lg:max-w-3xl glass-card border-white/20 p-12 rounded-[3rem] shadow-2xl relative overflow-hidden bg-white/5 backdrop-blur-3xl">
            {{ $slot }}
        </div>

        <p class="mt-16 text-xs font-black text-slate-400 uppercase tracking-[0.5em] text-center italic opacity-80">
            Remix Crossover Experience • Professional Sound System Control
        </p>

    </div>

</body>
</html>
