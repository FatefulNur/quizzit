<?php

namespace Database\Factories;

use App\Enums\FeedbackType;
use App\Models\Question;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message' => fake()->sentence(),
            'type' => fake()->randomElement(FeedbackType::class),
            'tenant_id' => Tenant::factory(),
            'question_id' => Question::factory(),
        ];
    }

    /**
     * Indicate that the feedback is general.
     */
    public function general(): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => FeedbackType::GENERAL->value,
        ]);
    }

    /**
     * Indicate that the feedback is correct answer.
     */
    public function correctAnswer(): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => FeedbackType::CORRECT_ANSWER->value,
        ]);
    }

    /**
     * Indicate that the feedback is incorrect answer.
     */
    public function incorrectAnswer(): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => FeedbackType::INCORRECT_ANSWER->value,
        ]);
    }
}
