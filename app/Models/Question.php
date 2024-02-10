<?php

namespace App\Models;

use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
