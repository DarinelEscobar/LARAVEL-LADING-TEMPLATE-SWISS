<?php

namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="AuthenticatedUser",
 *     description="Representation of the authenticated user returned by the profile endpoint.",
 *     @OA\Property(property="id", type="integer", format="int64", example=1),
 *     @OA\Property(property="name", type="string", example="Sofia Admin"),
 *     @OA\Property(property="email", type="string", format="email", example="sofia@example.com"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true, example="2025-01-10T12:45:12+00:00"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-01T08:00:00+00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-01-05T13:37:00+00:00")
 * )
 *
 * @OA\Schema(
 *     schema="AdminUser",
 *     description="Full admin-managed user resource.",
 *     @OA\Property(property="id", type="integer", format="int64", example=7),
 *     @OA\Property(property="name", type="string", example="Laura Morales"),
 *     @OA\Property(property="email", type="string", format="email", example="assistant@test.com"),
 *     @OA\Property(property="status_id", type="integer", format="int32", example=1),
 *     @OA\Property(property="role_id", type="integer", format="int32", example=1),
 *     @OA\Property(property="person_id", type="integer", format="int64", example=2),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-04T08:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-01-08T10:32:00Z")
 * )
 *
 * @OA\Schema(
 *     schema="AdminUserInput",
 *     required={"person_names","person_surnames","email"},
 *     @OA\Property(property="person_names", type="string", maxLength=255, example="Laura Mireya"),
 *     @OA\Property(property="person_surnames", type="string", maxLength=255, example="Morales Perez"),
 *     @OA\Property(property="email", type="string", format="email", example="assistant@test.com"),
 *     @OA\Property(property="password", type="string", minLength=8, nullable=true, example="super-secret", description="Required when creating a user, optional on update."),
 *     @OA\Property(property="status_id", type="integer", format="int32", nullable=true, example=1, description="Defaults to 1 (active) when omitted."),
 *     @OA\Property(property="role_id", type="integer", format="int32", nullable=true, example=1, description="Defaults to 1 (admin) when omitted.")
 * )
 */
class UserSchema
{
    // Schema-only class used by swagger-php while scanning annotations.
}
