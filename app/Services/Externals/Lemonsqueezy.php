<?php

namespace App\Services\Externals;

use Illuminate\Support\Facades\Http;

class Lemonsqueezy
{
    public static function getProducts()
    {
        return Http::lemonsqueezy()->get('/v1/products');
    }

    public static function getCustomer(int $id)
    {
        return Http::lemonsqueezy()->get("/v1/customers/{$id}");
    }

    public static function updateCustomer(int $id, array $data)
    {
        return Http::lemonsqueezy()->patch(
            "/v1/customers/{$id}",
            static::patchObject('customers', $id, $data),
        );
    }

    public static function cancelSubscription(int $id)
    {
        return Http::lemonsqueezy()->delete("v1/subscriptions/{$id}");
    }

    public static function resumeSubscription(int $id)
    {
        return Http::lemonsqueezy()->patch(
            "v1/subscriptions/{$id}",
            static::patchObject('subscriptions', $id, [
                "cancelled" => false,
            ]),
        );
    }

    private static function patchObject(string $type, int $id, array $data): array
    {
        return [
            'data' => [
                'type' => $type,
                'id' => "{$id}",
                'attributes' => [
                    ...$data,
                ],
            ],
        ];
    }
}
