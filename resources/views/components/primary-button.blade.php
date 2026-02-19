<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-10 py-5 bg-gradient-to-r from-purple-600 to-pink-600 border border-transparent rounded-[2.5rem] font-black text-base text-white uppercase tracking-[0.2em] hover:from-purple-500 hover:to-pink-500 active:from-purple-700 active:to-pink-700 focus:outline-none focus:ring-4 focus:ring-purple-500/50 transition-all duration-300 shadow-[0_20px_40px_rgba(147,51,234,0.4)] hover:shadow-[0_25px_50px_rgba(147,51,234,0.6)] hover:-translate-y-1']) }}>
    {{ $slot }}
</button>
