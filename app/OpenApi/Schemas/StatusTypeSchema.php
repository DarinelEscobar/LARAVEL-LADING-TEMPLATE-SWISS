<?php

namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StatusType",
 *     type="object",
 *     title="Status Type",
 *     required={"id","name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Account")
 * )
 */
class StatusTypeSchema
{
    // Schema container for swagger-php.
}
