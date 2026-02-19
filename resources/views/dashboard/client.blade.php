<x-app-layout>
    <x-slot name="header">
        {{ __('Mi Panel de Cliente') }}
    </x-slot>

    <div class="py-2">
        <div class="space-y-8">
            <!-- Action Bar -->
            <div class="flex justify-between items-center glass-card p-8 rounded-[2.5rem] border-white/10 shadow-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-black text-white leading-tight tracking-tighter">Mis Reservas</h3>
                    <p class="text-sm font-bold text-slate-400 mt-1 uppercase tracking-widest leading-none">Historial de eventos</p>
                </div>
                <a href="{{ route('client.reservations.create') }}" class="px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full font-black hover:scale-105 transition-all shadow-xl shadow-purple-600/30 flex items-center text-sm tracking-widest uppercase group relative z-10">
                    <svg class="w-5 h-5 mr-3 group-hover:rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Nueva Reserva
                </a>
            </div>

            <div class="glass-card rounded-[2.5rem] border-white/10 shadow-2xl overflow-hidden min-h-[400px]">
                <div class="p-0">
                    @if($myReservations->isEmpty())
                        <div class="text-center py-32">
                            <div class="inline-flex p-6 bg-white/5 rounded-[2rem] mb-6 border border-white/10">
                                <svg class="w-12 h-12 text-purple-400 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <p class="text-white font-black text-2xl tracking-tighter">Aún no tienes reservas</p>
                            <p class="text-slate-400 font-bold uppercase tracking-widest text-xs mt-2">¡Empieza creando tu primer evento hoy mismo!</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-white/5">
                                <thead class="bg-white/5">
                                    <tr>
                                        <th class="px-10 py-7 text-left text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Fecha</th>
                                        <th class="px-10 py-7 text-left text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Plan</th>
                                        <th class="px-10 py-7 text-left text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Ubicación</th>
                                        <th class="px-10 py-7 text-left text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @foreach($myReservations as $reserva)
                                        <tr class="hover:bg-white/[0.02] transition-colors group">
                                            <td class="px-10 py-6 whitespace-nowrap">
                                                <div class="font-black text-white tracking-tight">{{ \Carbon\Carbon::parse($reserva->fecha_evento)->format('d M, Y') }}</div>
                                            </td>
                                            <td class="px-10 py-6 whitespace-nowrap">
                                                <span class="px-4 py-1.5 bg-purple-600/20 text-purple-300 rounded-full text-[10px] font-black uppercase tracking-widest border border-purple-500/20">
                                                    {{ $reserva->plan->nombre }}
                                                </span>
                                            </td>
                                            <td class="px-10 py-6 whitespace-nowrap text-slate-400 font-bold text-sm tracking-tight">
                                                {{ Str::limit($reserva->direccion_evento, 40) }}
                                            </td>
                                            <td class="px-10 py-6 whitespace-nowrap">
                                                @php
                                                    $statusStyles = [
                                                        1 => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                                        2 => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                                        3 => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
                                                    ];
                                                    $style = $statusStyles[$reserva->estado_id] ?? 'bg-white/10 text-white border-white/20';
                                                @endphp
                                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.1em] border {{ $style }} shadow-sm backdrop-blur-md">
                                                    {{ $reserva->estado->nombre }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
