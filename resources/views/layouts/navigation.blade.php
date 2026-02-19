<nav x-data="{ open: false }" class="glass-dark border-b border-white/5 md:hidden sticky top-0 z-50 backdrop-blur-2xl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex flex-col">
                        <span class="text-xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500 leading-none">REMIX</span>
                        <span class="text-[8px] font-black text-purple-400 uppercase tracking-[0.3em] leading-none mt-1">Experience</span>
                    </a>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-2xl text-slate-400 hover:text-white hover:bg-white/5 focus:outline-none transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/5 bg-slate-950/50 backdrop-blur-3xl">
        <div class="pt-4 pb-6 space-y-2 px-4 italic font-black uppercase tracking-widest text-[10px]">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-2xl">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(auth()->user()->isAdmin())
                <div class="pt-4 pb-2 px-4 text-xs font-black text-slate-500 tracking-[0.3em]">Control Tower</div>
                <x-responsive-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.*')" class="rounded-2xl">
                    {{ __('Reservas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.inventory.index')" :active="request()->routeIs('admin.inventory.*')" class="rounded-2xl">
                    {{ __('Inventario') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.stats')" :active="request()->routeIs('admin.stats')" class="rounded-2xl">
                    {{ __('Estadísticas') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->isDj())
                <div class="pt-4 pb-2 px-4 text-xs font-black text-slate-500 tracking-[0.3em]">The Booth</div>
                <x-responsive-nav-link :href="route('dj.events')" :active="request()->routeIs('dj.events')" class="rounded-2xl">
                    {{ __('Asignaciones') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->isClient())
                <div class="pt-4 pb-2 px-4 text-xs font-black text-slate-500 tracking-[0.3em]">Your Service</div>
                <x-responsive-nav-link :href="route('client.reservations.create')" :active="request()->routeIs('client.reservations.create')" class="rounded-2xl">
                    {{ __('Solicitar Reserva') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.reservations.index')" :active="request()->routeIs('client.reservations.index')" class="rounded-2xl">
                    {{ __('Historial') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-6 pb-6 border-t border-white/5 px-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white font-black">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-black text-white tracking-tight">{{ Auth::user()->name }}</div>
                    <div class="font-bold text-[10px] text-slate-500 uppercase tracking-widest">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-2xl border border-white/5">
                    {{ __('Profile Settings') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="rounded-2xl bg-rose-500/10 text-rose-400 border border-rose-500/10">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
