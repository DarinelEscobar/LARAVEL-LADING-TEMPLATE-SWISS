<?php

namespace App\OpenApi\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Products",
 *     description="Product catalog management endpoints."
 * )
 */
class ProductCrud
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="List products",
     *     description="Returns every product currently stored. Supports dashboard table feeds.",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of products.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Product"))
     *     )
     * )
     */
    public function index(): void
    {
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Create a product",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductInput")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created.",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(response=422, description="Validation error.")
     * )
     */
    public function store(): void
    {
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Show a product",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Product ID",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product details.",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(response=404, description="Product not found.")
     * )
     */
    public function show(): void
    {
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     summary="Update a product",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Product ID",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductInput")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated resource.",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(response=404, description="Product not found.")
     * )
     */
    public function update(): void
    {
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Delete a product",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Product ID",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response=204, description="Deleted successfully."),
     *     @OA\Response(response=404, description="Product not found.")
     * )
     */
    public function destroy(): void
    {
    }
}
