<?php

namespace Database\Factories;

use App\Enums\FormStatus;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(FormStatus::class),
            'tenant_id' => Tenant::factory(),
            'user_id' => User::factory(),
            'started_at' => fake()->optional()->dateTime(),
            'expired_at' => fake()->optional()->dateTime(),
        ];
    }

    /**
     * Indicate that the form is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => FormStatus::PUBLISHED->value,
        ]);
    }

    /**
     * Indicate that the form is draft.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => FormStatus::DRAFT->value,
        ]);
    }

    /**
     * Indicate that the form is private.
     */
    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => FormStatus::PRIVATE->value,
        ]);
    }

    /**
     * Indicate that the form is scheduled.
     */
    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => FormStatus::SCHEDULED->value,
        ]);
    }

    /**
     * Indicate that the form is expired.
     */
    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => FormStatus::EXPIRED->value,
        ]);
    }
}
