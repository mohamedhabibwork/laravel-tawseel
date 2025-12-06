<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Driver;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\Rules\ValidIdNumber;

final readonly class DeactivateDriverDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $idNumber
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
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
            'idNumber' => ['required', 'string', new ValidIdNumber()],
        ];
    }
}
