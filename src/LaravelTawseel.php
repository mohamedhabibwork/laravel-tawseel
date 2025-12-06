<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel;

use Habib\LaravelTawseel\Contracts\TawseelClientInterface;
use Habib\LaravelTawseel\DTOs\Requests\ContactInfo\CreateContactInfoDTO;
use Habib\LaravelTawseel\DTOs\Requests\ContactInfo\GetContactInfoDTO;
use Habib\LaravelTawseel\DTOs\Requests\Driver\CreateDriverDTO;
use Habib\LaravelTawseel\DTOs\Requests\Driver\DeactivateDriverDTO;
use Habib\LaravelTawseel\DTOs\Requests\Driver\EditDriverDTO;
use Habib\LaravelTawseel\DTOs\Requests\Driver\GetDriverDTO;
use Habib\LaravelTawseel\DTOs\Requests\Lookup\CitiesLookupDTO;
use Habib\LaravelTawseel\DTOs\Requests\Lookup\GeneralLookupDTO;
use Habib\LaravelTawseel\DTOs\Requests\Order\AcceptOrderDTO;
use Habib\LaravelTawseel\DTOs\Requests\Order\AssignDriverToOrderDTO;
use Habib\LaravelTawseel\DTOs\Requests\Order\CancelOrderDTO;
use Habib\LaravelTawseel\DTOs\Requests\Order\CreateOrderDTO;
use Habib\LaravelTawseel\DTOs\Requests\Order\EditOrderDeliveryAddressDTO;
use Habib\LaravelTawseel\DTOs\Requests\Order\ExecuteOrderDTO;
use Habib\LaravelTawseel\DTOs\Requests\Order\GetOrderDTO;
use Habib\LaravelTawseel\DTOs\Requests\Order\RejectOrderDTO;
use Habib\LaravelTawseel\DTOs\Responses\ContactInfo\ContactInfoResponseDTO;
use Habib\LaravelTawseel\DTOs\Responses\Driver\DriverResponseDTO;
use Habib\LaravelTawseel\DTOs\Responses\Lookup\LookupItemDTO;
use Habib\LaravelTawseel\DTOs\Responses\Order\OrderExecutionResponseDTO;
use Habib\LaravelTawseel\DTOs\Responses\Order\OrderResponseDTO;
use Habib\LaravelTawseel\Enums\LookupType;
use Illuminate\Support\Facades\App;

final class LaravelTawseel
{
    private function client(): TawseelClientInterface
    {
        return App::make(TawseelClientInterface::class);
    }

    public function createDriver(CreateDriverDTO $dto): DriverResponseDTO
    {
        return $this->client()->createDriver($dto);
    }

    public function editDriver(EditDriverDTO $dto): DriverResponseDTO
    {
        return $this->client()->editDriver($dto);
    }

    public function getDriver(GetDriverDTO $dto): DriverResponseDTO
    {
        return $this->client()->getDriver($dto);
    }

    public function deactivateDriver(DeactivateDriverDTO $dto): DriverResponseDTO
    {
        return $this->client()->deactivateDriver($dto);
    }

    public function createOrder(CreateOrderDTO $dto): OrderResponseDTO
    {
        return $this->client()->createOrder($dto);
    }

    public function acceptOrder(AcceptOrderDTO $dto): bool
    {
        return $this->client()->acceptOrder($dto);
    }

    public function rejectOrder(RejectOrderDTO $dto): bool
    {
        return $this->client()->rejectOrder($dto);
    }

    public function assignDriverToOrder(AssignDriverToOrderDTO $dto): bool
    {
        return $this->client()->assignDriverToOrder($dto);
    }

    public function editOrderDeliveryAddress(EditOrderDeliveryAddressDTO $dto): bool
    {
        return $this->client()->editOrderDeliveryAddress($dto);
    }

    public function executeOrder(ExecuteOrderDTO $dto): OrderExecutionResponseDTO
    {
        return $this->client()->executeOrder($dto);
    }

    public function cancelOrder(CancelOrderDTO $dto): bool
    {
        return $this->client()->cancelOrder($dto);
    }

    public function getOrder(GetOrderDTO $dto): OrderResponseDTO
    {
        return $this->client()->getOrder($dto);
    }

    public function createContactInfo(CreateContactInfoDTO $dto): bool
    {
        return $this->client()->createContactInfo($dto);
    }

    public function getContactInfo(GetContactInfoDTO $dto): ContactInfoResponseDTO
    {
        return $this->client()->getContactInfo($dto);
    }

    /**
     * @return array<int, LookupItemDTO>
     */
    public function getLookup(LookupType $type, GeneralLookupDTO $dto): array
    {
        return $this->client()->getLookup($type, $dto);
    }

    /**
     * @return array<int, LookupItemDTO>
     */
    public function getCities(CitiesLookupDTO $dto): array
    {
        return $this->client()->getCities($dto);
    }
}
