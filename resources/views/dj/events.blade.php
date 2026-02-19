<x-app-layout>
    <x-slot name="header">
        {{ __('Mis Asignaciones de Eventos') }}
    </x-slot>

    <div class="py-8">
        <div class="space-y-12">
            <div class="relative mb-4 px-1">
                <h1 class="text-4xl font-black text-white tracking-tighter italic uppercase">Asignaciones <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">Live</span></h1>
                <p class="text-slate-400 mt-2 font-bold uppercase tracking-[0.2em] text-[10px]">Próximos eventos en tu agenda • Remix Crossover Experience</p>
                <div class="absolute -left-6 top-1/2 -translate-y-1/2 w-1.5 h-10 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full shadow-[0_0_15px_rgba(168,85,247,0.5)]"></div>
            </div>

            @if($events->isEmpty())
                <div class="glass-card rounded-[3rem] border-white/10 border-dashed p-24 text-center shadow-3xl">
                    <div class="inline-flex p-8 bg-white/5 rounded-[2rem] mb-6 border border-white/10">
                        <svg class="w-12 h-12 text-slate-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-white font-black text-2xl tracking-tighter">Agenda Disponible</p>
                    <p class="text-slate-500 font-bold uppercase tracking-widest text-xs mt-2">No tienes eventos asignados en este momento</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($events as $event)
                        <div class="glass-card rounded-[2.5rem] border-white/10 shadow-3xl flex flex-col hover:border-purple-500/30 transition-all duration-500 group relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-600/5 blur-[50px] -mr-16 -mt-16 rounded-full group-hover:bg-purple-600/10 transition-colors"></div>
                            
                            <div class="p-8">
                                <div class="flex justify-between items-start mb-10">
                                    <div class="p-4 bg-gradient-to-br from-purple-600/20 to-pink-600/20 text-purple-400 rounded-2xl group-hover:from-purple-600 group-hover:to-pink-600 group-hover:text-white transition-all duration-500 shadow-lg border border-white/5 group-hover:rotate-6 group-hover:scale-110">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <span class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 bg-white/5 px-3 py-1 rounded-full border border-white/5">Session ID: #{{ $event->id }}</span>
                                </div>

                                <div class="space-y-8">
                                    <div>
                                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.3em] mb-2 leading-none">Programming</p>
                                        <p class="text-2xl font-black text-white italic tracking-tighter uppercase leading-tight">
                                            {{ \Carbon\Carbon::parse($event->fecha_evento)->translatedFormat('d F, Y') }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.3em] mb-2 leading-none">Head of Audience</p>
                                        <p class="text-lg font-black text-white tracking-tight">{{ $event->user->name }}</p>
                                    </div>

                                    <div>
                                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.3em] mb-2 leading-none">Venue / Location</p>
                                        <div class="flex items-start text-sm text-slate-400 font-bold leading-relaxed">
                                            <svg class="w-4 h-4 text-pink-500 mr-3 mt-0.5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            <span class="group-hover:text-slate-200 transition-colors">{{ $event->direccion_evento }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-auto px-8 py-6 bg-white/[0.03] border-t border-white/5 rounded-b-[2.5rem]">
                                <p class="text-[9px] font-black uppercase tracking-[0.3em] text-purple-400 mb-4 italic">Tech Riders • Plan: {{ $event->plan->nombre }}</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($event->equipos as $equipo)
                                        <span class="px-3 py-1.5 bg-white/5 border border-white/5 rounded-xl text-[10px] font-black text-slate-300 shadow-sm group-hover:border-purple-500/20 transition-all hover:bg-white/[0.08] cursor-default">
                                            <span class="text-purple-400 mr-1">{{ $equipo->pivot->cantidad }}x</span> {{ $equipo->nombre }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
        </div>
    </div>
</x-app-layout>
