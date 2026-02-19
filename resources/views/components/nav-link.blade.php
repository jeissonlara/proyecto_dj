@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-purple-500 text-sm font-black italic uppercase tracking-tighter leading-5 text-white focus:outline-none focus:border-purple-400 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold uppercase tracking-widest leading-5 text-slate-500 hover:text-slate-300 hover:border-white/10 focus:outline-none focus:text-slate-300 focus:border-white/20 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
