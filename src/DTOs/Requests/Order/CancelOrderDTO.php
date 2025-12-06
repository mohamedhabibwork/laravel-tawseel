<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Order;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;

final readonly class CancelOrderDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $orderId,
        public string $cancelationReasonId
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'orderId' => $this->orderId,
            'cancelationReasonId' => $this->cancelationReasonId,
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
            'orderId' => ['required', 'string'],
            'cancelationReasonId' => ['required', 'string'],
            // Note: Order cannot be already canceled, executed, or rejected - validated by API
        ];
    }
}
