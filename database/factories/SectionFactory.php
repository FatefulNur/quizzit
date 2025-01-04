<?php

namespace Database\Factories;

use App\Models\Form;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
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
            'description' => fake()->optional()->paragraph(),
            'tenant_id' => Tenant::factory(),
            'form_id' => Form::factory(),
            'is_default' => fake()->boolean(),
            'order_index' => fake()->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the section is default.
     */
    public function default(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_default' => true,
        ]);
    }

    /**
     * Indicate that the section is not default.
     */
    public function notDefault(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_default' => false,
        ]);
    }
}
