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
            $userResponse = UserResponse::factory()->create(['quiz_id' => $quiz->id]);

            foreach ($questions as $question) {
                $options = Option::factory(rand(2, 4))->create(['question_id' => $question->id]);
                $chosenOptions = $options->shuffle()->take(rand(1, 2));

                $correctOptionLabels = $options
                    ->where('is_correct', 1)
                    ->map->label->all();

                $correct = implode(', ', $correctOptionLabels);

                foreach ($chosenOptions as $option) {
                    Answer::factory()->create([
                        'correct' => $correct,
                        'user_id' => $userResponse->user_id,
                        'user_response_id' => $userResponse->id,
                        'question_id' => $question->id,
                        'option_id' => $option->id,
                    ]);
                }
            }

        }
    }
}
