<div>
    <div class="space-y-4">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <div class="w-full sm:w-1/3">
                <x-ui.input wire:model.live.debounce.300ms="search" placeholder="Search status types..." class="w-full">
                    <x-slot name="icon">
                        <x-ui.icon name="search" class="text-muted-foreground" />
                    </x-slot>
                </x-ui.input>
            </div>
            <div class="flex items-center gap-2">
                <label class="text-sm text-muted-foreground">Per Page:</label>
                <select wire:model.live="perPage" class="bg-background border border-input rounded-md text-sm focus:ring-primary focus:border-primary">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <x-ui.button wire:click="create" variant="default" class="w-full sm:w-auto">
                    <x-ui.icon name="plus" class="w-4 h-4 mr-2" />
                    New Status Type
                </x-ui.button>
            </div>
        </div>

        <x-ui.card class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-muted-foreground uppercase bg-muted/50 border-b border-border">
                        <tr>
                            <th scope="col" class="px-6 py-3 cursor-pointer hover:text-foreground hover:bg-muted/80 transition-colors" wire:click="sortBy('id')">
                                <div class="flex items-center gap-1">
                                    ID
                                    @if ($sortField === 'id')
                                        <x-ui.icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="w-3 h-3" />
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer hover:text-foreground hover:bg-muted/80 transition-colors" wire:click="sortBy('name')">
                                <div class="flex items-center gap-1">
                                    Name
                                    @if ($sortField === 'name')
                                        <x-ui.icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="w-3 h-3" />
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse ($statusTypes as $type)
                            <tr class="bg-card hover:bg-muted/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-muted-foreground">#{{ $type->id }}</td>
                                <td class="px-6 py-4 font-medium text-foreground">{{ $type->name }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <x-ui.button wire:click="edit({{ $type->id }})" variant="ghost" size="sm" class="h-8 w-8 p-0">
                                            <x-ui.icon name="pencil" class="w-4 h-4 text-blue-500" />
                                        </x-ui.button>
                                        <x-ui.button wire:click="confirmDeletion({{ $type->id }})" variant="ghost" size="sm" class="h-8 w-8 p-0">
                                            <x-ui.icon name="trash" class="w-4 h-4 text-destructive" />
                                        </x-ui.button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-muted-foreground">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <x-ui.icon name="search-x" class="w-8 h-8 opacity-50" />
                                        <p>No status types found matching "{{ $search }}"</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($statusTypes->hasPages())
                <div class="p-4 border-t border-border">
                    {{ $statusTypes->links() }}
                </div>
            @endif
        </x-ui.card>
    </div>

    <!-- Status Type Modal -->
    <x-ui.modal name="status-type-modal" :title="$isEditing ? 'Edit Status Type' : 'Create Status Type'" maxWidth="lg">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Name</label>
                <x-ui.input wire:model="name" class="mt-1" placeholder="Active, Pending..." :error="$errors->has('name')" />
                @error('name') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end pt-2">
                 <x-ui.button type="submit">
                    {{ $isEditing ? 'Update' : 'Create' }}
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>

    <!-- Delete Confirmation -->
    <x-ui.confirmation
        name="delete-confirmation"
        title="Delete Status Type"
        description="Are you sure you want to delete this status type? This action cannot be undone."
        confirmText="Delete"
        method="delete"
    />
</div>
