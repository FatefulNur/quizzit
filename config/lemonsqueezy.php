<?php

return [
    // api key
    "secret" => env('LEMONSQUEEZY_SECRET'),

    "webhook" => [
        "subscription" => [
            "created" => [
                "sign" => env('LEMONSQUEEZY_WEBHOOK_SUBSCRIPTION_CREATED_SIGN'),
            ],
        ],
    ],
];
