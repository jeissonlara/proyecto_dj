<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REMIX CROSSOVER</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <!-- Background -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900 via-fuchsia-900 to-blue-900"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-fuchsia-600/20 via-purple-900/40 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/70"></div>
        <!-- Animated blobs for concert light effect -->
        <div class="absolute top-20 left-10 w-96 h-96 bg-fuchsia-500/30 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-purple-500/30 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-20 left-1/2 w-96 h-96 bg-blue-500/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-10 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="text-white font-bold text-xl tracking-tight">
                REMIX CROSSOVER 
            </div>
            
            @if (Route::has('login'))
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-white hover:text-white/80 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-white/80 transition">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-full font-semibold hover:from-purple-700 hover:to-pink-700 transition">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 sm:px-6">
        <!-- Full-screen Hero Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=2070&auto=format&fit=crop" 
                 alt="DJ Festival Background" 
                 class="w-full h-full object-cover">
            <!-- Dark overlay for text readability -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/80"></div>
        </div>
        
        <div class="text-center max-w-5xl mx-auto relative z-10 w-full">
            <h1 class="text-4xl sm:text-6xl md:text-8xl font-extrabold text-white mb-6 tracking-tight animate-pulse-slow animate-fade-in-out">
                <div class="block sm:inline-block">
                    <span class="inline-block animate-wave" style="animation-delay: 0s">R</span><span class="inline-block animate-wave" style="animation-delay: 0.1s">E</span><span class="inline-block animate-wave" style="animation-delay: 0.2s">M</span><span class="inline-block animate-wave" style="animation-delay: 0.3s">I</span><span class="inline-block animate-wave" style="animation-delay: 0.4s">X</span>
                </div>
                <!-- Line break on mobile only -->
                <span class="inline-block animate-wave" style="animation-delay: 0.5s"> </span>
                <div class="block sm:inline-block">
                    <span class="inline-block animate-wave" style="animation-delay: 0.6s">C</span><span class="inline-block animate-wave" style="animation-delay: 0.7s">R</span><span class="inline-block animate-wave" style="animation-delay: 0.8s">O</span><span class="inline-block animate-wave" style="animation-delay: 0.9s">S</span><span class="inline-block animate-wave" style="animation-delay: 1s">S</span><span class="inline-block animate-wave" style="animation-delay: 1.1s">O</span><span class="inline-block animate-wave" style="animation-delay: 1.2s">V</span><span class="inline-block animate-wave" style="animation-delay: 1.3s">E</span><span class="inline-block animate-wave" style="animation-delay: 1.4s">R</span>
                </div>
                <div class="mt-2 sm:mt-0">
                    <span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 1.5s">E</span><span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 1.6s">X</span><span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 1.7s">P</span><span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 1.8s">E</span><span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 1.9s">R</span><span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 2s">I</span><span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 2.1s">E</span><span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 2.2s">N</span><span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 2.3s">C</span><span class="inline-block animate-wave bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent" style="animation-delay: 2.4s">E</span>
                </div>
            </h1>
            
            <p class="text-lg sm:text-xl md:text-2xl text-white/90 mb-8 md:mb-12 font-light px-4">
                Sonido profesional, iluminación espectacular y la mejor mezcla musical<br class="hidden md:block">
                para bodas, 15 años y eventos corporativos
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto px-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto bg-gradient-to-r from-fuchsia-600 to-purple-600 text-center text-white px-10 py-4 rounded-full text-lg font-bold hover:from-fuchsia-700 hover:to-purple-700 transition transform hover:scale-105 shadow-lg shadow-fuchsia-500/50">
                    RESERVAR AHORA
                </a>
                <a href="#planes" class="w-full sm:w-auto border-2 border-white text-center text-white px-10 py-4 rounded-full text-lg font-bold hover:bg-white/10 transition">
                    VER PLANES
                </a>
            </div>
        </div>
    </div>

    <!-- Plans Section -->
    <section id="planes" class="relative z-10 py-12 md:py-20 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-6xl font-bold text-white mb-4">
                    Nuestros <span class="bg-gradient-to-r from-fuchsia-400 to-purple-400 bg-clip-text text-transparent">Planes</span>
                </h2>
                <p class="text-base md:text-lg text-white/70">Elige el paquete perfecto para tu evento</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $planes = \App\Models\Plan::with('equipos')->get();
                @endphp

                @foreach($planes as $plan)
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 md:p-8 border border-white/20 hover:border-fuchsia-500/50 transition-all hover:transform hover:scale-105 flex flex-col h-full">
                    <!-- Image Placeholder -->
                    <div class="mb-6 rounded-xl overflow-hidden bg-white/5 border border-white/10">
                        @if($plan->imagen)
                            <img src="{{ asset('storage/' . $plan->imagen) }}" alt="{{ $plan->nombre }}" class="w-full h-40 md:h-48 object-cover">
                        @else
                            <div class="w-full h-40 md:h-48 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <h3 class="text-xl md:text-2xl font-bold text-white mb-2">{{ $plan->nombre }}</h3>
                    <div class="text-3xl md:text-4xl font-bold text-fuchsia-400 mb-4">${{ number_format($plan->precio, 0, ',', '.') }}</div>
                    <p class="text-white/70 text-sm mb-6 flex-grow">{{ $plan->descripcion }}</p>
                    
                    <div class="space-y-3 mb-8">
                        <p class="text-xs font-semibold text-white/50 uppercase tracking-wider">Incluye:</p>
                        @foreach($plan->equipos->take(5) as $equipo)
                        <div class="flex items-center text-white/80 text-sm">
                            <svg class="w-5 h-5 text-fuchsia-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ $equipo->nombre }}
                        </div>
                        @endforeach
                        @if($plan->equipos->count() > 5)
                        <div class="text-white/60 text-xs">+ {{ $plan->equipos->count() - 5 }} más</div>
                        @endif
                    </div>
                    
                    <a href="{{ route('login') }}" class="block w-full text-center bg-gradient-to-r from-fuchsia-600 to-purple-600 text-white py-3 rounded-full font-semibold hover:from-fuchsia-700 hover:to-purple-700 transition mt-auto">
                        Seleccionar
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-white/10 py-12 px-6 mt-10 md:mt-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 text-center md:text-left">
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">REMIX CROSSOVER</h3>
                    <p class="text-white/70 text-sm">
                        Experiencia profesional en sonido e iluminación para eventos inolvidables.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Enlaces</h4>
                    <ul class="space-y-2">
                        <li><a href="#planes" class="text-white/70 hover:text-fuchsia-400 transition text-sm">Planes</a></li>
                        <li><a href="{{ route('login') }}" class="text-white/70 hover:text-fuchsia-400 transition text-sm">Iniciar Sesión</a></li>
                        <li><a href="{{ route('register') }}" class="text-white/70 hover:text-fuchsia-400 transition text-sm">Registrarse</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Contacto</h4>
                    <ul class="space-y-2 text-white/70 text-sm">
                        <li>Email: info@remixcrossover.com</li>
                        <li>Teléfono: +1 234 567 890</li>
                        <li>Disponible 24/7</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 pt-8 text-center">
                <p class="text-white/50 text-sm">
                    &copy; {{ date('Y') }} REMIX CROSSOVER. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
