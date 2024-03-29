<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Option;
use App\Models\Question;
use App\Models\UserResponse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'correct' => fake()->word(),
            'answer' => fake()->word(),
            'user_id' => User::factory(),
            'user_response_id' => UserResponse::factory(),
            'question_id' => Question::factory(),
            'option_id' => Option::factory(),
        ];
    }
}
