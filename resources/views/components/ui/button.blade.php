@props([
    'variant' => 'default',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
])

@php
    $baseClasses =
        'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-none font-medium uppercase tracking-[0.2em] transition-all duration-200 disabled:opacity-50 disabled:pointer-events-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-ring';

    $variants = [
        'default' => 'bg-primary text-primary-foreground border border-primary hover:bg-primary/90',
        'outline' => 'border border-foreground/50 bg-transparent text-foreground hover:bg-foreground hover:text-background',
        'ghost' => 'border border-transparent bg-transparent text-foreground hover:bg-muted hover:text-foreground',
        'link' => 'border-transparent bg-transparent text-primary underline underline-offset-4 hover:text-primary/80 px-0',
    ];

    $sizes = [
        'sm' => 'text-[11px] px-3 py-2 leading-none',
        'md' => 'text-[11px] px-5 py-3 leading-none',
        'lg' => 'text-xs px-6 py-4 leading-none',
        'icon' => 'text-sm p-2 rounded-full',
    ];

    $componentClasses = trim($baseClasses . ' ' . ($variants[$variant] ?? $variants['default']) . ' ' . ($sizes[$size] ?? $sizes['md']));
    $componentTag = $href ? 'a' : 'button';
@endphp

<{{ $componentTag }}
    @if (!$href)
        type="{{ $type }}"
    @endif
    {{ $attributes->class($componentClasses)->merge($href ? ['href' => $href] : []) }}>
    {{ $slot }}
</{{ $componentTag }}>
