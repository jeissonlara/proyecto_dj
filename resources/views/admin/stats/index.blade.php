<x-app-layout>
    <div class="py-10 relative">
        <div class="max-w-7xl mx-auto px-6 space-y-12">
            
            <!-- Header & Filters -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8 relative">
                <div class="relative">
                    <h1 class="text-6xl font-black text-white tracking-tighter italic uppercase drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">Control <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-500 to-purple-400">Tower</span></h1>
                    <p class="text-slate-300 mt-4 font-black uppercase tracking-[0.4em] text-sm italic">Analytics • System Performance • Revenue Feed</p>
                    <div class="absolute -left-8 top-1/2 -translate-y-1/2 w-2 h-20 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full shadow-[0_0_25px_rgba(168,85,247,0.7)]"></div>
                </div>

                <!-- Year Filter Form -->
                <form action="{{ route('admin.stats') }}" method="GET" class="flex items-center gap-4 bg-white/5 p-2 rounded-3xl border border-white/10 backdrop-blur-xl">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Periodo Señal</span>
                    <select name="year" onchange="this.form.submit()" class="bg-transparent border-none text-white font-black uppercase tracking-tighter text-2xl focus:ring-0 cursor-pointer pr-10">
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" class="bg-slate-900" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Dashboard 3-Card Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1: Reservas Totales (Year) -->
                <div class="glass-card rounded-[3.5rem] border-white/10 p-12 flex flex-col justify-between shadow-2xl group hover:scale-[1.02] transition-transform duration-500 relative overflow-hidden bg-white/5">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-purple-600/10 blur-[50px] -mr-16 -mt-16 rounded-full group-hover:bg-purple-600/20 transition-all"></div>
                    <div class="relative z-10">
                        <span class="text-[10px] font-black text-purple-400 bg-purple-500/10 px-4 py-1.5 rounded-full uppercase tracking-[0.3em] border border-purple-500/20">Actividad Anual</span>
                        <h3 class="text-7xl font-black text-white mt-8 tracking-tighter drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">{{ $reservasPerMonth->sum('total') }}</h3>
                        <p class="text-sm font-black text-slate-400 uppercase tracking-widest mt-2 italic">Eventos consolidados</p>
                    </div>
                </div>

                <!-- Card 2: Equipos en Uso (Today) -->
                <div class="glass-card rounded-[3.5rem] border-white/10 p-12 flex flex-col justify-between shadow-2xl group hover:scale-[1.02] transition-transform duration-500 relative overflow-hidden bg-white/5">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-pink-600/10 blur-[50px] -mr-16 -mt-16 rounded-full group-hover:bg-pink-600/20 transition-all"></div>
                    <div class="relative z-10">
                        <span class="text-[10px] font-black text-pink-400 bg-pink-500/10 px-4 py-1.5 rounded-full uppercase tracking-[0.3em] border border-pink-500/20">Logística Activa</span>
                        <h3 class="text-7xl font-black text-white mt-8 tracking-tighter drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">{{ $occupiedEquipos->count() }}</h3>
                        <p class="text-sm font-black text-slate-400 uppercase tracking-widest mt-2 italic">Líneas técnicas desplegadas</p>
                    </div>
                </div>

                <!-- Card 3: DJ Referente -->
                <div class="glass-card rounded-[3.5rem] border-white/10 p-12 flex flex-col justify-between shadow-2xl group hover:scale-[1.02] transition-transform duration-500 relative overflow-hidden bg-white/5">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 blur-[50px] -mr-16 -mt-16 rounded-full group-hover:bg-blue-600/20 transition-all"></div>
                    <div class="relative z-10">
                        <span class="text-[10px] font-black text-blue-400 bg-blue-500/10 px-4 py-1.5 rounded-full uppercase tracking-[0.3em] border border-blue-500/20">Headliner del Mes</span>
                        @if($topDj && $topDj->dj)
                            <h3 class="text-3xl font-black text-white mt-8 tracking-tighter truncate uppercase italic">{{ $topDj->dj->name }}</h3>
                            <p class="text-sm font-black text-slate-400 uppercase tracking-widest mt-2 italic">{{ $topDj->total }} Sesiones completadas</p>
                        @else
                            <h3 class="text-3xl font-black text-slate-600 mt-8 tracking-tighter italic uppercase">Off Air</h3>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Large Activity Card -->
            <div class="glass-card rounded-[3rem] border-white/5 p-10 shadow-3xl relative overflow-hidden">
                <div class="absolute top-0 right-0 p-12 opacity-10">
                    <svg class="w-32 h-32 text-purple-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                </div>
                
                <div class="flex justify-between items-end mb-16 relative z-10">
                    <div>
                        <span class="text-[12px] font-black text-slate-500 uppercase tracking-[0.4em]">Integrated Signal Analysis</span>
                        <h2 class="text-4xl font-black text-white tracking-tighter italic uppercase mt-2">Volumen de Eventos <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">{{ $selectedYear }}</span></h2>
                    </div>
                    <div class="flex gap-6">
                        <span class="inline-flex items-center gap-3 text-xs font-black text-slate-300 uppercase tracking-widest bg-white/5 px-6 py-3 rounded-full border border-white/10 shadow-xl">
                            <span class="w-3 h-3 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full shadow-[0_0_12px_rgba(168,85,247,0.8)]"></span> Reservas Confirmadas
                        </span>
                    </div>
                </div>

                <!-- Simulation of a Chart with Bars -->
                <div class="flex items-end justify-between h-72 gap-4 border-b border-white/5 pb-6 relative z-10">
                    @php $maxVal = $reservasPerMonth->max('total') ?: 1; @endphp
                    @foreach($reservasPerMonth as $data)
                        <div class="flex-1 flex flex-col items-center group h-full justify-end">
                            <div class="w-full bg-gradient-to-t from-purple-600/20 to-pink-600/40 hover:from-purple-500 hover:to-pink-500 transition-all duration-500 rounded-2xl relative shadow-lg group-hover:shadow-purple-500/40 group-hover:scale-y-[1.02] origin-bottom" 
                                 style="height: {{ max(10, ($data->total / $maxVal) * 100) }}%;">
                                <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-all duration-300 bg-white text-slate-900 text-[10px] px-3 py-1.5 rounded-full font-black shadow-2xl scale-75 group-hover:scale-100">
                                    {{ $data->total }}
                                </div>
                            </div>
                            <span class="text-[10px] font-black text-slate-500 mt-5 uppercase tracking-tighter group-hover:text-white transition-colors">{{ date("M", mktime(0, 0, 0, $data->month, 1)) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Today's Gear Distribution -->
            <div class="glass-dark rounded-[3rem] p-10 shadow-3xl border border-white/5 relative overflow-hidden">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-600/10 blur-[100px] rounded-full"></div>
                
                <div class="mb-12 relative z-10">
                    <span class="text-[12px] font-black text-blue-400 bg-blue-500/10 px-5 py-2 rounded-full uppercase tracking-[0.3em] border border-blue-500/20">Dashboard Técnico</span>
                    <h2 class="text-4xl font-black text-white mt-6 tracking-tighter italic uppercase drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">Despliegue de Hardware del Día</h2>
                </div>

                @if($occupiedEquipos->isEmpty())
                    <div class="py-20 glass rounded-[2rem] border border-dashed border-white/10 text-center relative z-10">
                        <p class="text-slate-500 font-black uppercase tracking-[0.3em] text-xs">Sistema en pausa • Sin activos externos</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">
                        @foreach($occupiedEquipos as $item)
                            <div class="p-8 glass border-white/10 hover:border-blue-500/50 rounded-[2.5rem] flex items-center justify-between group transition-all duration-500 hover:bg-white/10 shadow-2xl">
                                <div class="flex items-center gap-6">
                                    <div class="w-16 h-16 bg-blue-500/10 rounded-[1.5rem] flex items-center justify-center text-blue-400 group-hover:text-blue-300 transition-colors border border-blue-500/10">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    </div>
                                    <span class="font-black text-white text-lg tracking-tighter uppercase italic group-hover:translate-x-2 transition-transform duration-500">{{ $item->equipo->nombre }}</span>
                                </div>
                                <span class="px-5 py-2.5 bg-blue-600/20 text-blue-400 border border-blue-500/30 rounded-full text-xs font-black uppercase tracking-widest shadow-lg">
                                    {{ $item->total_cantidad }} Units
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

