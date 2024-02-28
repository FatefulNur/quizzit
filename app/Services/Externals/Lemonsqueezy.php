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
}
