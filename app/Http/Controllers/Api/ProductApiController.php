<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::query()
            ->latest('id')
            ->get();

        return response()->json($products);
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return response()->json($product, 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        return response()->json($product->fresh());
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
