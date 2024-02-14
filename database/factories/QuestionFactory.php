<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\Question;
use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'hint' => fake()->sentence(),
            'marks' => fake()->numberBetween(1, 5),
            'type' => fake()->randomElement(QuestionType::class),
            'quiz_id' => Quiz::factory(),
        ];
    }
}
