<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'tenant_id',
        'form_id',
        'is_default',
        'order_index',
    ];

    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
            'order_index' => 'integer',
        ];
    }
}
