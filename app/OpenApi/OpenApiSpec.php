<?php

namespace App\OpenApi;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Laravel Landing Template Swiss API",
 *     description="Centralized API contract for the Swiss landing template. Keep controllers annotated to auto-update this spec."
 * )
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Primary API server"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="Token",
 *     description="Issue a Sanctum token, then send it as `Authorization: Bearer <token>`."
 * )
 */
class OpenApiSpec
{
    // This class exists solely to host reusable Swagger annotations.
}
