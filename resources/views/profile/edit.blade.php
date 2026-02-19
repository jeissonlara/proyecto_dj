<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">
            
            <div class="relative mb-12">
                <h1 class="text-4xl font-black text-white tracking-tighter italic uppercase">Ajustes de <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">Perfil</span></h1>
                <p class="text-slate-400 mt-2 font-bold uppercase tracking-[0.2em] text-[10px]">Gestión de identidad y seguridad</p>
                <div class="absolute -left-6 top-1/2 -translate-y-1/2 w-1.5 h-10 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full"></div>
            </div>

            <div class="p-10 glass-card border-white/10 shadow-3xl rounded-[2.5rem] relative overflow-hidden group transition-all duration-500 hover:border-purple-500/20">
                <div class="absolute top-0 right-0 w-64 h-64 bg-purple-600/5 blur-[80px] -mr-32 -mt-32 rounded-full group-hover:bg-purple-600/10 transition-colors"></div>
                <div class="max-w-xl relative z-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-10 glass-card border-white/10 shadow-3xl rounded-[2.5rem] relative overflow-hidden group transition-all duration-500 hover:border-purple-500/20">
                <div class="absolute top-0 right-0 w-64 h-64 bg-pink-600/5 blur-[80px] -mr-32 -mt-32 rounded-full group-hover:bg-pink-600/10 transition-colors"></div>
                <div class="max-w-xl relative z-10">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-10 glass-card border-white/10 shadow-3xl rounded-[2.5rem] border border-rose-500/5 relative overflow-hidden group transition-all duration-500 hover:border-rose-500/20">
                <div class="max-w-xl relative z-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
