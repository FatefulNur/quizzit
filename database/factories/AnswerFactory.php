<?php

namespace Database\Factories;

use App\Models\Option;
use App\Models\Question;
use App\Models\Tenant;
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
            'text' => fake()->sentence(),
            'tenant_id' => Tenant::factory(),
            'question_id' => Question::factory(),
            'option_id' => Option::factory(),
            'mark_others_incorrect' => fake()->boolean(30),
            'points' => fake()->numberBetween(0, 10),
        ];
    }

    /**
     * Indicate that the answer has no option.
     *
     * @return \Database\Factories\AnswerFactory
     */
    public function noOption(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'option_id' => null,
            ];
        });
    }

    /**
     * Indicate that the answer has no text.
     *
     * @return \Database\Factories\AnswerFactory
     */
    public function noText(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'text' => null,
            ];
        });
    }
}
