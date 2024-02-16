<?php

namespace App\Models;

use App\Enums\QuizType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'started_at',
        'expired_at',
    ];

    protected $casts = [
        'type' => QuizType::class,
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
        'marks_total' => 'integer',
    ];

    public function isPublic(): bool
    {
        return $this->type === QuizType::PUBLIC;
    }

    public function isPrivate(): bool
    {
        return $this->type === QuizType::PRIVATE;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
