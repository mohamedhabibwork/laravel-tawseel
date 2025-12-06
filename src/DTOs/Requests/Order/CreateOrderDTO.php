<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Order;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\Rules\ValidCoordinates;
use Habib\LaravelTawseel\Rules\ValidRecipientMobile;

final readonly class CreateOrderDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $orderNumber,
        public string $authorityId,
        public string $deliveryTime,
        public string $regionId,
        public string $cityId,
        public string $coordinates,
        public string $storetName,
        public string $storeLocation,
        public string $categoryId,
        public string $orderDate,
        public string $recipientMobileNumber
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'order' => [
                'orderNumber' => $this->orderNumber,
                'authorityId' => $this->authorityId,
                'deliveryTime' => $this->deliveryTime,
                'regionId' => $this->regionId,
                'cityId' => $this->cityId,
                'coordinates' => $this->coordinates,
                'storetName' => $this->storetName,
                'storeLocation' => $this->storeLocation,
                'categoryId' => $this->categoryId,
                'orderDate' => $this->orderDate,
                'recipientMobileNumber' => $this->recipientMobileNumber,
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
            'orderNumber' => ['required', 'string', 'max:255'],
            'authorityId' => ['required', 'string'],
            'deliveryTime' => ['required', 'date', 'date_format:Y-m-d\TH:i:s.v\Z'],
            'regionId' => ['required', 'string'],
            'cityId' => ['required', 'string'],
            'coordinates' => ['required', 'string', new ValidCoordinates()],
            'storetName' => ['required', 'string', 'max:180'],
            'storeLocation' => ['required', 'string', new ValidCoordinates()],
            'categoryId' => ['required', 'string'],
            'orderDate' => ['required', 'date', 'date_format:Y-m-d\TH:i:s.v\Z'],
            'recipientMobileNumber' => ['required', 'string', new ValidRecipientMobile()],
            // Note: Order number must be unique per day - validated by API
            // Note: City must belong to region - validated by API
            // Note: Distance between store and delivery location must not exceed allowed limit - validated by API
        ];
    }
}
