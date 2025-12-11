<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticatedUserController
{
    /**
     * @OA\Get(
     *     path="/api/user",
     *     operationId="showAuthenticatedUser",
     *     summary="Show the authenticated user",
     *     tags={"Profile"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Authenticated user's profile.",
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/ApiResponse"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         ref="#/components/schemas/AuthenticatedUser"
     *                     )
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated."
     *     )
     * )
     */
    public function __invoke(Request $request): JsonResponse
    {
        return \App\Http\Responses\ApiResponse::success($request->user());
    }
}
