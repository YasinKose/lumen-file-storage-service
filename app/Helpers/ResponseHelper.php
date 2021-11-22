<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    /**
     * @param string $message
     * @param array $errors
     * @return JsonResponse
     */
    public function error(string $message, array $errors = []): JsonResponse
    {
        return $this->sendResponse(0, $message, $errors);
    }

    /**
     * @param int $status
     * @param string $message
     * @param array $errors
     * @param array $attr
     * @return JsonResponse
     */
    private function sendResponse(int $status, string $message, array $errors = [], array $attr = []): JsonResponse
    {
        return response()->json([
            'status' => (bool)$status,
            'message' => $message,
            'errors' => $errors,
            'attr' => $attr
        ]);
    }

    /**
     * @param string $message
     * @param array $attr
     * @return JsonResponse
     */
    public function success(string $message, array $attr = []): JsonResponse
    {
        return $this->sendResponse(1, $message, [], $attr);
    }
}
