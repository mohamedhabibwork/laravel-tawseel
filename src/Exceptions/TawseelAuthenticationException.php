<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Exceptions;

final class TawseelAuthenticationException extends TawseelException
{
    public function __construct(
        string $message = 'Invalid credentials',
        int $code = 5,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
