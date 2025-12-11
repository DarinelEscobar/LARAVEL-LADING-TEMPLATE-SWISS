<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\StatusType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatusTypeApiController extends Controller
{
    public function index(): JsonResponse
    {
        $statusTypes = StatusType::query()
            ->orderBy('id')
            ->get();

        return ApiResponse::success($statusTypes);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $statusType = StatusType::create($data);

        return ApiResponse::success($statusType, 'Status type created successfully', 201);
    }

    public function show(StatusType $status_type): JsonResponse
    {
        return ApiResponse::success($status_type);
    }

    public function update(Request $request, StatusType $status_type): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $status_type->update($data);

        return ApiResponse::success($status_type, 'Status type updated successfully');
    }

    public function destroy(StatusType $status_type): JsonResponse
    {
        $status_type->delete();

        return ApiResponse::success(null, 'Status type deleted successfully', 200);
    }
}
