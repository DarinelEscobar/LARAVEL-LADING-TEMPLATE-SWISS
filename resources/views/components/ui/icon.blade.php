@props(['name', 'class' => 'w-5 h-5'])

<div {{ $attributes->merge(['class' => 'inline-flex items-center justify-center']) }}>
    @if (str_starts_with($name, 'heroicon-'))
        @php $iconName = str_replace('heroicon-', '', $name); @endphp
        <x-dynamic-component :component="'heroicon-o-' . $iconName" :class="$class" />
    @else
        <x-dynamic-component :component="'lucide-' . $name" :class="$class" />
    @endif
</div>
