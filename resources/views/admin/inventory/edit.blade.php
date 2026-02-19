<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Equipo') }}: {{ $equipo->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.inventory.update', $equipo) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nombre" :value="__('Nombre del Equipo')" />
                                <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $equipo->nombre)" required />
                                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="tipo" :value="__('Tipo')" />
                                <select id="tipo" name="tipo" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="sonido" {{ $equipo->tipo == 'sonido' ? 'selected' : '' }}>Sonido</option>
                                    <option value="iluminacion" {{ $equipo->tipo == 'iluminacion' ? 'selected' : '' }}>Iluminación</option>
                                    <option value="accesorio" {{ $equipo->tipo == 'accesorio' ? 'selected' : '' }}>Accesorio</option>
                                </select>
                                <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="cantidad_total" :value="__('Cantidad Total')" />
                                <x-text-input id="cantidad_total" class="block mt-1 w-full" type="number" name="cantidad_total" :value="old('cantidad_total', $equipo->cantidad_total)" required min="1" />
                                <x-input-error :messages="$errors->get('cantidad_total')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="estado" :value="__('Estado')" />
                                <select id="estado" name="estado" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="disponible" {{ $equipo->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                    <option value="mantenimiento" {{ $equipo->estado == 'mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
                                    <option value="inactivo" {{ $equipo->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                            </div>

                            <div class="col-span-2">
                                <x-input-label for="descripcion" :value="__('Descripción')" />
                                <textarea id="descripcion" name="descripcion" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('descripcion', $equipo->descripcion) }}</textarea>
                                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <x-primary-button>
                                {{ __('Actualizar Equipo') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
