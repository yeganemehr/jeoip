<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QueryException extends Exception
{
    public function __construct(
        public readonly string $query,
        string $message,
        int $code = 404,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'status' => false,
            'query' => $this->query,
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
