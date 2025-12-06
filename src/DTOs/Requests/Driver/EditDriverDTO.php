<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Driver;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\Rules\ValidCarNumber;
use Habib\LaravelTawseel\Rules\ValidDateOfBirth;
use Habib\LaravelTawseel\Rules\ValidIdNumber;
use Habib\LaravelTawseel\Rules\ValidMobileNumber;

final readonly class EditDriverDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $refrenceCode,
        public string $identityTypeId,
        public string $idNumber,
        public int $dateOfBirth,
        public string $registrationDate,
        public string $mobile,
        public string $regionId,
        public string $carTypeId,
        public string $cityId,
        public string $carNumber,
        public string $vehicleSequenceNumber
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'driver' => [
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
            'refrenceCode' => ['required', 'string'],
            'identityTypeId' => ['required', 'string'],
            'idNumber' => ['required', 'string', new ValidIdNumber],
            'dateOfBirth' => ['required', 'integer', new ValidDateOfBirth],
            'registrationDate' => ['required', 'date', 'date_format:Y-m-d\TH:i:s.v\Z'],
            'mobile' => ['required', 'string', new ValidMobileNumber],
            'regionId' => ['required', 'string'],
            'carTypeId' => ['required', 'string'],
            'cityId' => ['required', 'string'],
            'carNumber' => ['required', 'string', new ValidCarNumber],
            'vehicleSequenceNumber' => ['required', 'string'],
            // Note: Reference code cannot be updated - validated by API
            // Note: Identity type, ID number, and nationality cannot be changed - validated by API
        ];
    }
}
