<?php

namespace App\Exceptions;

class PrivateClassException extends QueryException
{
    public function __construct(string $query, string $message = 'This a private class of IP', int $code = 422, ?\Throwable $previous = null)
    {
        parent::__construct($query, $message, $code, $previous);
    }
}
