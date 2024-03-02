<?php

namespace App\Models;

use App\Constants\Product\Fresher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function isCurrent()
    {
        return $this->tenants()->where('id', auth()->user()->tenant->id)->get();
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }
}
