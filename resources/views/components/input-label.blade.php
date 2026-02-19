<label {{ $attributes->merge(['class' => 'block font-black text-sm uppercase tracking-[0.2em] text-white italic']) }}>
    {{ $value ?? $slot }}
</label>
