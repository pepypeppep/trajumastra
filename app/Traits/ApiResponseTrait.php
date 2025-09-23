<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function successResponse($data = null, string $message = "Success", int $code = 200)
    {
        // Check if it's a paginated response
        if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data'    => $data->items(),
                'meta'    => [
                    'current_page' => $data->currentPage(),
                    'first_page_url' => $data->url(1),
                    'from' => $data->firstItem(),
                    'last_page' => $data->lastPage(),
                    'last_page_url' => $data->url($data->lastPage()),
                    'links' => $data->linkCollection()->toArray(),
                    'next_page_url' => $data->nextPageUrl(),
                    'path' => $data->path(),
                    'per_page' => $data->perPage(),
                    'prev_page_url' => $data->previousPageUrl(),
                    'to' => $data->lastItem(),
                    'total' => $data->total(),
                ]
            ], $code);
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected function errorResponse(string|array $message = "Error", int $code = 400, $data = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }
}
