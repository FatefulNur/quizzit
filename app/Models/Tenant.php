<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function hasAnyActiveSubscription(): bool
    {
        foreach ($this->subscriptions as $subscription) {
            if ($subscription->isNotActive()) {
                continue;
            }

            return $subscription->isActive();
        }

        return false;
    }

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
