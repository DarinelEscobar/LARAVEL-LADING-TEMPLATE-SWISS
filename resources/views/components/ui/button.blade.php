@props([
    'variant' => 'default',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'icon' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md font-medium transition-all duration-200 disabled:opacity-50 disabled:pointer-events-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-ring active:scale-95';

    $variants = [
        'default' => 'bg-primary text-primary-foreground shadow hover:bg-primary/90',
        'destructive' => 'bg-destructive text-destructive-foreground shadow-sm hover:bg-destructive/90',
        'outline' => 'border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground',
        'secondary' => 'bg-secondary text-secondary-foreground shadow-sm hover:bg-secondary/80',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground',
        'link' => 'text-primary underline-offset-4 hover:underline',
    ];

    $sizes = [
        'sm' => 'h-8 px-3 text-xs',
        'md' => 'h-9 px-4 py-2 text-sm',
        'lg' => 'h-10 px-8 text-base',
        'icon' => 'h-9 w-9',
    ];

    $componentClasses = trim($baseClasses . ' ' . ($variants[$variant] ?? $variants['default']) . ' ' . ($sizes[$size] ?? $sizes['md']));
    $componentTag = $href ? 'a' : 'button';
@endphp

<{{ $componentTag }}
    @if (!$href)
        type="{{ $type }}"
    @endif
    {{ $attributes->class($componentClasses)->merge($href ? ['href' => $href] : []) }}>
    @if($icon)
        <x-ui.icon :name="$icon" class="w-4 h-4" />
    @endif
    {{ $slot }}
</{{ $componentTag }}>
