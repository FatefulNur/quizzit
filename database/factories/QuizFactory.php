<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\User;
use App\Enums\QuizType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
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
            'description' => fake()->paragraph(3),
            'marks_total' => fake()->numberBetween(1, 25),
            'type' => fake()->randomElement(QuizType::class),
            'user_id' => User::factory(),
            'started_at' => now()->addDays(fake()->numberBetween(1, 6)),
            'expired_at' => now()->addDays(fake()->numberBetween(6, 12)),
        ];
    }
}
