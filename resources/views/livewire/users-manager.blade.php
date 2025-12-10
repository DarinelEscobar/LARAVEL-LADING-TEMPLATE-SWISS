<div>
    <div class="space-y-4">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <div class="w-full sm:w-1/3">
                <x-ui.input wire:model.live.debounce.300ms="search" placeholder="Search users..." class="w-full">
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
                    New User
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
                            <th scope="col" class="px-6 py-3 cursor-pointer hover:text-foreground hover:bg-muted/80 transition-colors" wire:click="sortBy('email')">
                                <div class="flex items-center gap-1">
                                    Email
                                    @if ($sortField === 'email')
                                        <x-ui.icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="w-3 h-3" />
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer hover:text-foreground hover:bg-muted/80 transition-colors" wire:click="sortBy('created_at')">
                                <div class="flex items-center gap-1">
                                    Date
                                    @if ($sortField === 'created_at')
                                        <x-ui.icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="w-3 h-3" />
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse ($users as $user)
                            <tr class="bg-card hover:bg-muted/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-muted-foreground">#{{ $user->id }}</td>
                                <td class="px-6 py-4 font-medium text-foreground">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-muted-foreground">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-muted-foreground">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <x-ui.button wire:click="edit({{ $user->id }})" variant="ghost" size="sm" class="h-8 w-8 p-0">
                                            <x-ui.icon name="pencil" class="w-4 h-4 text-blue-500" />
                                        </x-ui.button>
                                        <x-ui.button wire:click="confirmDeletion({{ $user->id }})" variant="ghost" size="sm" class="h-8 w-8 p-0">
                                            <x-ui.icon name="trash" class="w-4 h-4 text-destructive" />
                                        </x-ui.button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-muted-foreground">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <x-ui.icon name="search-x" class="w-8 h-8 opacity-50" />
                                        <p>No users found matching "{{ $search }}"</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="p-4 border-t border-border">
                    {{ $users->links() }}
                </div>
            @endif
        </x-ui.card>
    </div>

    <!-- User Modal -->
    <x-ui.modal name="user-modal" :title="$isEditing ? 'Edit User' : 'Create User'" maxWidth="lg">
        <form wire:submit="save" class="space-y-4">
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">First Name(s)</label>
                    <x-ui.input wire:model="person_names" class="mt-1" placeholder="John" :error="$errors->has('person_names')" />
                    @error('person_names') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Last Name(s)</label>
                    <x-ui.input wire:model="person_surnames" class="mt-1" placeholder="Doe" :error="$errors->has('person_surnames')" />
                    @error('person_surnames') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
                <x-ui.input type="email" wire:model="email" class="mt-1" placeholder="name@example.com" :error="$errors->has('email')" />
                @error('email') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Password</label>
                <x-ui.input type="password" wire:model="password" class="mt-1" placeholder="••••••••" :error="$errors->has('password')" />
                @if($isEditing)
                    <p class="text-[10px] text-muted-foreground mt-1">Leave blank to keep current password.</p>
                @endif
                @error('password') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end pt-2">
                 <x-ui.button type="submit">
                    {{ $isEditing ? 'Update User' : 'Create User' }}
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>

    <!-- Delete Confirmation -->
    <x-ui.confirmation
        name="delete-confirmation"
        title="Delete User"
        description="Are you sure you want to delete this user? This action cannot be undone."
        confirmText="Delete User"
        method="delete"
    />
</div>
