@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/5 border-white/20 px-6 py-4 text-white text-lg placeholder:text-white/20 placeholder:font-black focus:border-neon-purple focus:ring-4 focus:ring-neon-purple/30 rounded-[1.5rem] shadow-2xl backdrop-blur-xl transition-all duration-300 font-bold']) }}>
