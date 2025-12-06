# Laravel Tawseel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohamedhabibwork/laravel-tawseel.svg?style=flat-square)](https://packagist.org/packages/mohamedhabibwork/laravel-tawseel)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mohamedhabibwork/laravel-tawseel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mohamedhabibwork/laravel-tawseel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mohamedhabibwork/laravel-tawseel.svg?style=flat-square)](https://packagist.org/packages/mohamedhabibwork/laravel-tawseel)

A comprehensive Laravel package for integrating with the Tawseel Delivery API. This package provides a clean, type-safe interface for managing drivers, orders, contact information, and lookups in the Tawseel delivery system.

## Features

- ✅ **16 Complete API Endpoints** - Full coverage of Tawseel Delivery API
- ✅ **Type-Safe DTOs** - Request and Response Data Transfer Objects with strict typing
- ✅ **Comprehensive Error Handling** - Custom exceptions with error code mapping
- ✅ **Validation Rules** - Custom Laravel validation rules for Saudi-specific formats
- ✅ **PHP 8.3+ Support** - Modern PHP features (readonly properties, typed constants, etc.)
- ✅ **Laravel Integration** - Uses Laravel's HTTP client and validation
- ✅ **Facade Support** - Easy access via Laravel facade
- ✅ **Array Parsing** - Support for array responses (lookups)

## Installation

You can install the package via composer:

```bash
composer require mohamedhabibwork/laravel-tawseel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-tawseel-config"
```

## Configuration

After publishing the config file, update `config/tawseel.php` or set the following environment variables in your `.env` file:

```env
TAWSEEL_ENVIRONMENT=test
TAWSEEL_COMPANY_NAME=your_company_name
TAWSEEL_PASSWORD=your_password
TAWSEEL_TEST_URL=https://demo-apitawseel.naql.sa
TAWSEEL_PRODUCTION_URL=https://tawseelapi.ecloud.sa
TAWSEEL_TIMEOUT=30
```

### Config File Structure

```php
return [
    'environment' => env('TAWSEEL_ENVIRONMENT', 'test'),
    
    'base_urls' => [
        'test' => env('TAWSEEL_TEST_URL', 'https://demo-apitawseel.naql.sa'),
        'production' => env('TAWSEEL_PRODUCTION_URL', 'https://tawseelapi.ecloud.sa'),
    ],
    
    'company_name' => env('TAWSEEL_COMPANY_NAME', ''),
    'password' => env('TAWSEEL_PASSWORD', ''),
    'timeout' => env('TAWSEEL_TIMEOUT', 30),
];
```

## Usage

### Using the Facade

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\DTOs\Requests\Driver\CreateDriverDTO;
```

### Driver Management

#### Create Driver

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\DTOs\Requests\Driver\CreateDriverDTO;

$credential = new CredentialDTO(
    companyName: config('tawseel.company_name'),
    password: config('tawseel.password')
);

$driverDTO = new CreateDriverDTO(
    credential: $credential,
    identityTypeId: 'NV25GlPuOnQ=',
    idNumber: '1016990911',
    dateOfBirth: 19900419,
    registrationDate: '2020-04-02T17:41:59.277Z',
    mobile: '0512547848',
    regionId: 'NV25GlPuOnQ=',
    carTypeId: 'oIcaYzeDfQQ=',
    cityId: 'NV25GlPuOnQ=',
    carNumber: '1234ABC',
    vehicleSequenceNumber: '123456789'
);

$driver = LaravelTawseel::createDriver($driverDTO);
echo $driver->refrenceCode; // Driver reference code
```

#### Get Driver

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\CredentialDTO;
use Habib\LaravelTawseel\DTOs\Requests\Driver\GetDriverDTO;

$credential = new CredentialDTO(
    companyName: config('tawseel.company_name'),
    password: config('tawseel.password')
);

$getDriverDTO = new GetDriverDTO(
    credential: $credential,
    idNumber: '1016990911'
);

$driver = LaravelTawseel::getDriver($getDriverDTO);
```

#### Edit Driver

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\Driver\EditDriverDTO;

$editDriverDTO = new EditDriverDTO(
    credential: $credential,
    refrenceCode: '87834',
    identityTypeId: 'NV25GlPuOnQ=',
    idNumber: '1016990911',
    dateOfBirth: 19900419,
    registrationDate: '2020-04-02T17:41:59.277Z',
    mobile: '0555555555',
    regionId: 'NV25GlPuOnQ=',
    carTypeId: 'oIcaYzeDfQQ=',
    cityId: 'NV25GlPuOnQ=',
    carNumber: '1234ERS',
    vehicleSequenceNumber: '987564212'
);

$driver = LaravelTawseel::editDriver($editDriverDTO);
```

#### Deactivate Driver

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\Driver\DeactivateDriverDTO;

$deactivateDTO = new DeactivateDriverDTO(
    credential: $credential,
    idNumber: '1016990911'
);

$driver = LaravelTawseel::deactivateDriver($deactivateDTO);
```

### Order Management

#### Create Order

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\Order\CreateOrderDTO;

$createOrderDTO = new CreateOrderDTO(
    credential: $credential,
    orderNumber: 'ORD-20231201-001',
    authorityId: 'NV25GlPuOnQ=',
    deliveryTime: '2020-04-08T12:43:33.369Z',
    regionId: 'NV25GlPuOnQ=',
    cityId: 'NV25GlPuOnQ=',
    coordinates: '24.7842, 46.6453',
    storetName: 'Halol Restaurant',
    storeLocation: '24.751433, 46.740517',
    categoryId: 'NV25GlPuOnQ=',
    orderDate: '2020-04-19T12:07:10.723Z',
    recipientMobileNumber: '966555555555'
);

$order = LaravelTawseel::createOrder($createOrderDTO);
echo $order->referenceCode; // Order reference code
```

#### Accept Order

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\Order\AcceptOrderDTO;

$acceptOrderDTO = new AcceptOrderDTO(
    credential: $credential,
    referenceCode: '7kRgMtOkdQE=',
    acceptanceDateTime: '2020-04-08T15:43:29.228Z'
);

$accepted = LaravelTawseel::acceptOrder($acceptOrderDTO);
```

#### Assign Driver to Order

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\Order\AssignDriverToOrderDTO;

$assignDTO = new AssignDriverToOrderDTO(
    credential: $credential,
    referenceCode: '7kRgMtOkdQE=',
    idNumber: '1016990911'
);

$assigned = LaravelTawseel::assignDriverToOrder($assignDTO);
```

#### Execute Order

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\Order\ExecuteOrderDTO;

$executeDTO = new ExecuteOrderDTO(
    credential: $credential,
    referenceCode: '7kRgMtOkdQE=',
    executionTime: '2020-04-08T15:49:19.459Z',
    paymentMethodId: 'NV25GlPuOnQ=',
    price: 180.5,
    priceWithoutDelivery: 150.0,
    deliveryPrice: 30.5,
    driverIncome: 20.0
);

$execution = LaravelTawseel::executeOrder($executeDTO);
```

#### Get Order

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\Order\GetOrderDTO;

$getOrderDTO = new GetOrderDTO(
    credential: $credential,
    refrenceCode: '7kRgMtOkdQE='
);

$order = LaravelTawseel::getOrder($getOrderDTO);
echo $order->status; // Order status
```

### Contact Information

#### Create/Update Contact Info

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\ContactInfo\CreateContactInfoDTO;

$contactInfoDTO = new CreateContactInfoDTO(
    credential: $credential,
    responsibleName: 'Ahmed Al-Mansoori',
    responsibleEmail: 'ahmed@company.com',
    responsibleMobileNumber: '966555123456',
    technicalName: 'Sara Al-Otaibi',
    technicalEmail: 'sara@company.com',
    technicalMobileNumber: '966555654321'
);

$created = LaravelTawseel::createContactInfo($contactInfoDTO);
```

#### Get Contact Info

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\ContactInfo\GetContactInfoDTO;

$getContactDTO = new GetContactInfoDTO(
    companyName: config('tawseel.company_name'),
    password: config('tawseel.password')
);

$contactInfo = LaravelTawseel::getContactInfo($getContactDTO);
```

### Lookups

#### Get Lookups

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\Enums\LookupType;
use Habib\LaravelTawseel\DTOs\Requests\Lookup\GeneralLookupDTO;

$lookupDTO = new GeneralLookupDTO(
    companyName: config('tawseel.company_name'),
    password: config('tawseel.password')
);

// Get regions
$regions = LaravelTawseel::getLookup(LookupType::Regions, $lookupDTO);

// Get categories
$categories = LaravelTawseel::getLookup(LookupType::Categories, $lookupDTO);

// Get payment methods
$paymentMethods = LaravelTawseel::getLookup(LookupType::PaymentMethods, $lookupDTO);

// Available lookup types:
// - LookupType::Authorities
// - LookupType::CancellationReasons
// - LookupType::Regions
// - LookupType::Categories
// - LookupType::IdentityTypes
// - LookupType::PaymentMethods
// - LookupType::CarTypes
// - LookupType::Countries

foreach ($regions as $region) {
    echo $region->nameEn; // English name
    echo $region->nameAr; // Arabic name
    echo $region->id;    // Lookup ID
}
```

#### Get Cities by Region

```php
use Habib\LaravelTawseel\Facades\LaravelTawseel;
use Habib\LaravelTawseel\DTOs\Requests\Lookup\CitiesLookupDTO;

$citiesDTO = new CitiesLookupDTO(
    credential: $credential,
    regionId: 'NV25GlPuOnQ='
);

$cities = LaravelTawseel::getCities($citiesDTO);

foreach ($cities as $city) {
    echo $city->nameEn;
    echo $city->id;
}
```

## Error Handling

The package provides comprehensive error handling with custom exceptions:

```php
use Habib\LaravelTawseel\Exceptions\TawseelApiException;
use Habib\LaravelTawseel\Exceptions\TawseelAuthenticationException;
use Habib\LaravelTawseel\Exceptions\TawseelValidationException;

try {
    $driver = LaravelTawseel::createDriver($driverDTO);
} catch (TawseelValidationException $e) {
    // Validation errors
    $errors = $e->getErrors();
} catch (TawseelAuthenticationException $e) {
    // Authentication failed
    echo $e->getMessage();
} catch (TawseelApiException $e) {
    // API error with error codes
    $errorCodes = $e->getErrorCodes();
    echo $e->getMessage();
    
    // Check for specific error code
    if ($e->hasErrorCode(47)) {
        echo 'Driver already exists';
    }
}
```

### Common Error Codes

- `0` - Successful transaction
- `2` - Not found (Driver/Order)
- `5` - Invalid credentials
- `47` - Driver already exists
- `58` - Order number already exists today
- `72` - Can only assign driver to accepted orders
- `83` - COVID-19 active
- `94` - Not vaccinated against COVID-19

See the [API documentation](https://demo-apitawseel.naql.sa/) for the complete list of error codes.

## Validation Rules

The package includes custom validation rules for Saudi-specific formats:

- `ValidIdNumber` - Validates Saudi ID (10 digits, starts with 1 or 2)
- `ValidMobileNumber` - Validates driver mobile (10 digits, starts with 05)
- `ValidRecipientMobile` - Validates recipient mobile (12 chars, starts with 9665)
- `ValidCarNumber` - Validates car number (4 digits + 3 letters)
- `ValidCoordinates` - Validates coordinates format ("latitude, longitude")
- `ValidDateOfBirth` - Validates date of birth (YYYYMMDD, 8 digits)

You can use these rules in your Laravel validation:

```php
use Habib\LaravelTawseel\Rules\ValidIdNumber;
use Habib\LaravelTawseel\Rules\ValidMobileNumber;

$request->validate([
    'id_number' => ['required', new ValidIdNumber()],
    'mobile' => ['required', new ValidMobileNumber()],
]);
```

## Available Methods

### Driver Management

- `createDriver(CreateDriverDTO $dto): DriverResponseDTO`
- `editDriver(EditDriverDTO $dto): DriverResponseDTO`
- `getDriver(GetDriverDTO $dto): DriverResponseDTO`
- `deactivateDriver(DeactivateDriverDTO $dto): DriverResponseDTO`

### Order Management

- `createOrder(CreateOrderDTO $dto): OrderResponseDTO`
- `acceptOrder(AcceptOrderDTO $dto): bool`
- `rejectOrder(RejectOrderDTO $dto): bool`
- `assignDriverToOrder(AssignDriverToOrderDTO $dto): bool`
- `editOrderDeliveryAddress(EditOrderDeliveryAddressDTO $dto): bool`
- `executeOrder(ExecuteOrderDTO $dto): OrderExecutionResponseDTO`
- `cancelOrder(CancelOrderDTO $dto): bool`
- `getOrder(GetOrderDTO $dto): OrderResponseDTO`

### Contact Information

- `createContactInfo(CreateContactInfoDTO $dto): bool`
- `getContactInfo(GetContactInfoDTO $dto): ContactInfoResponseDTO`

### Lookups

- `getLookup(LookupType $type, GeneralLookupDTO $dto): array`
- `getCities(CitiesLookupDTO $dto): array`

## Testing

```bash
composer test
```

## Requirements

- PHP 8.3+
- Laravel 11.0+ or 12.0+

## Support

For API support, contact: [TawseelSupport@elm.sa](mailto:TawseelSupport@elm.sa)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mohamed Habib](https://github.com/mohamedhabibwork)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
