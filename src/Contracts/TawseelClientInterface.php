<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Contracts;

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
use Habib\LaravelTawseel\DTOs\Responses\Order\OrderExecutionResponseDTO;
use Habib\LaravelTawseel\DTOs\Responses\Order\OrderResponseDTO;
use Habib\LaravelTawseel\Enums\LookupType;

interface TawseelClientInterface
{
    // Driver Management
    public function createDriver(CreateDriverDTO $dto): DriverResponseDTO;

    public function editDriver(EditDriverDTO $dto): DriverResponseDTO;

    public function getDriver(GetDriverDTO $dto): DriverResponseDTO;

    public function deactivateDriver(DeactivateDriverDTO $dto): DriverResponseDTO;

    // Order Management
    public function createOrder(CreateOrderDTO $dto): OrderResponseDTO;

    public function acceptOrder(AcceptOrderDTO $dto): bool;

    public function rejectOrder(RejectOrderDTO $dto): bool;

    public function assignDriverToOrder(AssignDriverToOrderDTO $dto): bool;

    public function editOrderDeliveryAddress(EditOrderDeliveryAddressDTO $dto): bool;

    public function executeOrder(ExecuteOrderDTO $dto): OrderExecutionResponseDTO;

    public function cancelOrder(CancelOrderDTO $dto): bool;

    public function getOrder(GetOrderDTO $dto): OrderResponseDTO;

    // Contact Information
    public function createContactInfo(CreateContactInfoDTO $dto): bool;

    public function getContactInfo(GetContactInfoDTO $dto): ContactInfoResponseDTO;

    // Lookups
    public function getLookup(LookupType $type, GeneralLookupDTO $dto): array;

    public function getCities(CitiesLookupDTO $dto): array;
}
