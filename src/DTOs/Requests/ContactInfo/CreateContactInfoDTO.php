<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\ContactInfo;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\Rules\ValidRecipientMobile;

final readonly class CreateContactInfoDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $responsibleName,
        public string $responsibleEmail,
        public string $responsibleMobileNumber,
        public string $technicalName,
        public string $technicalEmail,
        public string $technicalMobileNumber
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'appContactInfo' => [
                'responsibleName' => $this->responsibleName,
                'responsibleEmail' => $this->responsibleEmail,
                'responsibleMobileNumber' => $this->responsibleMobileNumber,
                'technicalName' => $this->technicalName,
                'technicalEmail' => $this->technicalEmail,
                'technicalMobileNumber' => $this->technicalMobileNumber,
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
            'responsibleName' => ['required', 'string'],
            'responsibleEmail' => ['required', 'email'],
            'responsibleMobileNumber' => ['required', 'string', new ValidRecipientMobile],
            'technicalName' => ['required', 'string'],
            'technicalEmail' => ['required', 'email'],
            'technicalMobileNumber' => ['required', 'string', new ValidRecipientMobile],
        ];
    }
}
