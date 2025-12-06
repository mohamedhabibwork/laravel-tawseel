<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests;

final readonly class CredentialDTO
{
    public function __construct(
        public string $companyName,
        public string $password
    ) {}

    /**
     * @return array{companyName: string, password: string}
     */
    public function toArray(): array
    {
        return [
            'companyName' => $this->companyName,
            'password' => $this->password,
        ];
    }
}
