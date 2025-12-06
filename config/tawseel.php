<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Environment
    |--------------------------------------------------------------------------
    |
    | Set to 'test' for demo environment or 'production' for live environment
    |
    */
    'environment' => env('TAWSEEL_ENVIRONMENT', 'test'),

    /*
    |--------------------------------------------------------------------------
    | API Base URLs
    |--------------------------------------------------------------------------
    |
    | Base URLs for test and production environments
    |
    */
    'base_urls' => [
        'test' => env('TAWSEEL_TEST_URL', 'https://demo-apitawseel.naql.sa'),
        'production' => env('TAWSEEL_PRODUCTION_URL', 'https://tawseelapi.ecloud.sa'),
    ],

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    |
    | Your company name and password for API authentication
    |
    */
    'company_name' => env('TAWSEEL_COMPANY_NAME', ''),
    'password' => env('TAWSEEL_PASSWORD', ''),

    /*
    |--------------------------------------------------------------------------
    | HTTP Client Settings
    |--------------------------------------------------------------------------
    |
    | Timeout settings for API requests
    |
    */
    'timeout' => env('TAWSEEL_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | Support Email
    |--------------------------------------------------------------------------
    |
    | Support email for Tawseel API
    |
    */
    'support_email' => 'TawseelSupport@elm.sa',
];
