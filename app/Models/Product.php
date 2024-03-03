<?php

namespace App\Models;

use App\Constants\Product\Fresher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        foreach ($this->subscriptions as $subscription) {
            if ($subscription->isNotActive()) {
                continue;
            }

            return $subscription->isActive();
        }

        return false;
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
