<?php

namespace App\Models;

use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity',
        'name',
        'email',
        'city',
        'region',
        'country',
    ];

    public function hasActiveSubscription(): bool
    {
        return $this->activeSubscription()?->exists();
    }

    public function activeSubscription(): HasOne
    {
        return $this->subscriptions()->one()->where('status', SubscriptionStatus::ACTIVE);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
