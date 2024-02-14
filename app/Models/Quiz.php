<?php

namespace App\Models;

use App\Enums\QuizType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'marks_total' => 'integer',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
