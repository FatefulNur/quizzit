<?php

namespace App\Models;

use App\Enums\FormStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
        'tenant_id',
        'user_id',
        'started_at',
        'expired_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => FormStatus::class,
            'started_at' => 'datetime',
            'expired_at' => 'datetime',
        ];
    }
}
