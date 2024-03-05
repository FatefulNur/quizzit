<?php

namespace App\Models;

use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'hint',
        'marks',
        'type',
        'quiz_id',
    ];

    protected $casts = [
        'type' => QuestionType::class,
        'marks' => 'integer',
    ];

    public function isShortText(): bool
    {
        return $this->type === QuestionType::SHORT_TEXT;
    }

    public function isLongText(): bool
    {
        return $this->type === QuestionType::LONG_TEXT;
    }

    public function isRadio(): bool
    {
        return $this->type === QuestionType::RADIO;
    }

    public function isCheckbox(): bool
    {
        return $this->type === QuestionType::CHECKBOX;
    }

    public function isMCQ(): bool
    {
        return $this->isCheckbox() || $this->isRadio();
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
