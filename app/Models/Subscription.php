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
        'card_brand',
        'renews_at',
        'ends_at',
        'tenant_id',
        'product_id',
    ];

    protected $casts = [
        'status' => SubscriptionStatus::class,
        'renews_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function shouldRenew(): bool
    {
        return $this->isNotActive() && ($this->renews_at <= now());
    }

    public function isActive(): bool
    {
        return $this->status === SubscriptionStatus::ACTIVE;
    }

    public function isNotActive(): bool
    {
        return !$this->isActive();
    }
}
