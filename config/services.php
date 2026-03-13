<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'geidea' => [
        'merchant_key' => env('GEIDEA_MERCHANT_KEY'),
        'password' => env('GEIDEA_PASSWORD'),
        'base_url' => env('GEIDEA_BASE_URL', 'https://api.merchant.geidea.net'),
    ],
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sp-api' => [
        'SP_APP_ID' => env('SP_APP_ID'),
        'SP_APP_REDIRECT' => env('SP_APP_REDIRECT'),
        'SP_APP_CLIENT_ID' => env('SP_APP_CLIENT_ID'),
        'SP_APP_CLIENT_SECRET' => env('SP_APP_CLIENT_SECRET'),
        'SP_APP_REFRESH_TOKEN' => env('SP_APP_REFRESH_TOKEN'),
    ],
    'keepa-api' => [
        'KEEPA_API_KEY' => env('KEEPA_API_KEY'),
    ],
];
