<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Lookup;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;

final readonly class CitiesLookupDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $regionId
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'regionId' => $this->regionId,
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
            'regionId' => ['required', 'string'],
        ];
    }
}
