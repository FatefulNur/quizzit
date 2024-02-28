<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity',
        'plan_name',
        'user_name',
        'user_email',
        'status',
        'card_brand',
        'renews_at',
        'ends_at',
        'tenant_id',
        'plan_id',
    ];

    protected $casts = [
        'renews_at' => 'datetime',
        'ends_at' => 'datetime',
    ];
}
