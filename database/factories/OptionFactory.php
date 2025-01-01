<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => fake()->sentence(),
            'tenant_id' => Tenant::factory(),
            'question_id' => Question::factory(),
            'order_index' => fake()->numberBetween(0, 100),
        ];
    }
}
