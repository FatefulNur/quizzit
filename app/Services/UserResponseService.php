<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\UserResponse;
use Illuminate\Support\Facades\DB;

class UserResponseService
{
    public static function store(Quiz $quiz, array $data)
    {
        return DB::transaction(function () use ($quiz, $data) {
            $result = 0;

            if (!is_null($quiz->timer)) {
                $quiz->update(['is_timeout' => 1]);
            }

            $userResponse = UserResponse::create([
                'result' => $result,
                'user_id' => auth()?->id(),
                'tenant_id' => auth()->user()->tenant?->id ?? null,
                'quiz_id' => $quiz->id,
            ]);

            $formattedAnswers = [];

            foreach ($data as $answers) {
                $question = Question::select(['id', 'marks', 'type'])->find($answers['question_id']);

                $correctOptionsLabel = $question->options()
                    ->select('label')
                    ->where('is_correct', true)
                    ->get()->map->label->all();

                if ($question->isShortText() || $question->isLongText()) {
                    if (count($correctOptionsLabel)) {
                        $correctOptionsLabel = explode(',', $correctOptionsLabel[0]);
                    }
                }

                $filteredCorrectOptionsLabel = array_filter(array_map('trim', $correctOptionsLabel));

                $correct = implode(', ', $correctOptionsLabel);
                $isMarked = false;

                foreach ($answers['answer'] as $key => $answer) {
                    if (
                        !$isMarked &&
                        !empty ($answer) &&
                        in_array($answer, $filteredCorrectOptionsLabel)
                    ) {
                        $result += $question->marks;
                        $isMarked = true;
                    }

                    $formattedAnswers[] = [
                        'correct' => $correct ?? '',
                        'answer' => $answer,
                        'option_id' => $answers['option_id'][$key],
                        'question_id' => $answers['question_id'],
                    ];
                }
            }

            $userResponse->answers()->createMany($formattedAnswers);

            $userResponse->result = $result;
            $userResponse->save();

            return $userResponse;
        });
    }
}
