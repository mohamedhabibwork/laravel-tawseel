<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Responses\Driver;

final readonly class DriverResponseDTO
{
    public function __construct(
        public ?string $refrenceCode = null,
        public ?string $identityTypeId = null,
        public ?string $idNumber = null,
        public ?string $dateOfBirth = null,
        public ?string $registrationDate = null,
        public ?string $mobile = null,
        public ?string $regionId = null,
        public ?string $carTypeId = null,
        public ?string $cityId = null,
        public ?string $carNumber = null,
        public ?int $vehicleSequenceNumber = null
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            refrenceCode: $data['refrenceCode'] ?? null,
            identityTypeId: $data['identityTypeId'] ?? null,
            idNumber: $data['idNumber'] ?? null,
            dateOfBirth: $data['dateOfBirth'] ?? null,
            registrationDate: $data['registrationDate'] ?? null,
            mobile: $data['mobile'] ?? null,
            regionId: $data['regionId'] ?? null,
            carTypeId: $data['carTypeId'] ?? null,
            cityId: $data['cityId'] ?? null,
            carNumber: $data['carNumber'] ?? null,
            vehicleSequenceNumber: isset($data['vehicleSequenceNumber']) ? (int) $data['vehicleSequenceNumber'] : null
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            'refrenceCode' => $this->refrenceCode,
            'identityTypeId' => $this->identityTypeId,
            'idNumber' => $this->idNumber,
            'dateOfBirth' => $this->dateOfBirth,
            'registrationDate' => $this->registrationDate,
            'mobile' => $this->mobile,
            'regionId' => $this->regionId,
            'carTypeId' => $this->carTypeId,
            'cityId' => $this->cityId,
            'carNumber' => $this->carNumber,
            'vehicleSequenceNumber' => $this->vehicleSequenceNumber,
        ], fn ($value) => $value !== null);
    }
}
