<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'text',
        'tenant_id',
        'question_id',
        'option_id',
        'mark_others_incorrect',
        'points',
    ];

    protected function casts(): array
    {
        return [
            'mark_others_incorrect' => 'boolean',
            'points' => 'integer',
        ];
    }
}
