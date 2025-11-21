@props(['for' => null])

<label @if ($for) for="{{ $for }}" @endif
    {{ $attributes->class('block text-[11px] uppercase tracking-[0.2em] text-muted-foreground font-semibold') }}>
    {{ $slot }}
</label>
