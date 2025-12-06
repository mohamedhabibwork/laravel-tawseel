<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Responses\Order;

final readonly class OrderExecutionResponseDTO
{
    public function __construct(
        public string $referenceCode,
        public string $executionTime,
        public string $paymentMethodId,
        public string $price,
        public string $priceWithoutDelivery,
        public string $deliveryPrice,
        public string $driverIncome
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            referenceCode: (string) $data['referenceCode'],
            executionTime: (string) $data['executionTime'],
            paymentMethodId: (string) $data['paymentMethodId'],
            price: (string) $data['price'],
            priceWithoutDelivery: (string) $data['priceWithoutDelivery'],
            deliveryPrice: (string) $data['deliveryPrice'],
            driverIncome: (string) $data['driverIncome']
        );
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'referenceCode' => $this->referenceCode,
            'executionTime' => $this->executionTime,
            'paymentMethodId' => $this->paymentMethodId,
            'price' => $this->price,
            'priceWithoutDelivery' => $this->priceWithoutDelivery,
            'deliveryPrice' => $this->deliveryPrice,
            'driverIncome' => $this->driverIncome,
        ];
    }
}
