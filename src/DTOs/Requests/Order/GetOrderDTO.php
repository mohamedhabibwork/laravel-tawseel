<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Order;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;

final readonly class GetOrderDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $refrenceCode
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'refrenceCode' => $this->refrenceCode,
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
            'refrenceCode' => ['required', 'string'],
        ];
    }
}
