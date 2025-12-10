<div>
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold tracking-tight">Users</h2>
            <x-ui.button wire:click="create" icon="plus">
                Add User
            </x-ui.button>
        </div>

        <div class="flex items-center space-x-2">
             <div class="relative w-full max-w-sm">
                 <x-ui.icon name="search" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground" />
                 <x-ui.input
                    type="search"
                    placeholder="Search users..."
                    class="pl-8"
                    wire:model.live.debounce.300ms="search"
                />
            </div>
        </div>

        <x-ui.card class="p-0">
            <x-ui.table :headers="['ID', 'Name', 'Email', 'Created At', 'Actions']">
                @forelse($users as $user)
                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <td class="p-4 align-middle font-medium">{{ $user->id }}</td>
                        <td class="p-4 align-middle">{{ $user->name }}</td>
                        <td class="p-4 align-middle">{{ $user->email }}</td>
                        <td class="p-4 align-middle">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="p-4 align-middle">
                            <div class="flex items-center gap-2">
                                <x-ui.button variant="ghost" size="icon" wire:click="edit({{ $user->id }})">
                                    <x-ui.icon name="pencil" class="w-4 h-4" />
                                </x-ui.button>
                                <x-ui.button variant="ghost" size="icon" wire:click="confirmDeletion({{ $user->id }})">
                                    <x-ui.icon name="trash" class="w-4 h-4 text-destructive" />
                                </x-ui.button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-muted-foreground">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </x-ui.table>
        </x-ui.card>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

    <!-- User Modal -->
    <x-ui.modal name="user-modal" :title="$isEditing ? 'Edit User' : 'Create User'" maxWidth="lg">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Name</label>
                <x-ui.input wire:model="name" class="mt-1" placeholder="John Doe" :error="$errors->has('name')" />
                @error('name') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
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
