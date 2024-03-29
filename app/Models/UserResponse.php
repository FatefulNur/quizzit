<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserResponse extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'result',
        'user_id',
        'tenant_id',
        'quiz_id',
    ];

    protected $casts = [
        'result' => 'integer',
    ];

    public function getFirstQuestionAnswer($questionId)
    {
        return $this->answers()->where('question_id', $questionId)->first()?->answer;
    }

    public function hasSelectedOption($optionId): bool
    {
        return $this->answers()->where('option_id', $optionId)->exists();
    }

    public function hasCorrectOption($optionId): bool
    {
        $answer = $this->answers()->where('option_id', $optionId)->first();

        if (!$answer) {
            return false;
        }

        $correctOptions = explode(',', $answer->correct);
        $filteredCorrectOptions = array_filter(array_map('trim', $correctOptions));

        return in_array($answer->answer, $filteredCorrectOptions);
    }

    public function hasCorrectAnswer($questionId): bool
    {
        $answers = $this->answers()->where('question_id', $questionId)->get();

        $answerList = $answers->pluck('answer')->unique()->filter()->all();
        $correctOption = $answers->pluck('correct')->unique()->filter()->all();

        if (empty($correctOption) || empty($answerList)) {
            return false;
        }

        $correctOptionList = explode(',', $correctOption[0]);
        $trimmedCorrectOptionList = array_map('trim', $correctOptionList);

        $correctAnswers = array_intersect($answerList, $trimmedCorrectOptionList);

        return !empty($correctAnswers);
    }


    public function hasAnyCorrectOptions($question, $optionId): bool
    {
        $optionQuery = $question->options()->where('is_correct', true);
        $correctOptionLabels = $optionQuery->pluck('label')->filter()->all();

        if (empty($correctOptionLabels)) {
            return false;
        }

        return in_array($optionId, $optionQuery->pluck('id')->all());
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function user(): ?BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
