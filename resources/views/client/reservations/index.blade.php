<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Eventos') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="space-y-10">
            <!-- Action Bar & Success Message -->
            <div class="bg-white p-10 rounded-3xl border border-slate-200 shadow-sm flex flex-col md:flex-row justify-between items-center gap-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 text-indigo-50 opacity-20">
                    <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                </div>
                <div class="relative z-10 w-full">

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h3 class="text-3xl font-black text-slate-900 tracking-tighter">Mis Eventos</h3>
                            <p class="text-slate-500 font-medium mt-1">Historial y seguimiento en tiempo real de tus reservas.</p>
                        </div>
                        <a href="{{ route('client.reservations.create') }}" class="px-10 py-5 bg-indigo-600 text-white rounded-[1.5rem] font-black hover:bg-slate-900 transition-all shadow-2xl shadow-indigo-600/20 flex items-center text-xs uppercase tracking-widest active:scale-95 group">
                            <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Nueva Reserva
                        </a>
                    </div>
                </div>
            </div>

            <!-- List Layout -->
            <div class="space-y-6">
                @if($reservations->isEmpty())
                    <div class="bg-white rounded-3xl border border-slate-200 p-24 text-center">
                        <div class="inline-flex p-6 bg-slate-50 rounded-[2rem] mb-6 border border-slate-100 shadow-inner">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 tracking-tight">¡Lánzate a la pista!</h4>
                        <p class="text-slate-500 font-medium mt-2 max-w-sm mx-auto">Todavía no has realizado ninguna reserva. Crea tu primera solicitud y nos encargaremos del resto.</p>
                    </div>
                @else
                    @foreach($reservations as $reserva)
                        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:border-indigo-200 transition-all overflow-hidden group">
                            <div class="p-10 flex flex-col md:flex-row gap-12">
                                
                                <!-- Visual Indicator (Left) -->
                                <div class="flex md:flex-col items-center justify-center gap-4">
                                    <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex flex-col items-center justify-center border-2 border-slate-100 group-hover:bg-indigo-600 group-hover:border-indigo-600 group-hover:text-white transition-all shadow-inner">
                                        <span class="text-[10px] font-black uppercase leading-none mb-1 opacity-60">{{ \Carbon\Carbon::parse($reserva->fecha_evento)->format('M') }}</span>
                                        <span class="text-3xl font-black leading-tight">{{ \Carbon\Carbon::parse($reserva->fecha_evento)->format('d') }}</span>
                                    </div>
                                    <div class="h-12 w-1 bg-slate-100 rounded-full hidden md:block"></div>
                                </div>

                                <!-- Main Info (Center) -->
                                <div class="flex-1 space-y-6">
                                    <div class="flex items-center gap-4">
                                        <span class="px-4 py-1.5 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg">
                                            {{ $reserva->plan->nombre }}
                                        </span>
                                        <span class="text-slate-300">|</span>
                                        <span class="text-sm font-black text-slate-900 tracking-tight">📍 {{ Str::limit($reserva->direccion_evento, 50) }}</span>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Feedback del DJ</p>
                                            <p class="text-sm font-bold text-slate-600 leading-relaxed italic border-l-4 border-indigo-100 pl-4 bg-slate-50 py-3 rounded-r-xl">
                                                @if($reserva->estado_id == 1)
                                                    "Tu reserva está siendo revisada por el administrador. Espera nuestra validación pronto."
                                                @elseif($reserva->estado_id == 2)
                                                    "¡Todo listo! El equipo y tu DJ {{ $reserva->dj->name }} ya están reservados para tu evento."
                                                @else
                                                    "Lamentablemente no pudimos procesar tu reserva. Contacta a soporte para más detalles."
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Personal Asignado</p>
                                            <div class="flex items-center bg-white p-3 rounded-2xl border border-slate-100 shadow-sm w-fit">
                                                <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xs mr-3">
                                                    {{ substr($reserva->dj->name, 0, 1) }}
                                                </div>
                                                <span class="text-xs font-black text-slate-900 uppercase tracking-tighter">{{ $reserva->dj->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status (Right) -->
                                <div class="flex flex-col items-center md:items-end justify-center gap-4 min-w-[150px]">
                                    @php
                                        $statusStyles = [
                                            1 => 'bg-amber-50 text-amber-700 border-amber-200',
                                            2 => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            3 => 'bg-rose-50 text-rose-700 border-rose-200',
                                        ];
                                        $style = $statusStyles[$reserva->estado_id] ?? 'bg-slate-50 text-slate-600 border-slate-200';
                                    @endphp
                                    <div class="px-6 py-3 rounded-2xl text-[11px] font-black uppercase border-2 {{ $style }} shadow-xl tracking-widest w-full text-center">
                                        {{ $reserva->estado->nombre }}
                                    </div>
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Código Ref: #EVENT{{ $reserva->id }}</span>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
