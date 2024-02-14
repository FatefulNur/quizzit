<?php

namespace App\Services;

use App\Enums\QuizType;
use Illuminate\Support\Facades\DB;

class QuizService
{
    public static function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $marks_total = 0;
            $quizzes = collect($data)->except(['type', 'questions'])->all();
            $type = ($data['type']) ? QuizType::PRIVATE : QuizType::PUBLIC;
            $quiz = auth()->user()->quizzes()->create([
                ...$quizzes,
                'type' => $type,
            ]);

            $questionsData = collect($data['questions'])->all();
            foreach ($questionsData as $item) {
                $questionData = collect($item)->except('options')->all();
                $marks_total += $questionData['marks'];

                $question = $quiz->questions()->create($questionData);

                $optionData = collect($item['options'])->all();
                $question->options()->createMany($optionData);
            }

            $quiz->marks_total = $marks_total;
            $quiz->save();

            return $quiz;
        }, 3);
    }
}
