<?php

namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Product",
 *     description="Persisted product resource.",
 *     @OA\Property(property="id", type="integer", format="int64", example=42),
 *     @OA\Property(property="name", type="string", maxLength=255, example="Swiss Precision Knife"),
 *     @OA\Property(property="description", type="string", nullable=true, example="A minimal tool crafted with surgical precision."),
 *     @OA\Property(property="price", type="number", format="float", example=129.99),
 *     @OA\Property(property="stock", type="integer", format="int32", example=15),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-01T09:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-01-05T11:30:00Z")
 * )
 *
 * @OA\Schema(
 *     schema="ProductInput",
 *     required={"name", "price", "stock"},
 *     @OA\Property(property="name", type="string", maxLength=255, example="Swiss Precision Knife"),
 *     @OA\Property(property="description", type="string", nullable=true, example="A minimal tool crafted with surgical precision."),
 *     @OA\Property(property="price", type="number", format="float", example=129.99),
 *     @OA\Property(property="stock", type="integer", format="int32", minimum=0, example=15)
 * )
 */
class ProductSchema
{
    // Specification-only bucket for reusable Product schemas.
}
