<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Order;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\Rules\ValidCoordinates;

final readonly class EditOrderDeliveryAddressDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $referenceCode,
        public string $regionId,
        public string $cityId,
        public string $coordinates,
        public string $storeLocation
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'deliveryInfo' => [
                'referenceCode' => $this->referenceCode,
                'regionId' => $this->regionId,
                'cityId' => $this->cityId,
                'coordinates' => $this->coordinates,
                'storeLocation' => $this->storeLocation,
            ],
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
            'regionId' => ['required', 'string'],
            'cityId' => ['required', 'string'],
            'coordinates' => ['required', 'string', new ValidCoordinates],
            'storeLocation' => ['required', 'string', new ValidCoordinates],
            // Note: Order must not be rejected, executed, or canceled - validated by API
            // Note: City must belong to region - validated by API
        ];
    }
}
