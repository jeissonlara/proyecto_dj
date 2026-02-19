<x-guest-layout>
    <!-- Session Status -->
    <div class="mb-10 sm:mb-16 text-center">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-white uppercase tracking-wide drop-shadow-[0_0_15px_rgba(255,255,255,0.25)] px-6 leading-tight">
            Acceso 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-200 via-white to-purple-300 block sm:inline">
                Session Master
            </span>
        </h2>

        <p class="text-[10px] sm:text-xs font-black text-slate-300 uppercase tracking-[0.2em] sm:tracking-[0.4em] mt-4 sm:mt-6 leading-none italic px-4">Identifícate para entrar a la cabina control</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Enlace de Correo')" />
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="dj@remix.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Clave de Acceso')" />
            <x-text-input id="password" class="block mt-2 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded-md bg-white/10 border-white/30 text-purple-600 shadow-sm focus:ring-purple-500 focus:ring-offset-slate-900 transition-all cursor-pointer" name="remember">
                <span class="ms-2 text-[10px] font-bold text-slate-300 uppercase tracking-widest group-hover:text-white transition-colors">{{ __('Mantener Sesión') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-[10px] font-black text-purple-400 hover:text-pink-400 uppercase tracking-widest transition-colors duration-300 decoration-purple-500/30 underline decoration-2 underline-offset-4" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste la clave?') }}
                </a>
            @endif
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-4">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
