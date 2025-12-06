<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Exceptions;

final class TawseelApiException extends TawseelException
{
    /**
     * @param  array<int>  $errorCodes
     */
    public function __construct(
        string $message,
        private readonly array $errorCodes = [],
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array<int>
     */
    public function getErrorCodes(): array
    {
        return $this->errorCodes;
    }

    public function hasErrorCode(int $errorCode): bool
    {
        return in_array($errorCode, $this->errorCodes, true);
    }
}
