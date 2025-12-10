@props([
    'name',
    'title' => '',
    'description' => '',
    'maxWidth' => '2xl'
])

@php
    $maxWidths = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '4xl' => 'sm:max-w-4xl',
        '6xl' => 'sm:max-w-6xl',
    ];
    $maxWidthClass = $maxWidths[$maxWidth] ?? $maxWidths['2xl'];
@endphp

<div
    x-data="{ show: false, name: '{{ $name }}' }"
    x-show="show"
    x-on:open-modal.window="show = ($event.detail.name === name)"
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
>
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
    >
        <div class="absolute inset-0 bg-background/80 backdrop-blur-sm"></div>
    </div>

    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="mb-6 transform overflow-hidden rounded-lg border border-border bg-background shadow-lg transition-all sm:mx-auto sm:w-full {{ $maxWidthClass }}"
    >
        @if($title)
        <div class="flex flex-col space-y-1.5 p-6 pb-2">
            <h3 class="font-semibold leading-none tracking-tight">{{ $title }}</h3>
            @if($description)
                <p class="text-sm text-muted-foreground">{{ $description }}</p>
            @endif
        </div>
        @endif

        <div class="p-6 pt-2">
            {{ $slot }}
        </div>
    </div>
</div>
