<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bienvenido DJ ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="glass-card rounded-[3rem] border-white/10 shadow-3xl overflow-hidden relative group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-purple-600/5 blur-[100px] -mr-32 -mt-32 rounded-full group-hover:bg-purple-600/10 transition-colors"></div>
                <div class="p-12 text-center relative z-10">
                    <div class="inline-flex p-6 bg-gradient-to-br from-purple-600/20 to-pink-600/20 rounded-3xl mb-8 border border-white/5">
                        <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                    </div>
                    <h1 class="text-4xl font-black text-white italic uppercase tracking-tighter mb-4">Bienvenido, <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">{{ Auth::user()->name }}</span></h1>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-12">Session Master • Remix Crossover Experience</p>
                    
                    <div class="flex flex-col items-center justify-center space-y-8">
                        <div class="px-8 py-4 bg-white/5 border border-white/10 rounded-2xl">
                            <p class="text-sm font-bold text-slate-300 uppercase tracking-widest"><span class="text-3xl font-black text-purple-400 mr-2">{{ $eventsCount }}</span> Eventos en Agenda</p>
                        </div>
                        
                        <a href="{{ route('dj.events') }}" class="inline-flex items-center px-12 py-5 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full font-black text-xs uppercase tracking-[0.2em] hover:scale-105 transition-all shadow-2xl shadow-purple-600/40 glow-purple">
                            Ver Mis Eventos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
