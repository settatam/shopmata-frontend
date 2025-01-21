<?php

return [

    'fedex' => [
        'url' => env('FEDEX_URL'),
        'key' => env('FEDEX_API_KEY'),
        'secret' => env('FEDEX_SECRET'),
        'account' => env('FEDEX_ACCOUNT'),
        'serviceType' => 'FEDEX_2_DAY',
        'meter' => env('FEDEX_METER'),
        'pass' => env('FEDEX_PASS'),
        'rest_api_key' => env('FEDEX_REST_API_KEY'),
        'rest_api_secret' => env('FEDEX_REST_API_SECRET')
    ],
];
