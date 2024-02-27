<?php

namespace App\Services\Externals;

use Illuminate\Support\Facades\Http;

class Lemonsqueezy
{
    public static function getProducts()
    {
        return Http::lemonsqueezy()->get('/v1/products');
    }
}
