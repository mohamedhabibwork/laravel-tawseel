<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Responses;

/**
 * @template T
 */
final readonly class ApiResponseDTO
{
    /**
     * @param  T|null  $data
     * @param  array<int>  $errorCodes
     */
    public function __construct(
        public bool $status,
        public mixed $data = null,
        public array $errorCodes = []
    ) {}

    /**
     * @param  array<string, mixed>  $data
     * @return self<mixed>
     */
    public static function fromArray(array $data): self
    {
        return new self(
            status: (bool) ($data['status'] ?? false),
            data: $data['data'] ?? null,
            errorCodes: $data['errorCodes'] ?? []
        );
    }

    public function isSuccess(): bool
    {
        // Error code 0 means success, or no error codes with status true
        return $this->status && (empty($this->errorCodes) || in_array(0, $this->errorCodes, true));
    }

    public function hasErrorCode(int $errorCode): bool
    {
        return in_array($errorCode, $this->errorCodes, true);
    }
}
