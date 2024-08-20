<?php

namespace App\Helpers;

trait ResponseHelper {
    
    public function successResponse($data, $message = 'Success', $statusCode = 200) {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public function errorResponse($message, $statusCode = 400, $error = null) {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'error' => $error
        ], $statusCode);
    }
}