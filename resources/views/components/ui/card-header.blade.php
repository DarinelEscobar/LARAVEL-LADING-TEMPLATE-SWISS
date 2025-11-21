@props(['align' => 'start'])

@php
    $alignment = $align === 'center' ? 'items-center text-center' : 'items-start';
@endphp

<div {{ $attributes->class("flex flex-col space-y-2 p-6 {$alignment}") }}>
    {{ $slot }}
</div>
