<?php

return [

    'fedex' => [
        'url' => env('FEDEX_URL'),
        'key' => env('FEDEX_API_KEY'),
        'secret' => env('FEDEX_SECRET'),
        'account' => env('FEDEX_ACCOUNT'),
        'serviceType' => 'FEDEX_2_DAY',
        'meter' => env('FEDEX_METER'),
        'pass' => env('FEDEX_PASS')
    ],
];
