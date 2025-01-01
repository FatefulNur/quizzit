<?php

namespace Database\Factories;

use App\Models\Form;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'confirmation_message' => fake()->sentence(),
            'tenant_id' => Tenant::factory(),
            'form_id' => Form::factory(),
            'allow_submissions' => fake()->boolean(),
            'enable_autosave_responses' => fake()->boolean(),
            'shuffle_questions' => fake()->boolean(),
            'enable_single_submission' => fake()->boolean(),
            'allow_submission_edits' => fake()->boolean(),
            'is_quiz' => fake()->boolean(),
        ];
    }
}
