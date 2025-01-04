<?php

namespace App\Models;

use App\Enums\FeedbackType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'message',
        'type',
        'tenant_id',
        'question_id',
    ];

    protected function casts(): array
    {
        return [
            'type' => FeedbackType::class,
        ];
    }
}
