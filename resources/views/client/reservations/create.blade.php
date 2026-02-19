<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nueva Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6">
            <div class="glass-card rounded-[3rem] border-white/10 shadow-3xl overflow-hidden relative">
                <div class="absolute top-0 right-0 w-64 h-64 bg-purple-600/5 blur-[100px] -mr-32 -mt-32 rounded-full"></div>
                
                <div class="p-12 border-b border-white/5 relative z-10">
                    <h1 class="text-4xl font-black text-white tracking-tighter italic uppercase leading-none">Nueva Solicitud <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">Live</span></h1>
                    <p class="text-[10px] font-black text-slate-500 mt-4 uppercase tracking-[0.3em] leading-none">Booking Form • Remix Crossover Experience</p>
                </div>

                <div class="p-12 relative z-10">


                    <form action="{{ route('client.reservations.store') }}" method="POST" class="space-y-12">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <!-- Plan Selection -->
                            <div class="space-y-4">
                                <label for="plan_id" class="block text-[9px] font-black text-slate-500 uppercase tracking-[0.3em]">Plan de Servicios</label>
                                <select name="plan_id" id="plan_id" class="w-full bg-white/5 border-white/10 text-white rounded-2xl focus:ring-purple-500 focus:border-purple-500 transition-all font-bold p-5 appearance-none backdrop-blur-xl">
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}" class="bg-slate-900">{{ $plan->nombre }} - ${{ number_format($plan->precio, 2) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Selection -->
                            <div class="space-y-4">
                                <label for="fecha_evento" class="block text-[9px] font-black text-slate-500 uppercase tracking-[0.3em]">Fecha del Evento</label>
                                <input type="date" name="fecha_evento" id="fecha_evento" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full bg-white/5 border-white/10 text-white rounded-2xl focus:ring-purple-500 focus:border-purple-500 transition-all font-bold p-5 backdrop-blur-xl selection:bg-purple-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <!-- Phone -->
                            <div class="space-y-4">
                                <label for="telefono_cliente" class="block text-[9px] font-black text-slate-500 uppercase tracking-[0.3em]">WhatsApp / Contacto</label>
                                <input type="text" name="telefono_cliente" id="telefono_cliente" placeholder="Ej: +593 999 888 777" class="w-full bg-white/5 border-white/10 text-white placeholder:text-slate-600 rounded-2xl focus:ring-purple-500 focus:border-purple-500 transition-all font-extrabold p-5 backdrop-blur-xl">
                            </div>

                            <!-- Address -->
                            <div class="space-y-4">
                                <label for="direccion_evento" class="block text-[9px] font-black text-slate-500 uppercase tracking-[0.3em]">Localización GPS</label>
                                <input type="text" name="direccion_evento" id="direccion_evento" placeholder="Ej: Salón Garden, Av. Amazonas N32" class="w-full bg-white/5 border-white/10 text-white placeholder:text-slate-600 rounded-2xl focus:ring-purple-500 focus:border-purple-500 transition-all font-extrabold p-5 backdrop-blur-xl">
                            </div>
                        </div>

                        <!-- Observations -->
                        <div class="space-y-4">
                            <label for="observaciones" class="block text-[9px] font-black text-slate-500 uppercase tracking-[0.3em]">Tech Rider / Notas</label>
                            <textarea name="observaciones" id="observaciones" rows="5" placeholder="Indícanos el tipo de evento, número de invitados, género musical..." class="w-full bg-white/5 border-white/10 text-white placeholder:text-slate-600 rounded-3xl focus:ring-purple-500 focus:border-purple-500 transition-all font-bold p-6 leading-relaxed backdrop-blur-xl"></textarea>
                        </div>

                        <div class="pt-10 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-10">
                            <div class="flex items-center text-slate-500 group">
                                <div class="p-4 bg-amber-500/10 rounded-2xl mr-5 border border-amber-500/20 shadow-sm group-hover:bg-amber-500/20 transition-colors">
                                    <svg class="w-6 h-6 text-amber-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-[10px] font-black uppercase tracking-widest leading-loose">Verificación en curso • Todas las <br class="hidden md:block"> solicitudes requieren aprobación técnica.</p>
                            </div>
                            <button type="submit" class="w-full md:w-auto px-12 py-6 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full font-black hover:scale-105 transition-all shadow-2xl shadow-purple-600/40 active:scale-95 text-xs uppercase tracking-[0.2em] glow-purple">
                                Enviar Solicitud
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
