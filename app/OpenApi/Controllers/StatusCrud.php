<?php

namespace App\OpenApi\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Status Types",
 *     description="Admin management of status categories."
 * )
 * @OA\Tag(
 *     name="Statuses",
 *     description="Admin management of statuses tied to a status type."
 * )
 */
class StatusCrud
{
    /**
     * @OA\Get(
     *     path="/api/v1/status-types",
     *     tags={"Status Types"},
     *     summary="List status types",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of status types",
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/ApiResponse"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/StatusType")
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     *
     * @OA\Post(
     *     path="/api/v1/status-types",
     *     tags={"Status Types"},
     *     summary="Create status type",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Account")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/ApiResponse"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         ref="#/components/schemas/StatusType"
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     *
     * @OA\Get(
     *     path="/api/v1/status-types/{id}",
     *     tags={"Status Types"},
     *     summary="Show status type",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Status type detail",
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/ApiResponse"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         ref="#/components/schemas/StatusType"
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     *
     * @OA\Put(
     *     path="/api/v1/status-types/{id}",
     *     tags={"Status Types"},
     *     summary="Update status type",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Accounts")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated",
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/ApiResponse"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         ref="#/components/schemas/StatusType"
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     *
     * @OA\Delete(
     *     path="/api/v1/status-types/{id}",
     *     tags={"Status Types"},
     *     summary="Delete status type",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *     )
     * )
     *
     * @OA\Get(
     *     path="/api/v1/statuses",
     *     tags={"Statuses"},
     *     summary="List statuses",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of statuses",
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/ApiResponse"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/Status")
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     *
     * @OA\Post(
     *     path="/api/v1/statuses",
     *     tags={"Statuses"},
     *     summary="Create status",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","order","status_type_id"},
     *             @OA\Property(property="name", type="string", example="Active"),
     *             @OA\Property(property="order", type="integer", example=1),
     *             @OA\Property(property="status_type_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/ApiResponse"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         ref="#/components/schemas/Status"
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     *
     * @OA\Get(
     *     path="/api/v1/statuses/{id}",
     *     tags={"Statuses"},
     *     summary="Show status",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Status detail",
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/ApiResponse"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         ref="#/components/schemas/Status"
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     *
     * @OA\Put(
     *     path="/api/v1/statuses/{id}",
     *     tags={"Statuses"},
     *     summary="Update status",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","order","status_type_id"},
     *             @OA\Property(property="name", type="string", example="Inactive"),
     *             @OA\Property(property="order", type="integer", example=2),
     *             @OA\Property(property="status_type_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated",
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/ApiResponse"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         ref="#/components/schemas/Status"
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     *
     * @OA\Delete(
     *     path="/api/v1/statuses/{id}",
     *     tags={"Statuses"},
     *     summary="Delete status",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *     )
     * )
     */
    public function routes()
    {
        // Annotation container; no implementation needed.
    }
}
