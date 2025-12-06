# Changelog

All notable changes to `laravel-tawseel` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-12-07

### Added

#### Driver Management APIs

- `createDriver()` - Register a new driver in the Tawseel system
- `editDriver()` - Update existing driver details
- `getDriver()` - Retrieve driver data and eligibility status
- `deactivateDriver()` - Deactivate a driver in the system

#### Order Management APIs

- `createOrder()` - Create a new order and receive a reference ID
- `acceptOrder()` - Accept an order and update its status
- `rejectOrder()` - Reject an order and update its status
- `assignDriverToOrder()` - Assign a specific driver to an accepted order
- `editOrderDeliveryAddress()` - Update order delivery location details
- `executeOrder()` - Mark order as delivered/executed with payment details
- `cancelOrder()` - Cancel an order with a reason
- `getOrder()` - Retrieve complete order details

#### Contact Information APIs

- `createContactInfo()` - Create or update assigned contact person information
- `getContactInfo()` - Retrieve stored contact person information

#### Lookup APIs

- `getLookup()` - Retrieve lookup values for various system entities (authorities, cancellation reasons, regions, categories, identity types, payment methods, car types, countries)
- `getCities()` - Retrieve city/area lookups filtered by region ID

#### Core Features

- Complete HTTP client wrapper (`TawseelClient`) using Laravel's HTTP client
- Request/Response DTOs for type-safe API interactions
- Comprehensive error handling with custom exceptions:
  - `TawseelException` - Base exception class
  - `TawseelApiException` - API error response exception with error code mapping
  - `TawseelValidationException` - Validation exception
  - `TawseelAuthenticationException` - Authentication exception
- Custom validation rules:
  - `ValidIdNumber` - Validates Saudi ID number format (10 digits, starts with 1 or 2)
  - `ValidMobileNumber` - Validates driver mobile number (10 digits, starts with 05)
  - `ValidRecipientMobile` - Validates recipient mobile number (12 chars, starts with 9665)
  - `ValidCarNumber` - Validates car number format (4 digits + 3 letters)
  - `ValidCoordinates` - Validates coordinates format ("latitude, longitude")
  - `ValidDateOfBirth` - Validates date of birth format (YYYYMMDD, 8 digits)
- Enums for type safety:
  - `Environment` - API environment (test/production)
  - `OrderStatus` - Order status values
  - `LookupType` - Lookup endpoint types
- Configuration file (`config/tawseel.php`) with:
  - API credentials (companyName, password)
  - Base URLs for test and production environments
  - HTTP client timeout settings
- Service provider with dependency injection
- Facade for easy access (`LaravelTawseel`)
- Support for PHP 8.3+ features (readonly properties, typed constants, etc.)
- Full error code mapping (126+ error codes with English descriptions)
- Array parsing support for lookup endpoints
- Request validation before API calls

#### Technical Details

- Uses Laravel's HTTP client facade for API requests
- Implements Laravel validation rules
- Follows PSR-4 autoloading standards
- One class per file architecture
- Strict typing throughout
- Comprehensive PHPDoc annotations
