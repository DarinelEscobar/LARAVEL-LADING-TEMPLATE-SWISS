@props([
    'name',
    'title' => 'Are you sure?',
    'description' => 'This action cannot be undone.',
    'confirmText' => 'Delete',
    'cancelText' => 'Cancel',
    'method' => null,
])

<x-ui.modal :name="$name" :title="$title" :description="$description" maxWidth="md">
    <div class="flex justify-end gap-3 mt-4">
        <x-ui.button variant="outline" x-on:click="$dispatch('close-modal')">
            {{ $cancelText }}
        </x-ui.button>

        @if($method)
            <x-ui.button variant="destructive" wire:click="{{ $method }}">
                {{ $confirmText }}
            </x-ui.button>
        @else
            <x-ui.button variant="destructive" type="submit">
                {{ $confirmText }}
            </x-ui.button>
        @endif
    </div>
</x-ui.modal>
