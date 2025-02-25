<?php

namespace App\Traits;

trait HasResponse
{
    public function successResponse($message = 'Success', $code = 200, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function errorResponse($message = 'Error', $code = 400, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
