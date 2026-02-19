<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-4 bg-rose-600 hover:bg-rose-500 text-white rounded-[1.5rem] font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-rose-600/40 active:scale-95 focus:outline-none focus:ring-4 focus:ring-rose-500 transition-all duration-300 hover:-translate-y-1']) }}>
    {{ $slot }}
</button>
