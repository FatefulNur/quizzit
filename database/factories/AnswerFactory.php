<?php

namespace Database\Factories;

use App\Models\Option;
use App\Models\Tenant;
use App\Models\Question;
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
}
