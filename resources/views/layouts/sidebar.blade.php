<aside class="w-80 glass-dark text-slate-100 min-h-screen hidden md:flex flex-col fixed left-0 top-0 z-50 shadow-2xl border-r border-white/10">
    <div class="p-10 border-b border-white/10 mb-4 bg-white/5">
        <a href="{{ route('dashboard') }}" class="flex flex-col space-y-1 group">
            <div class="text-3xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-500 to-purple-400 group-hover:from-white group-hover:to-purple-200 transition-all duration-500 italic">
                REMIX CROSSOVER
            </div>
            <div class="text-xs font-black text-purple-400 uppercase tracking-[0.4em] opacity-100 group-hover:text-pink-400 transition-colors">Experience</div>
        </a>
    </div>

    <nav class="flex-1 px-6 space-y-3 py-8 overflow-y-auto custom-scrollbar">
        <!-- Main Section Label -->
        <div class="px-4 mb-5 text-xs font-black uppercase tracking-[0.3em] text-slate-500">Signal Core</div>

        <!-- Dashboard Link -->
        <a href="{{ route('dashboard') }}" class="group flex items-center px-6 py-4 text-base font-black uppercase tracking-widest rounded-2xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-xl shadow-purple-600/40 glow-purple' : 'hover:bg-white/10 hover:text-white border border-transparent hover:border-white/10' }}">
            <svg class="w-6 h-6 mr-4 transition-colors {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>

        @if(auth()->user()->isAdmin())
            <div class="pt-10 pb-4 px-4 uppercase text-xs font-black text-slate-500 tracking-[0.3em]">Control Tower</div>
            <a href="{{ route('admin.reservations.index') }}" class="group flex items-center px-6 py-4 text-base font-black uppercase tracking-widest rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.reservations.*') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-xl shadow-purple-600/40' : 'hover:bg-white/10 hover:text-white border border-transparent hover:border-white/10' }}">
                <svg class="w-6 h-6 mr-4 {{ request()->routeIs('admin.reservations.*') ? 'text-white' : 'text-slate-400 group-hover:text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Reservas
            </a>
            <a href="{{ route('admin.inventory.index') }}" class="group flex items-center px-6 py-4 text-base font-black uppercase tracking-widest rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.inventory.*') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-xl shadow-purple-600/40' : 'hover:bg-white/10 hover:text-white border border-transparent hover:border-white/10' }}">
                <svg class="w-6 h-6 mr-4 {{ request()->routeIs('admin.inventory.*') ? 'text-white' : 'text-slate-400 group-hover:text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Inventario
            </a>
            <a href="{{ route('admin.stats') }}" class="group flex items-center px-6 py-4 text-base font-black uppercase tracking-widest rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.stats') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-xl shadow-purple-600/40' : 'hover:bg-white/10 hover:text-white border border-transparent hover:border-white/10' }}">
                <svg class="w-6 h-6 mr-4 {{ request()->routeIs('admin.stats') ? 'text-white' : 'text-slate-400 group-hover:text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Estadísticas
            </a>
        @endif

        @if(auth()->user()->isDj())
            <div class="pt-10 pb-4 px-4 uppercase text-xs font-black text-slate-500 tracking-[0.3em]">The Booth</div>
            <a href="{{ route('dj.events') }}" class="group flex items-center px-6 py-4 text-base font-black uppercase tracking-widest rounded-2xl transition-all duration-300 {{ request()->routeIs('dj.events') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-xl shadow-purple-600/40' : 'hover:bg-white/10 hover:text-white border border-transparent hover:border-white/10' }}">
                <svg class="w-6 h-6 mr-4 {{ request()->routeIs('dj.events') ? 'text-white' : 'text-slate-400 group-hover:text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Asignaciones
            </a>
        @endif

        @if(auth()->user()->isClient())
            <div class="pt-10 pb-4 px-4 uppercase text-xs font-black text-slate-500 tracking-[0.3em]">Your Service</div>
            <a href="{{ route('client.reservations.create') }}" class="group flex items-center px-6 py-4 text-base font-black uppercase tracking-widest rounded-2xl transition-all duration-300 {{ request()->routeIs('client.reservations.create') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-xl shadow-purple-600/40' : 'hover:bg-white/10 hover:text-white border border-transparent hover:border-white/10' }}">
                <svg class="w-6 h-6 mr-4 {{ request()->routeIs('client.reservations.create') ? 'text-white' : 'text-slate-400 group-hover:text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Solicitar Reserva
            </a>
            <a href="{{ route('client.reservations.index') }}" class="group flex items-center px-6 py-4 text-base font-black uppercase tracking-widest rounded-2xl transition-all duration-300 {{ request()->routeIs('client.reservations.index') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-xl shadow-purple-600/40' : 'hover:bg-white/10 hover:text-white border border-transparent hover:border-white/10' }}">
                <svg class="w-6 h-6 mr-4 {{ request()->routeIs('client.reservations.index') ? 'text-white' : 'text-slate-400 group-hover:text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Historial
            </a>
        @endif
    </nav>

    <div class="p-8 border-t border-white/10 bg-white/5">
        <div class="flex items-center px-6 py-6 bg-white/5 rounded-[2rem] border border-white/10 transition-all hover:bg-white/10 shadow-2xl">
            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white font-black text-lg shadow-lg shadow-purple-500/30">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="ml-5 flex-1 min-w-0">
                <p class="text-sm font-black text-white truncate">{{ auth()->user()->name }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[10px] font-black text-purple-400 hover:text-pink-400 transition-colors uppercase tracking-[0.3em] mt-1">Disconnect</button>
                </form>
            </div>
        </div>
    </div>
</aside>

