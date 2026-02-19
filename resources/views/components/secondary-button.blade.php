<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-8 py-4 bg-white/10 hover:bg-white/20 border border-white/20 rounded-[1.5rem] font-black text-sm text-white uppercase tracking-[0.2em] shadow-xl backdrop-blur-md focus:outline-none focus:ring-4 focus:ring-white/20 disabled:opacity-25 transition-all duration-300 hover:-translate-y-1']) }}>
    {{ $slot }}
</button>
