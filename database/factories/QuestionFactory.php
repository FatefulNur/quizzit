<?php

namespace Database\Factories;

use App\Models\Quiz;
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

    public function shortText(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => QuestionType::SHORT_TEXT->value,
            'marks' => 2
        ]);
    }

    public function longText(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => QuestionType::LONG_TEXT->value,
            'marks' => 2,
        ]);
    }

    public function radio(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => QuestionType::RADIO->value,
            'marks' => 1,
        ]);
    }

    public function checkbox(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => QuestionType::CHECKBOX->value,
            'marks' => 1,
        ]);
    }
}
