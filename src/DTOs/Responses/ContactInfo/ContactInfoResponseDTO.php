<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Responses\ContactInfo;

final readonly class ContactInfoResponseDTO
{
    public function __construct(
        public string $responsibleName,
        public string $responsibleEmail,
        public string $responsibleMobileNumber,
        public string $technicalName,
        public string $technicalEmail,
        public string $technicalMobileNumber
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            responsibleName: (string) $data['responsibleName'],
            responsibleEmail: (string) $data['responsibleEmail'],
            responsibleMobileNumber: (string) $data['responsibleMobileNumber'],
            technicalName: (string) $data['technicalName'],
            technicalEmail: (string) $data['technicalEmail'],
            technicalMobileNumber: (string) $data['technicalMobileNumber']
        );
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'responsibleName' => $this->responsibleName,
            'responsibleEmail' => $this->responsibleEmail,
            'responsibleMobileNumber' => $this->responsibleMobileNumber,
            'technicalName' => $this->technicalName,
            'technicalEmail' => $this->technicalEmail,
            'technicalMobileNumber' => $this->technicalMobileNumber,
        ];
    }
}
