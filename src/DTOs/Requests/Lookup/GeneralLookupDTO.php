<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Lookup;

final readonly class GeneralLookupDTO
{
    public function __construct(
        public string $companyName,
        public string $password
    ) {}

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'companyName' => $this->companyName,
            'password' => $this->password,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function rules(): array
    {
        return [
            'companyName' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}
