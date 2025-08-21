<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function successResponse($data = null, string $message = "Success", int $code = 200)
    {
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
