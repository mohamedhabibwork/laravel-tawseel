<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\DTOs\Requests\Order;

use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;

final readonly class ExecuteOrderDTO
{
    public function __construct(
        public CredentialDTO $credential,
        public string $referenceCode,
        public string $executionTime,
        public string $paymentMethodId,
        public float $price,
        public float $priceWithoutDelivery,
        public float $deliveryPrice,
        public float $driverIncome
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'credential' => $this->credential->toArray(),
            'orderExecutionData' => [
                'referenceCode' => $this->referenceCode,
                'executionTime' => $this->executionTime,
                'paymentMethodId' => $this->paymentMethodId,
                'price' => $this->price,
                'priceWithoutDelivery' => $this->priceWithoutDelivery,
                'deliveryPrice' => $this->deliveryPrice,
                'driverIncome' => $this->driverIncome,
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
            'referenceCode' => ['required', 'string'],
            'executionTime' => ['required', 'date', 'date_format:Y-m-d\TH:i:s.v\Z'],
            'paymentMethodId' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'priceWithoutDelivery' => ['required', 'numeric', 'min:0'],
            'deliveryPrice' => ['required', 'numeric', 'min:0'],
            'driverIncome' => ['required', 'numeric', 'min:0'],
            // Note: Order must be in "Accepted" status with assigned driver - validated by API
            // Note: Execution time must be after order date and assignment time - validated by API
            // Note: Price = priceWithoutDelivery + deliveryPrice (validated by API)
        ];
    }
}
