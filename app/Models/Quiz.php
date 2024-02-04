<?php

namespace App\Models;

use App\Enums\QuizType\QuizType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'description',
        'marks_total',
        'type',
        'user_id',
        'expired_at',
    ];

    protected $casts = [
        'type' => QuizType::class,
        'expired_at' => 'datetime',
    ];
}
