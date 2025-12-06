<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Responses\Lookup;

final readonly class LookupItemDTO
{
    public function __construct(
        public string $id,
        public string $nameAr,
        public string $nameEn
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            nameAr: (string) $data['nameAr'],
            nameEn: (string) $data['nameEn']
        );
    }

    /**
     * @param array<int, array<string, mixed>> $items
     * @return array<int, self>
     */
    public static function fromArrayCollection(array $items): array
    {
        return array_map(
            fn (array $item) => self::fromArray($item),
            $items
        );
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nameAr' => $this->nameAr,
            'nameEn' => $this->nameEn,
        ];
    }
}
