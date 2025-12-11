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
     *     path="/status-types",
     *     tags={"Status Types"},
     *     summary="List status types",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of status types",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/StatusType"))
     *     )
     * )
     *
     * @OA\Post(
     *     path="/status-types",
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
     *         @OA\JsonContent(ref="#/components/schemas/StatusType")
     *     )
     * )
     *
     * @OA\Get(
     *     path="/status-types/{id}",
     *     tags={"Status Types"},
     *     summary="Show status type",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Status type detail",
     *         @OA\JsonContent(ref="#/components/schemas/StatusType")
     *     )
     * )
     *
     * @OA\Put(
     *     path="/status-types/{id}",
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
     *         @OA\JsonContent(ref="#/components/schemas/StatusType")
     *     )
     * )
     *
     * @OA\Delete(
     *     path="/status-types/{id}",
     *     tags={"Status Types"},
     *     summary="Delete status type",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     *
     * @OA\Get(
     *     path="/statuses",
     *     tags={"Statuses"},
     *     summary="List statuses",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of statuses",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Status"))
     *     )
     * )
     *
     * @OA\Post(
     *     path="/statuses",
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
     *         @OA\JsonContent(ref="#/components/schemas/Status")
     *     )
     * )
     *
     * @OA\Get(
     *     path="/statuses/{id}",
     *     tags={"Statuses"},
     *     summary="Show status",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Status detail",
     *         @OA\JsonContent(ref="#/components/schemas/Status")
     *     )
     * )
     *
     * @OA\Put(
     *     path="/statuses/{id}",
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
     *         @OA\JsonContent(ref="#/components/schemas/Status")
     *     )
     * )
     *
     * @OA\Delete(
     *     path="/statuses/{id}",
     *     tags={"Statuses"},
     *     summary="Delete status",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function routes()
    {
        // Annotation container; no implementation needed.
    }
}
