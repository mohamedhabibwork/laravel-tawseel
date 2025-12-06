<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Responses\Order;

final readonly class OrderResponseDTO
{
    public function __construct(
        public ?string $referenceCode = null,
        public ?string $orderNumber = null,
        public ?string $authorityId = null,
        public ?string $categoryId = null,
        public ?string $deliveryTime = null,
        public ?string $regionId = null,
        public ?string $cityId = null,
        public ?string $coordinates = null,
        public ?string $storetName = null,
        public ?string $storeLocation = null,
        public ?string $orderDate = null,
        public ?string $recipientMobileNumber = null,
        public ?string $status = null,
        public ?string $driverReferenceCode = null,
        public ?string $assignationTime = null,
        public ?string $executionTime = null
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            referenceCode: $data['referenceCode'] ?? null,
            orderNumber: $data['orderNumber'] ?? null,
            authorityId: $data['authorityId'] ?? null,
            categoryId: $data['categoryId'] ?? null,
            deliveryTime: $data['deliveryTime'] ?? null,
            regionId: $data['regionId'] ?? null,
            cityId: $data['cityId'] ?? null,
            coordinates: $data['coordinates'] ?? null,
            storetName: $data['storetName'] ?? null,
            storeLocation: $data['storeLocation'] ?? null,
            orderDate: $data['orderDate'] ?? null,
            recipientMobileNumber: $data['recipientMobileNumber'] ?? null,
            status: $data['status'] ?? null,
            driverReferenceCode: $data['driverReferenceCode'] ?? null,
            assignationTime: $data['assignationTime'] ?? null,
            executionTime: $data['executionTime'] ?? null
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            'referenceCode' => $this->referenceCode,
            'orderNumber' => $this->orderNumber,
            'authorityId' => $this->authorityId,
            'categoryId' => $this->categoryId,
            'deliveryTime' => $this->deliveryTime,
            'regionId' => $this->regionId,
            'cityId' => $this->cityId,
            'coordinates' => $this->coordinates,
            'storetName' => $this->storetName,
            'storeLocation' => $this->storeLocation,
            'orderDate' => $this->orderDate,
            'recipientMobileNumber' => $this->recipientMobileNumber,
            'status' => $this->status,
            'driverReferenceCode' => $this->driverReferenceCode,
            'assignationTime' => $this->assignationTime,
            'executionTime' => $this->executionTime,
        ], fn ($value) => $value !== null);
    }
}
