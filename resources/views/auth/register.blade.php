<x-guest-layout>
    <div class="mb-10 sm:mb-16 text-center">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-white italic uppercase tracking-tighter drop-shadow-[0_0_20px_rgba(255,255,255,0.3)] px-4">
            New <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-200 via-white to-purple-300">Talent</span>
        </h2>
        <p class="text-[10px] sm:text-xs font-black text-slate-300 uppercase tracking-[0.2em] sm:tracking-[0.4em] mt-4 sm:mt-6 leading-none italic px-4">Join the Remix Crossover Experience</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="DJ Alias / Full Name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contact@remix.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-2 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-2 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col-reverse sm:flex-row items-center justify-between gap-6 mt-8">
            <a class="text-[10px] font-black text-purple-400 hover:text-pink-400 uppercase tracking-widest transition-colors duration-300 decoration-purple-500/30 underline decoration-2 underline-offset-4" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="w-full sm:w-auto px-8 py-3 justify-center">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
