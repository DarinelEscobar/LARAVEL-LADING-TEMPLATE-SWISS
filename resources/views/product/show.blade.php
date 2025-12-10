@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Product Details</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Name
                </label>
                <p class="text-gray-900 border-b pb-2">{{ $product->name }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Description
                </label>
                <p class="text-gray-900 border-b pb-2">{{ $product->description }}</p>
            </div>
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Price
                    </label>
                    <p class="text-gray-900 border-b pb-2">${{ number_format($product->price, 2) }}</p>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Stock
                    </label>
                    <p class="text-gray-900 border-b pb-2">{{ $product->stock }}</p>
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="{{ route('products.edit', $product) }}">
                    Edit
                </a>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('products.index') }}">
                    Back to List
                </a>
            </div>
        </div>
    </div>
@endsection
