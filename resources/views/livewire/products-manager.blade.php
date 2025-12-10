<div>
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold tracking-tight">Products</h2>
            <x-ui.button wire:click="create" icon="plus">
                Add Product
            </x-ui.button>
        </div>

        <div class="flex items-center space-x-2">
             <div class="relative w-full max-w-sm">
                 <x-ui.icon name="search" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground" />
                 <x-ui.input
                    type="search"
                    placeholder="Search products..."
                    class="pl-8"
                    wire:model.live.debounce.300ms="search"
                />
            </div>
        </div>

        <x-ui.card class="p-0">
            <x-ui.table :headers="['ID', 'Name', 'Price', 'Stock', 'Actions']">
                @forelse($products as $product)
                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <td class="p-4 align-middle font-medium">{{ $product->id }}</td>
                        <td class="p-4 align-middle">
                            <div class="flex flex-col">
                                <span class="font-medium">{{ $product->name }}</span>
                                <span class="text-xs text-muted-foreground truncate max-w-[200px]">{{ $product->description }}</span>
                            </div>
                        </td>
                        <td class="p-4 align-middle">${{ number_format($product->price, 2) }}</td>
                        <td class="p-4 align-middle">
                            <x-ui.badge variant="{{ $product->stock > 10 ? 'secondary' : 'destructive' }}">
                                {{ $product->stock }}
                            </x-ui.badge>
                        </td>
                        <td class="p-4 align-middle">
                            <div class="flex items-center gap-2">
                                <x-ui.button variant="ghost" size="icon" wire:click="edit({{ $product->id }})">
                                    <x-ui.icon name="pencil" class="w-4 h-4" />
                                </x-ui.button>
                                <x-ui.button variant="ghost" size="icon" wire:click="confirmDeletion({{ $product->id }})">
                                    <x-ui.icon name="trash" class="w-4 h-4 text-destructive" />
                                </x-ui.button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-muted-foreground">
                            No products found.
                        </td>
                    </tr>
                @endforelse
            </x-ui.table>
        </x-ui.card>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Product Modal -->
    <x-ui.modal name="product-modal" :title="$isEditing ? 'Edit Product' : 'Create Product'" maxWidth="lg">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Name</label>
                <x-ui.input wire:model="name" class="mt-1" placeholder="Product Name" :error="$errors->has('name')" />
                @error('name') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Description</label>
                <x-ui.textarea wire:model="description" class="mt-1" placeholder="Product details..." :error="$errors->has('description')" />
                @error('description') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Price</label>
                    <x-ui.input type="number" step="0.01" wire:model="price" class="mt-1" placeholder="0.00" :error="$errors->has('price')" />
                    @error('price') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Stock</label>
                    <x-ui.input type="number" wire:model="stock" class="mt-1" placeholder="0" :error="$errors->has('stock')" />
                    @error('stock') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end pt-2">
                 <x-ui.button type="submit">
                    {{ $isEditing ? 'Update Product' : 'Create Product' }}
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>

    <!-- Delete Confirmation -->
    <x-ui.confirmation
        name="delete-confirmation"
        title="Delete Product"
        description="Are you sure you want to delete this product? This action cannot be undone."
        confirmText="Delete Product"
        method="delete"
    />
</div>
