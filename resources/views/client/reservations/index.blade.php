<x-app-layout>

    <div class="space-y-10">

        <!-- Header Card -->
        <div class="glass-card rounded-[2.5rem] border-white/10 p-10 relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 p-8 text-purple-500/10">
                <svg class="w-40 h-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                </svg>
            </div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-5xl font-black text-white tracking-tighter italic uppercase drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">
                        Mis <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-500 to-purple-400">Eventos</span>
                    </h1>
                    <p class="text-slate-400 font-black uppercase tracking-[0.4em] text-xs mt-3 italic">
                        Historial y seguimiento en tiempo real de tus reservas
                    </p>
                </div>
                <a href="{{ route('client.reservations.create') }}"
                   class="px-10 py-5 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] shadow-2xl shadow-purple-600/40 hover:scale-105 transition-all flex items-center gap-4 group">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva Reserva
                </a>
            </div>
        </div>

        <!-- Reservations List -->
        <div class="space-y-6">
            @if($reservations->isEmpty())
                <div class="glass-card rounded-[2.5rem] border-white/10 p-24 text-center shadow-2xl">
                    <div class="inline-flex p-6 bg-white/5 rounded-[2rem] mb-6 border border-white/10">
                        <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black text-white tracking-tighter uppercase">¡Lánzate a la pista!</h4>
                    <p class="text-slate-500 font-medium mt-2 max-w-sm mx-auto">
                        Todavía no has realizado ninguna reserva. Crea tu primera solicitud y nos encargaremos del resto.
                    </p>
                </div>
            @else
                @php
                    $statusStyles = [
                        \App\Models\EstadoReserva::PENDIENTE  => 'bg-amber-500/10 text-amber-400 border-amber-500/30 shadow-[0_0_15px_rgba(245,158,11,0.1)]',
                        \App\Models\EstadoReserva::CONFIRMADA => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30 shadow-[0_0_15px_rgba(16,185,129,0.1)]',
                        \App\Models\EstadoReserva::RECHAZADA  => 'bg-rose-500/10 text-rose-400 border-rose-500/30 shadow-[0_0_15px_rgba(244,63,94,0.1)]',
                        \App\Models\EstadoReserva::FINALIZADA => 'bg-blue-500/10 text-blue-400 border-blue-500/30 shadow-[0_0_15px_rgba(59,130,246,0.1)]',
                    ];
                    $feedbackMessages = [
                        \App\Models\EstadoReserva::PENDIENTE  => 'Tu reserva está siendo revisada por el administrador. Espera nuestra validación pronto.',
                        \App\Models\EstadoReserva::CONFIRMADA => '¡Todo listo! El equipo y tu DJ ya están reservados para tu evento.',
                        \App\Models\EstadoReserva::RECHAZADA  => 'Lamentablemente no pudimos procesar tu reserva. Contacta a soporte para más detalles.',
                        \App\Models\EstadoReserva::FINALIZADA => '¡Evento completado exitosamente! Gracias por confiar en nosotros.',
                    ];
                @endphp

                @foreach($reservations as $reserva)
                    @php
                        $statusStyle = $statusStyles[$reserva->estado_id] ?? 'bg-white/5 text-slate-400 border-white/10';
                        $feedback    = $feedbackMessages[$reserva->estado_id] ?? 'Estado desconocido.';
                        // Personalize confirmed message with DJ name if available
                        if ($reserva->estado_id === \App\Models\EstadoReserva::CONFIRMADA && $reserva->dj) {
                            $feedback = "¡Todo listo! El equipo y tu DJ {$reserva->dj->name} ya están reservados para tu evento.";
                        }
                    @endphp

                    <div class="glass-card rounded-[2.5rem] border-white/10 p-8 transition-all hover:border-purple-500/30 group relative overflow-hidden shadow-2xl hover:shadow-purple-500/10">
                        <div class="flex flex-col md:flex-row items-center gap-8">

                            <!-- Date Badge -->
                            <div class="flex-shrink-0 flex md:flex-col items-center gap-4">
                                <div class="w-20 h-20 bg-white/5 rounded-[1.5rem] flex flex-col items-center justify-center border border-white/10 group-hover:bg-purple-600/20 group-hover:border-purple-500/40 transition-all shadow-xl">
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                        {{ \Carbon\Carbon::parse($reserva->fecha_evento)->translatedFormat('M') }}
                                    </span>
                                    <span class="text-3xl font-black text-white leading-tight">
                                        {{ \Carbon\Carbon::parse($reserva->fecha_evento)->format('d') }}
                                    </span>
                                </div>
                                <div class="h-12 w-0.5 bg-white/10 rounded-full hidden md:block"></div>
                            </div>

                            <!-- Main Info -->
                            <div class="flex-1 space-y-5">
                                <!-- Plan + Address -->
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="px-4 py-1.5 bg-purple-500/10 text-purple-400 rounded-xl text-[10px] font-black uppercase tracking-[0.3em] border border-purple-500/20">
                                        {{ $reserva->plan->nombre }}
                                    </span>
                                    <span class="text-white/20">|</span>
                                    <span class="text-sm font-black text-slate-300 tracking-tight">
                                        📍 {{ Str::limit($reserva->direccion_evento, 50) }}
                                    </span>
                                </div>

                                <!-- Feedback + DJ -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Feedback del DJ</p>
                                        <p class="text-xs font-medium text-slate-300 leading-relaxed italic border-l-2 border-purple-500/40 pl-4 bg-white/3 py-3 rounded-r-xl">
                                            "{{ $feedback }}"
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Personal Asignado</p>
                                        @if($reserva->dj)
                                            <div class="flex items-center bg-white/5 p-3 rounded-2xl border border-white/10 shadow-sm w-fit">
                                                <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-400 font-black text-sm mr-3 border border-purple-500/20">
                                                    {{ strtoupper(substr($reserva->dj->name, 0, 1)) }}
                                                </div>
                                                <span class="text-xs font-black text-white uppercase tracking-tighter">{{ $reserva->dj->name }}</span>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-600 italic">Por asignar</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex flex-col items-center md:items-end justify-center gap-3 flex-shrink-0 min-w-[160px]">
                                <div class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border {{ $statusStyle }} w-full text-center">
                                    {{ $reserva->estado->nombre }}
                                </div>
                                <span class="text-[9px] font-black text-slate-600 uppercase tracking-widest">
                                    Ref #EVENT{{ str_pad($reserva->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

</x-app-layout>
