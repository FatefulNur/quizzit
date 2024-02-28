<?php

namespace App\Models;

use App\Constants\Plan\Fresher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
