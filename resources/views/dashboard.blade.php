<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-8">

            <!-- Header Row: Welcome + Role Badge -->
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <h1 class="text-4xl md:text-5xl font-black text-white italic uppercase tracking-tighter drop-shadow-[0_0_15px_rgba(255,255,255,0.15)]">
                        Panel <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-500 to-purple-400">Administrativo</span>
                    </h1>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-[0.4em] mt-3 italic">Admin Central • Remix Crossover Experience</p>
                </div>
                <div class="flex items-center gap-3 px-6 py-3 glass rounded-2xl border border-white/10">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-400"></span>
                    </span>
                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">Sesión Activa</span>
                </div>
            </div>

            <!-- 3-Column Metric Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: User & Role -->
                <div class="glass-card rounded-3xl border border-white/10 p-8 relative overflow-hidden group hover:border-purple-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-600/10 blur-[40px] -mr-12 -mt-12 rounded-full group-hover:bg-purple-600/20 transition-all"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-5 mb-6">
                            <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-purple-500/30">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-lg font-black text-white uppercase tracking-tight italic">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] font-black text-purple-400 uppercase tracking-[0.3em]">
                                    @if(Auth::user()->isAdmin()) Administrador @elseif(Auth::user()->isDj()) DJ @else Cliente @endif
                                </p>
                            </div>
                        </div>
                        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-4 italic">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Card 2: Session Info -->
                <div class="glass-card rounded-3xl border border-white/10 p-8 relative overflow-hidden group hover:border-pink-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-pink-600/10 blur-[40px] -mr-12 -mt-12 rounded-full group-hover:bg-pink-600/20 transition-all"></div>
                    <div class="relative z-10">
                        <span class="text-[10px] font-black text-pink-400 bg-pink-500/10 px-4 py-1.5 rounded-full uppercase tracking-[0.3em] border border-pink-500/20">Conexión</span>
                        <h3 class="text-3xl font-black text-white mt-6 tracking-tighter italic">{{ now()->format('H:i') }}</h3>
                        <p class="text-sm font-black text-slate-400 uppercase tracking-widest mt-1 italic">{{ now()->isoFormat('dddd, D MMM YYYY') }}</p>
                        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent mt-4"></div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-4 italic">Timezone: {{ config('app.timezone') }}</p>
                    </div>
                </div>

                <!-- Card 3: System Status -->
                <div class="glass-card rounded-3xl border border-white/10 p-8 relative overflow-hidden group hover:border-cyan-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-600/10 blur-[40px] -mr-12 -mt-12 rounded-full group-hover:bg-cyan-600/20 transition-all"></div>
                    <div class="relative z-10">
                        <span class="text-[10px] font-black text-cyan-400 bg-cyan-500/10 px-4 py-1.5 rounded-full uppercase tracking-[0.3em] border border-cyan-500/20">Sistema</span>
                        <div class="mt-6 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Plataforma</span>
                                <span class="text-[10px] font-black text-white uppercase tracking-wider">Laravel {{ app()->version() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Estado</span>
                                <span class="text-[10px] font-black text-green-400 uppercase tracking-wider flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full shadow-[0_0_6px_rgba(74,222,128,0.8)]"></span> Operativo
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">PHP</span>
                                <span class="text-[10px] font-black text-white uppercase tracking-wider">{{ phpversion() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Access Panel (Admin Only) -->
            @if(Auth::user()->isAdmin())
            <div class="glass-card rounded-3xl border border-white/10 p-8 relative overflow-hidden">
                <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-purple-600/5 blur-[100px] -ml-[150px] -mb-[150px] rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-1.5 h-8 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full shadow-[0_0_15px_rgba(168,85,247,0.5)]"></div>
                        <h3 class="text-xl font-black text-white uppercase tracking-tight italic">Accesos Rápidos</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <a href="{{ route('admin.reservations.index') }}" class="group flex items-center gap-5 px-6 py-5 bg-white/5 hover:bg-white/10 border border-white/5 hover:border-purple-500/30 rounded-2xl transition-all duration-500">
                            <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center text-purple-400 group-hover:bg-purple-500/20 group-hover:scale-110 transition-all border border-purple-500/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-black text-white uppercase tracking-tight italic group-hover:text-purple-300 transition-colors">Reservas</p>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Gestión de eventos</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.inventory.index') }}" class="group flex items-center gap-5 px-6 py-5 bg-white/5 hover:bg-white/10 border border-white/5 hover:border-pink-500/30 rounded-2xl transition-all duration-500">
                            <div class="w-12 h-12 bg-pink-500/10 rounded-xl flex items-center justify-center text-pink-400 group-hover:bg-pink-500/20 group-hover:scale-110 transition-all border border-pink-500/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-black text-white uppercase tracking-tight italic group-hover:text-pink-300 transition-colors">Inventario</p>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Catálogo técnico</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.stats') }}" class="group flex items-center gap-5 px-6 py-5 bg-white/5 hover:bg-white/10 border border-white/5 hover:border-cyan-500/30 rounded-2xl transition-all duration-500">
                            <div class="w-12 h-12 bg-cyan-500/10 rounded-xl flex items-center justify-center text-cyan-400 group-hover:bg-cyan-500/20 group-hover:scale-110 transition-all border border-cyan-500/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-black text-white uppercase tracking-tight italic group-hover:text-cyan-300 transition-colors">Estadísticas</p>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Analytics y métricas</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Footer Signal -->
            <div class="text-center pt-4">
                <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.5em] italic opacity-40">
                    High Velocity Feed • Remix Crossover Experience • System Ready
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
