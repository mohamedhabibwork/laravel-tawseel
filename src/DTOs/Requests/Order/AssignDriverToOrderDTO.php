<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Order;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\Rules\ValidIdNumber;

final readonly class AssignDriverToOrderDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $referenceCode,
        public string $idNumber
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'referenceCode' => $this->referenceCode,
            'idNumber' => $this->idNumber,
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
            'idNumber' => ['required', 'string', new ValidIdNumber],
            // Note: Order must be in "Accepted" status - validated by API
            // Note: Driver must be active and eligible - validated by API
            // Note: Driver eligibility checks (COVID-19, health, vaccination, etc.) - validated by API
            // Note: Driver cannot deliver in two regions within X hours - validated by API
            // Note: Driver must not have active order in another app - validated by API
            // Note: Face verification may be required - validated by API
        ];
    }
}
