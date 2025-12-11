<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiResponse
{
    /**
     * Return a success response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function success(mixed $data = null, string $message = 'OK', int $statusCode = 200): JsonResponse
    {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'meta' => [
                'timestamp' => now()->toIso8601String(),
                'path' => request()->path(),
                'version' => 'v1',
            ],
        ];

        // Handle Pagination
        if ($data instanceof LengthAwarePaginator) {
            $response['data'] = $data->items();
            $response['meta']['pagination'] = [
                'total' => $data->total(),
                'count' => $data->count(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage(),
                'links' => [
                    'next' => $data->nextPageUrl(),
                    'prev' => $data->previousPageUrl(),
                ],
            ];
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return an error response.
     *
     * @param string $message
     * @param int $statusCode
     * @param string|null $errorCode
     * @param array $errors
     * @return JsonResponse
     */
    public static function error(string $message, int $statusCode = 400, string $errorCode = null, array $errors = []): JsonResponse
    {
        $response = [
            'status' => 'error',
            'message' => $message,
            'data' => null,
            'meta' => [
                'timestamp' => now()->toIso8601String(),
                'path' => request()->path(),
                'version' => 'v1',
            ],
            'error_code' => $errorCode,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }
}
