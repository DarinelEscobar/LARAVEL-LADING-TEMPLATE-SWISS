<div>
    <div class="space-y-4">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <div class="w-full sm:w-1/3">
                <x-ui.input wire:model.live.debounce.300ms="search" placeholder="Search products..." class="w-full">
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
                    New Product
                </x-ui.button>
            </div>
        </div>

        <x-ui.card class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-muted-foreground uppercase bg-muted/50 border-b border-border">
                        <tr>
                            <th scope="col" class="px-6 py-3 cursor-pointer hover:text-foreground hover:bg-muted/80 transition-colors" wire:click="sortBy('name')">
                                <div class="flex items-center gap-1">
                                    Product Name
                                    @if ($sortField === 'name')
                                        <x-ui.icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="w-3 h-3" />
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer hover:text-foreground hover:bg-muted/80 transition-colors" wire:click="sortBy('price')">
                                <div class="flex items-center gap-1">
                                    Price
                                    @if ($sortField === 'price')
                                        <x-ui.icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="w-3 h-3" />
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer hover:text-foreground hover:bg-muted/80 transition-colors" wire:click="sortBy('stock')">
                                <div class="flex items-center gap-1">
                                    Stock
                                    @if ($sortField === 'stock')
                                        <x-ui.icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="w-3 h-3" />
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse ($products as $product)
                            <tr class="bg-card hover:bg-muted/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-foreground">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs">
                                            <x-ui.icon name="package" class="w-4 h-4" />
                                        </div>
                                        <div>
                                            <div class="font-medium">{{ $product->name }}</div>
                                            <div class="text-xs text-muted-foreground truncate max-w-[200px]">{{ $product->description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-muted-foreground font-mono">${{ number_format($product->price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <x-ui.badge :variant="$product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'destructive')">
                                        {{ $product->stock }} in stock
                                    </x-ui.badge>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <x-ui.button wire:click="edit({{ $product->id }})" variant="ghost" size="sm" class="h-8 w-8 p-0">
                                            <x-ui.icon name="pencil" class="w-4 h-4 text-blue-500" />
                                        </x-ui.button>
                                        <x-ui.button wire:click="confirmDeletion({{ $product->id }})" variant="ghost" size="sm" class="h-8 w-8 p-0">
                                            <x-ui.icon name="trash" class="w-4 h-4 text-destructive" />
                                        </x-ui.button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-muted-foreground">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <x-ui.icon name="package-x" class="w-8 h-8 opacity-50" />
                                        <p>No products found matching "{{ $search }}"</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($products->hasPages())
                <div class="p-4 border-t border-border">
                    {{ $products->links() }}
                </div>
            @endif
        </x-ui.card>
    </div>

    <!-- Product Modal -->
    <x-ui.modal name="product-modal" :title="$isEditing ? 'Edit Product' : 'Create Product'" maxWidth="lg">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Product Name</label>
                <x-ui.input wire:model="name" class="mt-1" placeholder="Wireless Headphones" :error="$errors->has('name')" />
                @error('name') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Description</label>
                <x-ui.textarea wire:model="description" class="mt-1" placeholder="Product details..." :error="$errors->has('description')" />
                @error('description') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Price ($)</label>
                    <x-ui.input type="number" step="0.01" wire:model="price" class="mt-1" placeholder="99.99" :error="$errors->has('price')" />
                    @error('price') <span class="text-sm text-destructive">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Stock</label>
                    <x-ui.input type="number" wire:model="stock" class="mt-1" placeholder="10" :error="$errors->has('stock')" />
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
