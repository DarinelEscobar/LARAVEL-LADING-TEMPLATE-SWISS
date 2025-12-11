<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatusApiController extends Controller
{
    public function index(): JsonResponse
    {
        $statuses = Status::query()
            ->with('type')
            ->orderBy('order')
            ->paginate(10);

        return ApiResponse::success($statuses);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:1'],
            'status_type_id' => ['required', 'exists:status_types,id'],
        ]);

        $status = Status::create($data)->load('type');

        return ApiResponse::success($status, 'Status created successfully', 201);
    }

    public function show(Status $status): JsonResponse
    {
        return ApiResponse::success($status->load('type'));
    }

    public function update(Request $request, Status $status): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:1'],
            'status_type_id' => ['required', 'exists:status_types,id'],
        ]);

        $status->update($data);

        return ApiResponse::success($status->load('type'), 'Status updated successfully');
    }

    public function destroy(Status $status): JsonResponse
    {
        $status->delete();

        return ApiResponse::success(null, 'Status deleted successfully', 200);
    }
}
