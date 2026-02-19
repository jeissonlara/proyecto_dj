<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6 space-y-12">
            
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 relative">
                <div class="relative pl-6 lg:pl-0">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tighter italic uppercase drop-shadow-[0_0_15px_rgba(255,255,255,0.1)] leading-none lg:leading-tight">
                        Gestión de <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-500 to-purple-400 block lg:inline">Reservas</span>
                    </h1>
                    <p class="text-slate-300 mt-4 font-black uppercase tracking-[0.2em] sm:tracking-[0.4em] text-xs sm:text-sm italic">Direct Signal Feed • Real-time Logistics</p>
                    <div class="absolute left-0 top-0 bottom-0 lg:hidden w-1.5 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full shadow-[0_0_25px_rgba(168,85,247,0.7)]"></div>
                    <div class="hidden lg:block absolute -left-8 top-1/2 -translate-y-1/2 w-2 h-20 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full shadow-[0_0_25px_rgba(168,85,247,0.7)]"></div>
                </div>
                
                <div class="grid grid-cols-2 lg:flex gap-4 sm:gap-8">
                    <div class="glass-card px-4 sm:px-8 py-4 rounded-[1.5rem] sm:rounded-[2rem] border-white/10 shadow-2xl flex flex-col items-center bg-white/5 min-w-[120px] sm:min-w-[140px]">
                        <span class="text-[8px] sm:text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-2">Pendientes</span>
                        <p class="text-3xl sm:text-4xl font-black text-amber-500 leading-none drop-shadow-[0_0_10px_rgba(245,158,11,0.3)]">{{ $reservations->where('estado_id', 1)->count() }}</p>
                    </div>
                    <div class="glass-card px-4 sm:px-8 py-4 rounded-[1.5rem] sm:rounded-[2rem] border-white/10 shadow-2xl flex flex-col items-center bg-white/5 min-w-[120px] sm:min-w-[140px]">
                        <span class="text-[8px] sm:text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-2">Confirmadas</span>
                        <p class="text-3xl sm:text-4xl font-black text-emerald-500 leading-none drop-shadow-[0_0_10px_rgba(16,185,129,0.3)]">{{ $reservations->where('estado_id', 2)->count() }}</p>
                    </div>
                    <div class="glass-card col-span-2 lg:col-span-1 px-4 sm:px-8 py-4 rounded-[1.5rem] sm:rounded-[2rem] border-white/10 shadow-2xl flex flex-col items-center bg-white/5 min-w-[120px] sm:min-w-[140px]">
                        <span class="text-[8px] sm:text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-2">Finalizadas</span>
                        <p class="text-3xl sm:text-4xl font-black text-blue-400 leading-none drop-shadow-[0_0_10px_rgba(96,165,250,0.3)]">{{ $reservations->where('estado_id', 4)->count() }}</p>
                    </div>
                </div>
            </div>



            <!-- Reservations List -->
            <div class="space-y-8">
                @foreach($reservations as $reserva)
                    <div class="glass-card rounded-[2rem] sm:rounded-[2.5rem] border-white/10 p-6 sm:p-10 space-y-8 sm:space-y-10 transition-all hover:border-purple-500/30 group relative overflow-hidden shadow-2xl">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-purple-600/5 blur-[100px] -mr-32 -mt-32 rounded-full"></div>
                        
                        <!-- FILA 1: Plan + Fecha | Cliente + Teléfono | Estado -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start relative z-10">
                            <div class="md:col-span-4 space-y-3">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] block">Contratación</span>
                                <p class="text-2xl sm:text-3xl font-black text-white italic tracking-tighter uppercase leading-tight drop-shadow-[0_0_8px_rgba(255,255,255,0.1)]">{{ $reserva->plan->nombre }}</p>
                                <div class="flex items-center gap-3 mt-4">
                                    <div class="p-2 bg-purple-500/10 rounded-lg text-purple-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-base sm:text-lg font-black text-white tracking-widest">{{ \Carbon\Carbon::parse($reserva->fecha_evento)->format('d . M . Y') }}</p>
                                </div>
                            </div>
                            <div class="md:col-span-4 space-y-3">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] block">Titular del Evento</span>
                                <p class="text-2xl sm:text-3xl font-black text-white tracking-tighter uppercase break-words">{{ $reserva->user->name }}</p>
                                <div class="flex items-center gap-3 mt-4">
                                    <div class="p-2 bg-pink-500/10 rounded-lg text-pink-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <p class="text-lg font-black text-pink-500 italic tracking-[0.2em]">{{ $reserva->telefono_cliente }}</p>
                                </div>
                                
                                @php
                                    $rejectedCount = $reserva->user->reservas()->where('estado_id', 3)->count();
                                @endphp
                                @if($rejectedCount > 2)
                                    <div class="mt-3 flex items-center gap-2 text-rose-500 bg-rose-500/10 px-3 py-2 rounded-lg border border-rose-500/20 w-fit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        <span class="text-[9px] font-black uppercase tracking-widest leading-none">High Risk Client ({{ $rejectedCount }} Cancel)</span>
                                    </div>
                                @endif
                            </div>
                            <div class="md:col-span-4 flex justify-start md:justify-end">
                                @php
                                    $statusStyles = [
                                        1 => 'bg-amber-500/10 text-amber-400 border-amber-500/20 shadow-[0_0_15px_rgba(245,158,11,0.1)]',
                                        2 => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20 shadow-[0_0_15px_rgba(16,185,129,0.1)]',
                                        3 => 'bg-rose-500/10 text-rose-400 border-rose-500/20 shadow-[0_0_15px_rgba(244,63,94,0.1)]',
                                        4 => 'bg-blue-500/10 text-blue-400 border-blue-500/20 shadow-[0_0_15px_rgba(96,165,250,0.1)]',
                                    ];
                                @endphp
                                <span class="px-6 sm:px-8 py-3 rounded-[1.5rem] text-[10px] sm:text-xs font-black uppercase tracking-[0.3em] border backdrop-blur-md shadow-2xl {{ $statusStyles[$reserva->estado_id] ?? 'bg-white/5 text-white border-white/10' }}">
                                    {{ $reserva->estado->nombre }}
                                </span>
                            </div>
                        </div>

                        <!-- FILA 2: DJ Asignado | Dirección -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pt-8 sm:pt-10 border-t border-white/10 relative z-10">
                            <div class="md:col-span-6 space-y-5">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] block">Technical Leader (DJ)</span>
                                <div class="flex items-center gap-6">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-[1.5rem] sm:rounded-[2rem] bg-gradient-to-br from-purple-600 via-pink-600 to-purple-600 flex items-center justify-center text-white font-black text-2xl sm:text-3xl shadow-xl shadow-purple-600/40 group-hover:rotate-3 transition-transform duration-500 border border-white/20 flex-shrink-0">
                                        {{ substr($reserva->dj->name, 0, 1) }}
                                    </div>
                                    <p class="text-2xl sm:text-3xl font-black text-white tracking-tighter uppercase italic">{{ $reserva->dj->name }}</p>
                                </div>
                            </div>
                            <div class="md:col-span-6 space-y-5">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] block">Location Detail</span>
                                <div class="p-6 bg-white/5 rounded-3xl border border-white/10 group-hover:bg-white/[0.08] transition-colors shadow-inner">
                                    <p class="text-base sm:text-lg font-black text-white italic tracking-tighter uppercase leading-none">{{ $reserva->direccion_evento }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- FILA 3: Equipos -->
                        <div class="pt-8 sm:pt-10 border-t border-white/10 relative z-10">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] block mb-8">Equipment Deployment</span>
                            <div class="flex flex-wrap gap-3 sm:gap-5">
                                @foreach($reserva->plan->equipos as $eq)
                                    <span class="px-4 sm:px-6 py-3 bg-white/5 text-white rounded-2xl border border-white/10 text-[10px] sm:text-xs font-black uppercase tracking-[0.2em] hover:border-purple-500/60 transition-all hover:bg-purple-500/5 cursor-default shadow-xl">
                                        <span class="text-purple-400 mr-2 text-xs sm:text-sm">{{ $eq->pivot->cantidad }}X</span> {{ $eq->nombre }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- FILA 4: Acciones -->
                        <div class="pt-8 sm:pt-10 border-t border-white/10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
                            <!-- Cambio de DJ -->
                            <form action="{{ route('admin.reservations.assignDj', $reserva) }}" method="POST" class="flex gap-3 w-full md:w-auto">
                                @csrf @method('PATCH')
                                <select name="dj_id" class="flex-1 md:flex-none text-[10px] font-black bg-white/5 border-white/10 text-white rounded-2xl focus:ring-purple-500 focus:border-purple-500 py-3 pl-4 pr-10 uppercase tracking-widest backdrop-blur-xl">
                                    @foreach($djs as $dj)
                                        <option value="{{ $dj->id }}" class="bg-slate-900" {{ $reserva->dj_id == $dj->id ? 'selected' : '' }}>Assigned: {{ $dj->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="p-3 bg-white/10 text-slate-400 rounded-2xl hover:bg-purple-600 hover:text-white transition-all shadow-xl hover:shadow-purple-600/30">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                </button>
                            </form>

                            <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 md:gap-6 w-full md:w-auto">
                                <form action="{{ route('admin.reservations.destroy', $reserva) }}" method="POST" class="w-full md:w-auto">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full md:w-auto px-10 py-4 sm:py-5 bg-rose-500/10 text-rose-400 rounded-full font-black text-sm uppercase tracking-[0.4em] border border-rose-500/30 hover:bg-rose-600 hover:text-white transition-all shadow-2xl hover:shadow-rose-600/40">
                                        Rechazar
                                    </button>
                                </form>
                                <form action="{{ route('admin.reservations.updateStatus', $reserva) }}" method="POST" class="w-full md:w-auto">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="estado_id" value="2">
                                    <button type="submit" class="w-full md:w-auto px-12 py-4 sm:py-5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full font-black text-sm uppercase tracking-[0.4em] shadow-2xl shadow-emerald-600/40 hover:scale-105 active:scale-95 transition-all">
                                        Approve
                                    </button>
                                </form>
                                @if($reserva->estado_id === 2)
                                <form action="{{ route('admin.reservations.finalize', $reserva) }}" method="POST" class="w-full md:w-auto">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="w-full md:w-auto px-10 py-4 sm:py-5 bg-blue-500/10 text-blue-400 rounded-full font-black text-sm uppercase tracking-[0.4em] border border-blue-500/30 hover:bg-blue-600 hover:text-white transition-all shadow-2xl hover:shadow-blue-600/40">
                                        Finalizar
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
