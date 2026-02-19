@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-3 border-l-4 border-purple-500 text-start text-sm font-black italic uppercase tracking-tighter text-white bg-purple-500/10 focus:outline-none focus:bg-purple-500/20 transition duration-150 ease-in-out'
            : 'block w-full ps-4 pe-4 py-3 border-l-4 border-transparent text-start text-sm font-bold uppercase tracking-widest text-slate-500 hover:text-slate-300 hover:bg-white/5 hover:border-white/10 focus:outline-none focus:text-slate-300 focus:bg-white/5 focus:border-white/10 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
