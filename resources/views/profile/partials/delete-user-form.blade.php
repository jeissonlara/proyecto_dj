<section class="space-y-6">
    <header>
        <h2 class="text-xl font-black text-white italic uppercase tracking-tight">
            {{ __('Clausura de Cuenta') }}
        </h2>

        <p class="mt-2 text-[10px] font-bold text-rose-400 uppercase tracking-widest leading-normal">
            {{ __('Una vez eliminada, toda la información y riders técnicos serán purgados de forma permanente.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-white italic uppercase tracking-tight mb-4">
                {{ __('¿Confirmar purga total?') }}
            </h2>

            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-loose">
                {{ __('Introduce tu clave para autorizar la desconexión definitiva de tu identidad del sistema.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
