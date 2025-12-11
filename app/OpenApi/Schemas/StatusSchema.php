<?php

namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Status",
 *     type="object",
 *     title="Status",
 *     required={"id","name","order","status_type_id"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Active"),
 *     @OA\Property(property="order", type="integer", example=1),
 *     @OA\Property(property="status_type_id", type="integer", example=1),
 *     @OA\Property(property="status_type", ref="#/components/schemas/StatusType")
 * )
 */
class StatusSchema
{
    // Schema container for swagger-php.
}
