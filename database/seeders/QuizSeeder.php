<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Option;
use App\Models\Question;
use App\Models\UserResponse;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizzes = Quiz::factory(5)->create();

        foreach ($quizzes as $quiz) {
            $questions = Question::factory(5)->create(['quiz_id' => $quiz->id]);

            foreach ($questions as $question) {
                if ($question->isRadio() || $question->isCheckbox()) {
                    // Short / Long text don't need an option
                    $options = Option::factory(rand(2, 4))->create(['question_id' => $question->id]);
                    $randomOptions = $options->shuffle()->take(rand(1, 2));

                    foreach ($randomOptions as $option) {
                        Answer::factory()->create([
                            'correct' => $option->label,
                            'question_id' => $question->id,
                            'option_id' => $option->id,
                        ]);
                    }
                } else {
                    Answer::factory()->create([
                        'question_id' => $question->id,
                    ]);
                }
            }

            UserResponse::factory(rand(1, 3))->create(['quiz_id' => $quiz->id]);
        }
    }
}
