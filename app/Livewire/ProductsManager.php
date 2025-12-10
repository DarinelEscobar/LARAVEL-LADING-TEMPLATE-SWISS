<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductsManager extends Component
{
    use WithPagination;

    // Search
    public $search = '';

    // Model Properties
    public $product_id;
    public $name;
    public $description;
    public $price;
    public $stock;

    // Modal States
    public $confirmingDeletion = false;
    public $managingProduct = false;
    public $isEditing = false;
    public $productToDeleteId;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.products-manager', [
            'products' => $products,
        ])->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetInputs();
        $this->isEditing = false;
        $this->managingProduct = true;
        $this->dispatch('open-modal', name: 'product-modal');
    }

    public function edit($id)
    {
        $this->resetInputs();
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;

        $this->isEditing = true;
        $this->managingProduct = true;
        $this->dispatch('open-modal', name: 'product-modal');
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        if ($this->isEditing) {
            $product = Product::findOrFail($this->product_id);
            $product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'stock' => $this->stock,
            ]);
            session()->flash('message', 'Product updated successfully.');
        } else {
            Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'stock' => $this->stock,
            ]);
            session()->flash('message', 'Product created successfully.');
        }

        $this->managingProduct = false;
        $this->dispatch('close-modal');
    }

    public function confirmDeletion($id)
    {
        $this->productToDeleteId = $id;
        $this->confirmingDeletion = true;
        $this->dispatch('open-modal', name: 'delete-confirmation');
    }

    public function delete()
    {
        $product = Product::findOrFail($this->productToDeleteId);
        $product->delete();

        $this->confirmingDeletion = false;
        $this->productToDeleteId = null;
        $this->dispatch('close-modal');
        session()->flash('message', 'Product deleted successfully.');
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->stock = '';
        $this->product_id = null;
    }
}
