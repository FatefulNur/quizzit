<?php

namespace Database\Factories;

use App\Enums\TenantStatus;
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
            'name' => fake()->company(),
            'path' => fake()->unique()->slug(),
            'description' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(TenantStatus::class),
        ];
    }

    /**
     * Indicate that the tenant is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TenantStatus::ACTIVE->value,
        ]);
    }

    /**
     * Indicate that the tenant is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TenantStatus::INACTIVE->value,
        ]);
    }

    /**
     * Indicate that the tenant is banned.
     */ 
    public function banned(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TenantStatus::BANNED->value,
        ]);
    }
}
