<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserResponse>
 */
class UserResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'result' => fake()->numberBetween(0, 100),
            'user_id' => User::factory(),
            'quiz_id' => Quiz::factory(),
        ];
    }
}
