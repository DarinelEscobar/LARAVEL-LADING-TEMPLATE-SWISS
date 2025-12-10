<?php

namespace App\OpenApi\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Admin Users",
 *     description="User administration endpoints (role/status management)."
 * )
 */
class UserCrud
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="List admin users",
     *     tags={"Admin Users"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of users.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/AdminUser"))
     *     )
     * )
     */
    public function index(): void
    {
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Create a user",
     *     tags={"Admin Users"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AdminUserInput")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created.",
     *         @OA\JsonContent(ref="#/components/schemas/AdminUser")
     *     ),
     *     @OA\Response(response=422, description="Validation error.")
     * )
     */
    public function store(): void
    {
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Show a user",
     *     tags={"Admin Users"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User details.",
     *         @OA\JsonContent(ref="#/components/schemas/AdminUser")
     *     ),
     *     @OA\Response(response=404, description="User not found.")
     * )
     */
    public function show(): void
    {
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Update a user",
     *     tags={"Admin Users"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AdminUserInput")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated resource.",
     *         @OA\JsonContent(ref="#/components/schemas/AdminUser")
     *     ),
     *     @OA\Response(response=404, description="User not found.")
     * )
     */
    public function update(): void
    {
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Delete a user",
     *     tags={"Admin Users"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response=204, description="Deleted successfully."),
     *     @OA\Response(response=404, description="User not found.")
     * )
     */
    public function destroy(): void
    {
    }
}
