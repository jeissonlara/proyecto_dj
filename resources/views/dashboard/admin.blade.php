<x-app-layout>
    <x-slot name="header">
        {{ __('Panel Administrativo') }}
    </x-slot>

    <div class="py-6 w-full">
        <div class="max-w-6xl mx-auto space-y-10 px-4 sm:px-6 lg:px-8">

            <!-- ═══ HEADER: Title + Status ═══ -->
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 relative">
                <div class="relative pl-5">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full shadow-[0_0_20px_rgba(168,85,247,0.6)]"></div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tighter italic uppercase drop-shadow-[0_0_20px_rgba(255,255,255,0.15)]">
                        Admin <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-500 to-purple-400">Central</span>
                    </h1>
                    <p class="text-slate-400 mt-2 font-bold uppercase tracking-[0.3em] text-[9px] sm:text-[11px] italic">Command & Control • Remix Crossover Experience</p>
                </div>
                <div class="flex items-center gap-3 px-5 py-2.5 bg-white/[0.06] rounded-xl border border-white/10 backdrop-blur-sm w-fit">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-400"></span>
                    </span>
                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">Sistema Operativo</span>
                </div>
            </div>

            <!-- ═══ METRICS: 3-Column Stats ═══ -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Stat: Total Reservas -->
                <div class="bg-white/[0.04] border border-white/10 rounded-2xl p-6 sm:p-7 flex items-center gap-6 shadow-[0_20px_40px_rgba(0,0,0,0.4)] hover:border-purple-500/30 hover:bg-white/[0.07] transition-all duration-500 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-purple-600/5 blur-[50px] -mr-16 -mt-16 rounded-full group-hover:bg-purple-600/15 transition-colors"></div>
                    <div class="relative z-10 p-4 bg-purple-500/15 text-purple-400 rounded-xl border border-purple-500/20 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-1">Total Reservas</p>
                        <p class="text-4xl sm:text-5xl font-black text-white italic tracking-tighter leading-none drop-shadow-[0_0_10px_rgba(255,255,255,0.1)]">{{ $reservasCount }}</p>
                    </div>
                </div>

                <!-- Stat: Equipos Inventariados -->
                <div class="bg-white/[0.04] border border-white/10 rounded-2xl p-6 sm:p-7 flex items-center gap-6 shadow-[0_20px_40px_rgba(0,0,0,0.4)] hover:border-pink-500/30 hover:bg-white/[0.07] transition-all duration-500 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-pink-600/5 blur-[50px] -mr-16 -mt-16 rounded-full group-hover:bg-pink-600/15 transition-colors"></div>
                    <div class="relative z-10 p-4 bg-pink-500/15 text-pink-400 rounded-xl border border-pink-500/20 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-1">Equipos Inventariados</p>
                        <p class="text-4xl sm:text-5xl font-black text-white italic tracking-tighter leading-none drop-shadow-[0_0_10px_rgba(255,255,255,0.1)]">{{ $equiposCount }}</p>
                    </div>
                </div>

                <!-- Stat: Eventos Finalizados -->
                <div class="bg-white/[0.04] border border-white/10 rounded-2xl p-6 sm:p-7 flex items-center gap-6 shadow-[0_20px_40px_rgba(0,0,0,0.4)] hover:border-blue-500/30 hover:bg-white/[0.07] transition-all duration-500 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/5 blur-[50px] -mr-16 -mt-16 rounded-full group-hover:bg-blue-600/15 transition-colors"></div>
                    <div class="relative z-10 p-4 bg-blue-500/15 text-blue-400 rounded-xl border border-blue-500/20 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-1">Eventos Finalizados</p>
                        <p class="text-4xl sm:text-5xl font-black text-white italic tracking-tighter leading-none drop-shadow-[0_0_10px_rgba(255,255,255,0.1)]">{{ $finalizadasCount }}</p>
                        <p class="text-[9px] font-bold text-blue-400/70 uppercase tracking-widest mt-1">{{ $finalizadasMes }} este mes</p>
                    </div>
                </div>
            </div>

            <!-- ═══ QUICK ACCESS: 3-Column Actions ═══ -->
            <div class="space-y-5">
                <div class="flex items-center gap-3 pl-1">
                    <div class="w-1 h-5 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full shadow-[0_0_10px_rgba(168,85,247,0.4)]"></div>
                    <h4 class="text-sm font-black uppercase tracking-[0.2em] text-white italic">Accesos Directos</h4>
                    <div class="flex-1 h-px bg-gradient-to-r from-white/10 to-transparent ml-4"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Action: Reservas -->
                    <a href="{{ route('admin.reservations.index') }}" class="group relative block p-7 bg-white/[0.04] border border-white/10 rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.4)] hover:border-purple-500/40 hover:bg-white/[0.08] hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                        <div class="absolute bottom-0 right-0 w-28 h-28 bg-purple-600/5 blur-[40px] -mr-14 -mb-14 rounded-full group-hover:bg-purple-600/15 transition-colors"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-purple-500/15 rounded-xl flex items-center justify-center mb-5 group-hover:bg-purple-600 group-hover:scale-110 transition-all duration-500 border border-purple-500/20 shadow-lg">
                                <svg class="w-5 h-5 text-purple-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <h5 class="text-lg font-black text-white italic tracking-tight mb-1.5 uppercase">Gestionar Reservas</h5>
                            <p class="text-[11px] text-slate-500 font-bold leading-relaxed uppercase tracking-wide group-hover:text-slate-300 transition-colors">Administración centralizada de todas las solicitudes.</p>
                        </div>
                    </a>

                    <!-- Action: Inventario -->
                    <a href="{{ route('admin.inventory.index') }}" class="group relative block p-7 bg-white/[0.04] border border-white/10 rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.4)] hover:border-pink-500/40 hover:bg-white/[0.08] hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                        <div class="absolute bottom-0 right-0 w-28 h-28 bg-pink-600/5 blur-[40px] -mr-14 -mb-14 rounded-full group-hover:bg-pink-600/15 transition-colors"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-pink-500/15 rounded-xl flex items-center justify-center mb-5 group-hover:bg-pink-600 group-hover:scale-110 transition-all duration-500 border border-pink-500/20 shadow-lg">
                                <svg class="w-5 h-5 text-pink-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <h5 class="text-lg font-black text-white italic tracking-tight mb-1.5 uppercase">Control Inventario</h5>
                            <p class="text-[11px] text-slate-500 font-bold leading-relaxed uppercase tracking-wide group-hover:text-slate-300 transition-colors">Gestión de stock, mantenimiento y asignaciones.</p>
                        </div>
                    </a>

                    <!-- Action: Estadísticas -->
                    <a href="{{ route('admin.stats') }}" class="group relative block p-7 bg-white/[0.04] border border-white/10 rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.4)] hover:border-cyan-500/40 hover:bg-white/[0.08] hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                        <div class="absolute bottom-0 right-0 w-28 h-28 bg-cyan-600/5 blur-[40px] -mr-14 -mb-14 rounded-full group-hover:bg-cyan-600/15 transition-colors"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-cyan-500/15 rounded-xl flex items-center justify-center mb-5 group-hover:bg-cyan-600 group-hover:scale-110 transition-all duration-500 border border-cyan-500/20 shadow-lg">
                                <svg class="w-5 h-5 text-cyan-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <h5 class="text-lg font-black text-white italic tracking-tight mb-1.5 uppercase">Métricas & Data</h5>
                            <p class="text-[11px] text-slate-500 font-bold leading-relaxed uppercase tracking-wide group-hover:text-slate-300 transition-colors">Análisis detallado de rendimiento y actividad.</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
