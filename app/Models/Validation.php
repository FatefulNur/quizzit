<?php

namespace App\Models;

use App\Enums\ValidationRule;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'rule',
        'tenant_id',
        'question_id',
        'parameters',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'rule' => ValidationRule::class,
            'parameters' => 'array',
        ];
    }
}
