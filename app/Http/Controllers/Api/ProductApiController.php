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
            ->paginate(10);

        return \App\Http\Responses\ApiResponse::success($products);
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return \App\Http\Responses\ApiResponse::success($product, 'Product created successfully', 201);
    }

    public function show(Product $product): JsonResponse
    {
        return \App\Http\Responses\ApiResponse::success($product);
    }

    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        return \App\Http\Responses\ApiResponse::success($product->fresh(), 'Product updated successfully');
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return \App\Http\Responses\ApiResponse::success(null, 'Product deleted successfully', 200);
    }
}
