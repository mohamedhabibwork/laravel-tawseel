<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Driver;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\Rules\ValidCarNumber;
use Habib\LaravelTawseel\Rules\ValidDateOfBirth;
use Habib\LaravelTawseel\Rules\ValidIdNumber;
use Habib\LaravelTawseel\Rules\ValidMobileNumber;
use Illuminate\Validation\Rule;

final readonly class CreateDriverDTO
{
    public function __construct(
        public CredentialDTO $credential,
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
            'identityTypeId' => ['required', 'string'],
            'idNumber' => ['required', 'string', new ValidIdNumber()],
            'dateOfBirth' => ['required', 'integer', new ValidDateOfBirth()],
            'registrationDate' => ['required', 'date', 'date_format:Y-m-d\TH:i:s.v\Z'],
            'mobile' => ['required', 'string', new ValidMobileNumber()],
            'regionId' => ['required', 'string'],
            'carTypeId' => ['required', 'string'],
            'cityId' => ['required', 'string'],
            'carNumber' => ['required', 'string', new ValidCarNumber()],
            'vehicleSequenceNumber' => ['required', 'string'],
            // Note: City must belong to region - validated by API
            // Note: Vehicle sequence number must be from vehicle registration card - validated by API
            // Note: License activity requirements:
            //   - Motorcycle: 'نقل البضائع بالدراجات اآللية'
            //   - Other vehicles: 'النقل الخفيف'
            //   - Validated by API/MOI integration
        ];
    }
}
