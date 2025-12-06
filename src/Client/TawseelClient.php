<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Client;

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
use Habib\LaravelTawseel\DTOs\Responses\ApiResponseDTO;
use Habib\LaravelTawseel\DTOs\Responses\ContactInfo\ContactInfoResponseDTO;
use Habib\LaravelTawseel\DTOs\Responses\Driver\DriverResponseDTO;
use Habib\LaravelTawseel\DTOs\Responses\Lookup\LookupItemDTO;
use Habib\LaravelTawseel\DTOs\Responses\Order\OrderExecutionResponseDTO;
use Habib\LaravelTawseel\DTOs\Responses\Order\OrderResponseDTO;
use Habib\LaravelTawseel\Enums\Environment;
use Habib\LaravelTawseel\Enums\LookupType;
use Habib\LaravelTawseel\Exceptions\TawseelApiException;
use Habib\LaravelTawseel\Exceptions\TawseelAuthenticationException;
use Habib\LaravelTawseel\Exceptions\TawseelException;
use Habib\LaravelTawseel\Exceptions\TawseelValidationException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

final class TawseelClient implements TawseelClientInterface
{
    private readonly string $baseUrl;

    public function __construct(
        private readonly string $companyName,
        private readonly string $password,
        private readonly Environment $environment = Environment::Test,
        private readonly int $timeout = 30
    ) {
        $baseUrls = config('tawseel.base_urls', []);
        $envKey = $this->environment->value;
        $this->baseUrl = $baseUrls[$envKey] ?? throw new TawseelException("Base URL not configured for environment: {$envKey}");
    }

    public function createDriver(CreateDriverDTO $dto): DriverResponseDTO
    {
        $this->validateRequest($dto->toArray(), CreateDriverDTO::rules());

        $response = $this->makeRequest('POST', '/api/Driver/create', $dto->toArray());

        return DriverResponseDTO::fromArray($response->data);
    }

    public function editDriver(EditDriverDTO $dto): DriverResponseDTO
    {
        $this->validateRequest($dto->toArray(), EditDriverDTO::rules());

        $response = $this->makeRequest('POST', '/api/Driver/edit', $dto->toArray());

        return DriverResponseDTO::fromArray($response->data);
    }

    public function getDriver(GetDriverDTO $dto): DriverResponseDTO
    {
        $this->validateRequest($dto->toArray(), GetDriverDTO::rules());

        $response = $this->makeRequest('POST', '/api/Driver/get', $dto->toArray());

        return DriverResponseDTO::fromArray($response->data);
    }

    public function deactivateDriver(DeactivateDriverDTO $dto): DriverResponseDTO
    {
        $this->validateRequest($dto->toArray(), DeactivateDriverDTO::rules());

        $response = $this->makeRequest('POST', '/api/Driver/deActivate', $dto->toArray());

        return DriverResponseDTO::fromArray($response->data);
    }

    public function createOrder(CreateOrderDTO $dto): OrderResponseDTO
    {
        $this->validateRequest($dto->toArray(), CreateOrderDTO::rules());

        $response = $this->makeRequest('POST', '/api/Order/create', $dto->toArray());

        return OrderResponseDTO::fromArray($response->data);
    }

    public function acceptOrder(AcceptOrderDTO $dto): bool
    {
        $this->validateRequest($dto->toArray(), AcceptOrderDTO::rules());

        $response = $this->makeRequest('POST', '/api/Order/accept', $dto->toArray());

        return $response->data === true;
    }

    public function rejectOrder(RejectOrderDTO $dto): bool
    {
        $this->validateRequest($dto->toArray(), RejectOrderDTO::rules());

        $response = $this->makeRequest('POST', '/api/Order/reject', $dto->toArray());

        return $response->data === true;
    }

    public function assignDriverToOrder(AssignDriverToOrderDTO $dto): bool
    {
        $this->validateRequest($dto->toArray(), AssignDriverToOrderDTO::rules());

        $response = $this->makeRequest('POST', '/api/Order/assign-driver-to-order', $dto->toArray());

        return $response->data === true;
    }

    public function editOrderDeliveryAddress(EditOrderDeliveryAddressDTO $dto): bool
    {
        $this->validateRequest($dto->toArray(), EditOrderDeliveryAddressDTO::rules());

        $response = $this->makeRequest('POST', '/api/Order/edit-order-delivery-address', $dto->toArray());

        return $response->data === true;
    }

    public function executeOrder(ExecuteOrderDTO $dto): OrderExecutionResponseDTO
    {
        $this->validateRequest($dto->toArray(), ExecuteOrderDTO::rules());

        $response = $this->makeRequest('POST', '/api/Order/execute', $dto->toArray());

        return OrderExecutionResponseDTO::fromArray($response->data);
    }

    public function cancelOrder(CancelOrderDTO $dto): bool
    {
        $this->validateRequest($dto->toArray(), CancelOrderDTO::rules());

        $response = $this->makeRequest('POST', '/api/Order/cancel', $dto->toArray());

        return $response->data === true;
    }

    public function getOrder(GetOrderDTO $dto): OrderResponseDTO
    {
        $this->validateRequest($dto->toArray(), GetOrderDTO::rules());

        $response = $this->makeRequest('POST', '/api/Order/get', $dto->toArray());

        return OrderResponseDTO::fromArray($response->data);
    }

    public function createContactInfo(CreateContactInfoDTO $dto): bool
    {
        $this->validateRequest($dto->toArray(), CreateContactInfoDTO::rules());

        $response = $this->makeRequest('POST', '/api/app/contact-info', $dto->toArray());

        return $response->data === null;
    }

    public function getContactInfo(GetContactInfoDTO $dto): ContactInfoResponseDTO
    {
        $this->validateRequest($dto->toArray(), GetContactInfoDTO::rules());

        $response = $this->makeRequest('POST', '/api/app/contact-info/get', $dto->toArray());

        return ContactInfoResponseDTO::fromArray($response->data ?? []);
    }

    public function getLookup(LookupType $type, GeneralLookupDTO $dto): array
    {
        $this->validateRequest($dto->toArray(), GeneralLookupDTO::rules());

        $endpoint = match ($type) {
            LookupType::Authorities => '/api/Lookup/authorities-list',
            LookupType::CancellationReasons => '/api/Lookup/cancellation-reasons-list',
            LookupType::Regions => '/api/Lookup/regions-list',
            LookupType::Categories => '/api/Lookup/categories-list',
            LookupType::IdentityTypes => '/api/Lookup/identity-types-list',
            LookupType::PaymentMethods => '/api/Lookup/payment-methods-list',
            LookupType::CarTypes => '/api/Lookup/car-types-list',
            LookupType::Countries => '/api/Lookup/countries-list',
            LookupType::Cities => throw new TawseelException('Use getCities() method for cities lookup'),
        };

        $response = $this->makeRequest('POST', $endpoint, $dto->toArray());

        if (! is_array($response->data)) {
            return [];
        }

        return LookupItemDTO::fromArrayCollection($response->data);
    }

    public function getCities(CitiesLookupDTO $dto): array
    {
        $this->validateRequest($dto->toArray(), CitiesLookupDTO::rules());

        $response = $this->makeRequest('POST', '/api/Lookup/cities-list', $dto->toArray());

        if (! is_array($response->data)) {
            return [];
        }

        return LookupItemDTO::fromArrayCollection($response->data);
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $rules
     *
     * @throws TawseelValidationException
     */
    private function validateRequest(array $data, array $rules): void
    {
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new TawseelValidationException($validator);
        }
    }

    /**
     * @param  array<string, mixed>  $payload
     *
     * @throws TawseelApiException
     * @throws TawseelAuthenticationException
     * @throws TawseelException
     */
    private function makeRequest(string $method, string $endpoint, array $payload): ApiResponseDTO
    {
        try {
            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->{strtolower($method)}($this->baseUrl.$endpoint, $payload);

            if ($response->failed()) {
                $this->handleHttpError($response->status(), $response->body());
            }

            $data = $response->json();

            if (! is_array($data)) {
                throw new TawseelException('Invalid response format from API');
            }

            $apiResponse = ApiResponseDTO::fromArray($data);

            if (! $apiResponse->isSuccess()) {
                $this->handleApiError($apiResponse);
            }

            return $apiResponse;
        } catch (RequestException $e) {
            throw new TawseelException('HTTP request failed: '.$e->getMessage(), 0, $e);
        } catch (ConnectionException $e) {
            throw new TawseelException('Connection failed: '.$e->getMessage(), 0, $e);
        }
    }

    /**
     * @throws TawseelAuthenticationException
     * @throws TawseelApiException
     */
    private function handleHttpError(int $statusCode, string $body): never
    {
        if ($statusCode === 401 || $statusCode === 403) {
            throw new TawseelAuthenticationException('Authentication failed');
        }

        throw new TawseelApiException("HTTP error {$statusCode}: {$body}", []);
    }

    /**
     * @throws TawseelAuthenticationException
     * @throws TawseelApiException
     */
    private function handleApiError(ApiResponseDTO $response): never
    {
        $errorCodes = $response->errorCodes;

        if (empty($errorCodes)) {
            throw new TawseelApiException('API returned an error without error codes', []);
        }

        // Check for authentication error (code 5)
        if (in_array(5, $errorCodes, true)) {
            throw new TawseelAuthenticationException('Invalid credentials', 5);
        }

        $errorMessages = $this->getErrorMessages($errorCodes);
        $message = implode('; ', $errorMessages);

        throw new TawseelApiException($message, $errorCodes);
    }

    /**
     * @param  array<int>  $errorCodes
     * @return array<string>
     */
    private function getErrorMessages(array $errorCodes): array
    {
        $messages = [];

        foreach ($errorCodes as $code) {
            $messages[] = $this->getErrorMessage($code);
        }

        return $messages;
    }

    private function getErrorMessage(int $code): string
    {
        return match ($code) {
            0 => 'Successful transaction',
            2 => 'Not found (Driver/Order)',
            5 => 'Invalid credentials',
            7 => 'Identity type ID required',
            8 => 'ID number required',
            9 => 'Date of birth required',
            10 => 'Registration date required',
            11 => 'Mobile required',
            12 => 'Region ID required',
            13 => 'City ID required',
            14 => 'Car type required',
            15 => 'Car number required',
            16 => 'Invalid nationality ID',
            17 => 'Invalid identity type ID',
            18 => 'Invalid region ID',
            19 => 'Invalid city ID',
            20 => 'Invalid ID number',
            21 => 'Invalid driver ID',
            22 => 'City doesn\'t belong to region',
            23 => 'Order number required',
            24 => 'Authority ID required',
            25 => 'Category ID required',
            26 => 'Delivery time required',
            27 => 'Invalid authority ID',
            28 => 'Invalid category ID',
            29 => 'Invalid order ID',
            36 => 'Empty entries',
            37 => 'Invalid cancellation reason ID',
            38 => 'Coordinates required',
            39 => 'Payment method ID required',
            40 => 'Price required',
            42 => 'Invalid payment method ID',
            44 => 'MOI invalid identity',
            45 => 'Invalid car type ID',
            47 => 'Driver already exists',
            49 => 'Cannot change nationality/ID/identity type',
            50 => 'Store name required',
            51 => 'Store location required',
            52 => 'Order cannot be accepted',
            53 => 'Order cannot be canceled',
            54 => 'Order not accepted yet',
            55 => 'Cannot update after execution',
            56 => 'Reference code required',
            57 => 'Driver must be assigned first',
            58 => 'Order number already exists today',
            59 => 'Invalid order number',
            60 => 'Invalid mobile (must start with 05, 10 digits)',
            61 => 'Date of birth doesn\'t match NIC records',
            65 => 'Date of birth must be 8 digits',
            66 => 'Order date required',
            67 => 'Acceptance date wrong',
            68 => 'Execution time wrong',
            70 => 'Order already executed',
            71 => 'Only accepted orders can be executed',
            72 => 'Can only assign driver to accepted orders',
            73 => 'Execution time cannot be earlier than order date',
            74 => 'Driver already assigned to this order',
            75 => 'Execution time must be greater than assigning time',
            77 => 'Order cannot be rejected',
            79 => 'Acceptance date cannot be earlier than order date',
            80 => 'ID number expired',
            81 => 'Invalid birthdate format',
            82 => 'Driver younger than 18',
            83 => 'COVID-19 active',
            84 => 'Driver not healthy',
            85 => 'Vehicle sequence number required',
            86 => 'Invalid vehicle sequence number',
            87 => 'Vehicle license expired',
            88 => 'Vehicle MVPI expired',
            89 => 'Driver not authorized for vehicle',
            90 => 'Driving license expired',
            91 => 'Driver is accompanying',
            92 => 'Prohibited occupation',
            93 => 'Order has been closed',
            94 => 'Not vaccinated against COVID-19',
            95 => 'Driver reached maximum orders per day',
            96 => 'Driver cannot deliver in two regions',
            97 => 'Driver has active order in another app',
            98 => 'Driver deactivated by app',
            99 => 'Invalid order bulk file template',
            100 => 'Invalid order bulk UUID',
            101 => 'Order bulk is disabled',
            102 => 'Order bulk disabled for your app',
            103 => 'Illegal number of rows',
            104 => 'Still processing order bulk',
            105 => 'Incorrect mobile number format',
            106 => 'Incorrect price format',
            107 => 'Email required',
            108 => 'Incorrect email format',
            109 => 'Technical and responsible names required',
            110 => 'No contact info for this app',
            112 => 'No operation card',
            113 => 'No active operation card',
            114 => 'Violated allowed distance',
            115 => 'Invalid country code',
            116 => 'Invalid coordinates',
            117 => 'Invalid store location',
            118 => 'No activity license',
            119 => 'No active activity license',
            121 => 'Face verification required',
            123 => 'Driver suspended by TGA',
            124 => 'Driver has no vehicle',
            126 => 'Motorcycle not permitted at this time',
            133 => 'No driver card found',
            134 => 'No active driver card found',
            200 => 'Successful transaction',
            default => "Unknown error code: {$code}",
        };
    }
}
