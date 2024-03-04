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
        'timer',
        'is_timeout',
        'user_id',
        'tenant_id',
        'started_at',
        'expired_at',
    ];

    protected $casts = [
        'type' => QuizType::class,
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
        'marks_total' => 'integer',
        'is_timeout' => 'boolean',
    ];

    public function isPublic(): bool
    {
        return $this->type === QuizType::PUBLIC;
    }

    public function isPrivate(): bool
    {
        return $this->type === QuizType::PRIVATE;
    }

    public function hasStarted(): bool
    {
        return $this->started_at <= now();
    }

    public function hasExpired(): bool
    {
        return $this->expired_at <= now();
    }

    public function isAvailable()
    {
        return $this->hasStarted() && !$this->hasExpired();
    }

    public function getDaysLeft(): int
    {
        if ($this->hasExpired()) {
            return 0;
        }

        return $this->expired_at->diffInDays(now());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
