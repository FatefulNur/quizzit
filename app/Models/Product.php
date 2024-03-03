<?php

namespace App\Models;

use App\Constants\Product\Fresher;
use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity',
        'name',
        'slug',
        'description',
        'status',
        'price',
        'price_formatted',
        'buy_now_url',
    ];

    protected $casts = [
        'price' => 'decimal:8',
    ];

    public function isFresher(): bool
    {
        return $this->name === Fresher::NAME;
    }

    public function isCurrent(): bool
    {
        return $this->currentSubscription()?->exists();
    }

    public function isCancelled(): bool
    {
        return $this->cancelledSubscription()?->exists();
    }

    public function currentSubscription(): HasOne
    {
        return $this->subscriptions()->one()->where('status', SubscriptionStatus::ACTIVE);
    }

    public function cancelledSubscription(): HasOne
    {
        return $this->subscriptions()->one()->where('status', SubscriptionStatus::CANCELLED);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
