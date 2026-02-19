<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar Nuevo Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">
            
            <div class="relative mb-12">
                <h1 class="text-4xl font-black text-white tracking-tighter italic uppercase">Registro de <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">Activos</span></h1>
                <p class="text-slate-400 mt-2 font-bold uppercase tracking-[0.2em] text-[10px]">Ingreso técnico de hardware al ecosistema</p>
                <div class="absolute -left-6 top-1/2 -translate-y-1/2 w-1.5 h-10 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full shadow-[0_0_15px_rgba(168,85,247,0.5)]"></div>
            </div>

            <div class="glass-card rounded-[3rem] border-white/10 shadow-3xl overflow-hidden relative group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-purple-600/5 blur-[100px] -mr-32 -mt-32 rounded-full group-hover:bg-purple-600/10 transition-colors"></div>
                
                <div class="p-12 relative z-10">
                    <form method="POST" action="{{ route('admin.inventory.store') }}" class="space-y-10">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-3">
                                <x-input-label for="nombre" :value="__('Nombre del Equipo')" />
                                <x-text-input id="nombre" class="block w-full" type="text" name="nombre" :value="old('nombre')" required autofocus placeholder="Ej: Pioneer CDJ-3000" />
                                <x-input-error :messages="$errors->get('nombre')" class="mt-2 text-[10px] font-black uppercase" />
                            </div>

                            <div class="space-y-3">
                                <x-input-label for="tipo" :value="__('Categoría Hardware')" />
                                <select id="tipo" name="tipo" class="block w-full bg-white/5 border-white/10 text-white rounded-2xl focus:ring-purple-500 focus:border-purple-500 transition-all font-bold p-4 appearance-none backdrop-blur-xl">
                                    <option value="sonido" class="bg-slate-900">Audio / Sonido</option>
                                    <option value="iluminacion" class="bg-slate-900">Visuales / Iluminación</option>
                                    <option value="accesorio" class="bg-slate-900">Cabina / Accesorios</option>
                                </select>
                                <x-input-error :messages="$errors->get('tipo')" class="mt-2 text-[10px] font-black uppercase" />
                            </div>

                            <div class="space-y-3">
                                <x-input-label for="cantidad_total" :value="__('Unidades en Stock')" />
                                <x-text-input id="cantidad_total" class="block w-full" type="number" name="cantidad_total" :value="old('cantidad_total')" required min="1" placeholder="0" />
                                <x-input-error :messages="$errors->get('cantidad_total')" class="mt-2 text-[10px] font-black uppercase" />
                            </div>

                            <div class="space-y-3">
                                <x-input-label for="estado" :value="__('Estado Operativo')" />
                                <select id="estado" name="estado" class="block w-full bg-white/5 border-white/10 text-white rounded-2xl focus:ring-purple-500 focus:border-purple-500 transition-all font-bold p-4 appearance-none backdrop-blur-xl">
                                    <option value="disponible" class="bg-slate-900">Operativo / Disponible</option>
                                    <option value="mantenimiento" class="bg-slate-900">Under Care / Mantenimiento</option>
                                    <option value="inactivo" class="bg-slate-900">Offline / Inactivo</option>
                                </select>
                                <x-input-error :messages="$errors->get('estado')" class="mt-2 text-[10px] font-black uppercase" />
                            </div>

                            <div class="col-span-2 space-y-3">
                                <x-input-label for="descripcion" :value="__('Especificaciones Técnicas')" />
                                <textarea id="descripcion" name="descripcion" rows="4" class="block w-full bg-white/5 border-white/10 text-white rounded-3xl focus:ring-purple-500 focus:border-purple-500 transition-all font-bold p-6 backdrop-blur-xl shadow-inner placeholder:text-slate-600" placeholder="Detalles de gama, conexiones, potencia...">{{ old('descripcion') }}</textarea>
                                <x-input-error :messages="$errors->get('descripcion')" class="mt-2 text-[10px] font-black uppercase" />
                            </div>
                        </div>

                        <div class="mt-12 flex justify-end pt-8 border-t border-white/5">
                            <x-primary-button class="glow-purple">
                                {{ __('Guardar Activo') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
