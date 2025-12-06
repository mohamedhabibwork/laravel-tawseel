<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Order;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;

final readonly class RejectOrderDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $referenceCode
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'referenceCode' => $this->referenceCode,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function rules(): array
    {
        return [
            'credential.companyName' => ['required', 'string'],
            'credential.password' => ['required', 'string'],
            'referenceCode' => ['required', 'string'],
            // Note: Order must be in "Created" status - validated by API
        ];
    }
}
