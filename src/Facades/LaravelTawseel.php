<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Habib\LaravelTawseel\DTOs\Responses\Driver\DriverResponseDTO createDriver(\Habib\LaravelTawseel\DTOs\Requests\Driver\CreateDriverDTO $dto)
 * @method static \Habib\LaravelTawseel\DTOs\Responses\Driver\DriverResponseDTO editDriver(\Habib\LaravelTawseel\DTOs\Requests\Driver\EditDriverDTO $dto)
 * @method static \Habib\LaravelTawseel\DTOs\Responses\Driver\DriverResponseDTO getDriver(\Habib\LaravelTawseel\DTOs\Requests\Driver\GetDriverDTO $dto)
 * @method static \Habib\LaravelTawseel\DTOs\Responses\Driver\DriverResponseDTO deactivateDriver(\Habib\LaravelTawseel\DTOs\Requests\Driver\DeactivateDriverDTO $dto)
 * @method static \Habib\LaravelTawseel\DTOs\Responses\Order\OrderResponseDTO createOrder(\Habib\LaravelTawseel\DTOs\Requests\Order\CreateOrderDTO $dto)
 * @method static bool acceptOrder(\Habib\LaravelTawseel\DTOs\Requests\Order\AcceptOrderDTO $dto)
 * @method static bool rejectOrder(\Habib\LaravelTawseel\DTOs\Requests\Order\RejectOrderDTO $dto)
 * @method static bool assignDriverToOrder(\Habib\LaravelTawseel\DTOs\Requests\Order\AssignDriverToOrderDTO $dto)
 * @method static bool editOrderDeliveryAddress(\Habib\LaravelTawseel\DTOs\Requests\Order\EditOrderDeliveryAddressDTO $dto)
 * @method static \Habib\LaravelTawseel\DTOs\Responses\Order\OrderExecutionResponseDTO executeOrder(\Habib\LaravelTawseel\DTOs\Requests\Order\ExecuteOrderDTO $dto)
 * @method static bool cancelOrder(\Habib\LaravelTawseel\DTOs\Requests\Order\CancelOrderDTO $dto)
 * @method static \Habib\LaravelTawseel\DTOs\Responses\Order\OrderResponseDTO getOrder(\Habib\LaravelTawseel\DTOs\Requests\Order\GetOrderDTO $dto)
 * @method static bool createContactInfo(\Habib\LaravelTawseel\DTOs\Requests\ContactInfo\CreateContactInfoDTO $dto)
 * @method static \Habib\LaravelTawseel\DTOs\Responses\ContactInfo\ContactInfoResponseDTO getContactInfo(\Habib\LaravelTawseel\DTOs\Requests\ContactInfo\GetContactInfoDTO $dto)
 * @method static array<int, \Habib\LaravelTawseel\DTOs\Responses\Lookup\LookupItemDTO> getLookup(\Habib\LaravelTawseel\Enums\LookupType $type, \Habib\LaravelTawseel\DTOs\Requests\Lookup\GeneralLookupDTO $dto)
 * @method static array<int, \Habib\LaravelTawseel\DTOs\Responses\Lookup\LookupItemDTO> getCities(\Habib\LaravelTawseel\DTOs\Requests\Lookup\CitiesLookupDTO $dto)
 *
 * @see \Habib\LaravelTawseel\LaravelTawseel
 */
class LaravelTawseel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Habib\LaravelTawseel\LaravelTawseel::class;
    }
}
