<?php

return [

    /**
     * Опции кеширования данных с сервиса конвертера валют.
     */
    'currency_market' => [
        'cache' => [
            'expired' => env('CURRENCY_MARKET_CACHE_EXPIRED', 60),
            'key' => env('CURRENCY_MARKET_CACHE_KEY', 'currency-market'),
        ],
    ],

    /**
     * Опции источника данных Foreign Currency Market
     */
    'fcm' => [
        'url' => env('FCM_EXCHANGE_RATE_URL'),
    ],
];
