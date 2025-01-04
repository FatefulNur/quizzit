<?php

namespace Database\Factories;

use App\Models\Form;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Respondent>
 */
class RespondentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->optional()->safeEmail(),
            'tenant_id' => Tenant::factory(),
            'form_id' => Form::factory(),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the respondent is anonymous.
     *
     * @return \Database\Factories\RespondentFactory
     */
    public function anonymous(): static
    {
        return $this->state(fn (array $attributes) => [
            'email' => null,
            'user_id' => null,
        ]);
    }
}
