<?php

namespace Database\Factories;

use App\Models\Form;
use App\Models\Tenant;
use App\Models\Question;
use App\Models\Respondent;
use App\Enums\SubmissionStatus;
use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'answer' => fake()->text(),
            'status' => fake()->randomElement(SubmissionStatus::class),
            'tenant_id' => Tenant::factory(),
            'form_id' => Form::factory(),   
            'question_id' => Question::factory(),
            'respondent_id' => Respondent::factory(),
            'option_id' => Option::factory(),
            'is_correct' => fake()->boolean(),
            'score' => fake()->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the submission's status is draft.
     *
     * @return \Database\Factories\SubmissionFactory
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => SubmissionStatus::Draft->value,
        ]);
    }

    /**
     * Indicate that the submission's status is submitted.
     *
     * @return \Database\Factories\SubmissionFactory
     */
    public function submitted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => SubmissionStatus::Submitted->value,
        ]);
    }
}
