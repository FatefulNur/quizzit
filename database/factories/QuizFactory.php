<?php

namespace Database\Factories;

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
            'timer' => fake()->numberBetween(2, 5),
            'user_id' => User::factory(),
            'started_at' => fake()->dateTimeBetween('-3 days', '3 days'),
            'expired_at' => fake()->dateTimeBetween('4 days', '12 days'),
        ];
    }

    public function public(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => QuizType::PUBLIC ->value,
        ]);
    }

    public function private(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => QuizType::PRIVATE ->value,
        ]);
    }
}
