<?php

namespace App\Services;

use App\Models\Quiz;
use App\Enums\QuizType;
use App\Pipelines\QuizFilter;
use Illuminate\Support\Facades\DB;

class QuizService
{
    public static function get($queryParams = [])
    {
        $query = Quiz::query();

        return app(QuizFilter::class)->getResults([
            'builder' => $query,
            'params' => $queryParams,
        ]);
    }

    public static function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $marks_total = 0;
            $quizzes = collect($data)->except(['type', 'questions'])->all();
            $type = ($data['type']) ? QuizType::PRIVATE : QuizType::PUBLIC;
            $quiz = auth()->user()->quizzes()->create([
                ...$quizzes,
                'timer' => $quizzes['timer'] ?: null,
                'type' => $type,
                'tenant_id' => auth()->user()->tenant?->id,
            ]);

            if (array_key_exists('questions', $data)) {
                $questionsData = collect($data['questions'])->all();

                foreach ($questionsData as $item) {
                    $questionData = collect($item)->except('options')->all();
                    $marks_total += $questionData['marks'];

                    $question = $quiz->questions()->create($questionData);

                    $optionData = collect($item['options'])->all();
                    $question->options()->createMany($optionData);
                }
            }

            $quiz->marks_total = $marks_total;
            $quiz->save();

            return $quiz;
        }, 3);
    }

    public static function update(Quiz $quiz, array $data)
    {
        return DB::transaction(function () use ($quiz, $data) {
            $marks_total = 0;
            $quizzes = collect($data)->except(['type', 'questions'])->all();
            $type = ($data['type']) ? QuizType::PRIVATE : QuizType::PUBLIC;
            $quiz = tap($quiz)->update([
                ...$quizzes,
                'timer' => $quizzes['timer'] ?: null,
                'type' => $type,
                'tenant_id' => auth()->user()->tenant?->id ?? null,
            ]);

            if (array_key_exists('questions', $data)) {

                $questionsData = collect($data['questions'])->all();
                foreach ($questionsData as $item) {
                    $questionData = collect($item)->except('id', 'options')->all();

                    $marks_total += $questionData['marks'];

                    $question = $quiz->questions()->updateOrCreate(
                        ['id' => $item['id']],
                        $questionData,
                    );

                    if (isset ($item['options'])) {
                        $optionData = collect($item['options'])->all();

                        foreach ($optionData as $option) {
                            $question->options()->updateOrCreate(
                                ['id' => $option['id']],
                                $option,
                            );
                        }
                    }
                }
            }

            $quiz->marks_total = $marks_total;
            $quiz->save();

            return $quiz;
        }, 3);
    }
}
