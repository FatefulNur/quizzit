<?php

namespace App\Models;

use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity',
        'product_name',
        'user_name',
        'user_email',
        'status',
        'cancelled',
        'card_brand',
        'renews_at',
        'ends_at',
        'tenant_id',
        'product_id',
    ];

    protected $casts = [
        'status' => SubscriptionStatus::class,
        'cancelled' => 'boolean',
        'renews_at' => 'datetime',
        'ends_at' => 'datetime',
    ];
}
