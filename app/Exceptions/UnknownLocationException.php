<?php

namespace App\Exceptions;

class UnknownLocationException extends QueryException
{
    public function __construct(string $query, string $message = 'Cannot find location for this query', int $code = 404, ?\Throwable $previous = null)
    {
        parent::__construct($query, $message, $code, $previous);
    }
}
