<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'label',
        'is_correct',
        'question_id',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];
}
