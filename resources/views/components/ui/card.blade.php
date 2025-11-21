@props(['padded' => true])

@php
    $base = 'bg-card text-card-foreground border border-border shadow-sm overflow-hidden';
    $classes = $padded ? $base . ' rounded-lg' : $base;
@endphp

<div {{ $attributes->class($classes) }}>
    {{ $slot }}
</div>
