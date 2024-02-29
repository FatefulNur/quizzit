<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identity' => fake()->randomNumber(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'city' => fake()->city(),
            'region' => fake()->state(),
            'country' => fake()->countryCode(),
        ];
    }
}
