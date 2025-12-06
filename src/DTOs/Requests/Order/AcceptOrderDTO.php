<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Order;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;

final readonly class AcceptOrderDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $referenceCode,
        public string $acceptanceDateTime
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'referenceCode' => $this->referenceCode,
            'acceptanceDateTime' => $this->acceptanceDateTime,
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
            'acceptanceDateTime' => ['required', 'date', 'date_format:Y-m-d\TH:i:s.v\Z'],
            // Note: Order must be in "Created" status - validated by API
            // Note: Acceptance date must be after order creation date - validated by API
        ];
    }
}
