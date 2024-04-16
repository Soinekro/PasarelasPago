<?php

return [

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

    'izi_pay' => [
        'url' => env('IZIPAY_URL'),
        'client_id' => env('IZIPAY_CLIENT_ID'),
        'client_secret' => env('IZIPAY_CLIENT_SECRET'),
        'public_key' => env('IZIPAY_PUBLIC_KEY'),
        'hash_key' => env('IZIPAY_HASH_KEY'),
    ],

    'pay_u' => [
        'merchant_id' => env('PAYU_MERCHANT_ID'),
        'account_id' => env('PAYU_ACCOUNT_ID'),
        'api_key' => env('PAYU_API_KEY'),
        'api_login' => env('PAYU_API_LOGIN'),
        'public_key' => env('PAYU_PUBLIC_KEY'),
    ],
];
