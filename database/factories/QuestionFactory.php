<?php

namespace Database\Factories;

use App\Enums\QuestionType;
use App\Models\Form;
use App\Models\Section;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
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
            'hint' => fake()->optional()->sentence(),
            'description' => fake()->optional()->paragraph(),
            'type' => fake()->randomElement(QuestionType::class),
            'tenant_id' => Tenant::factory(),
            'form_id' => Form::factory(),
            'section_id' => Section::factory(),
            'is_required' => fake()->boolean(),
            'shuffle_options' => fake()->boolean(),
            'order_index' => fake()->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the question is a multiple choice question.
     *
     * @return \Database\Factories\QuestionFactory
     */
    public function multipleChoice(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => QuestionType::MULTIPLE_CHOICE->value,
        ]);
    }

    /**
     * Indicate that the question is a short answer question.
     *
     * @return \Database\Factories\QuestionFactory
     */
    public function shortAnswer(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => QuestionType::SHORT_ANSWER->value,
        ]);
    }

    /**
     * Indicate that the question is a paragraph question.
     *
     * @return \Database\Factories\QuestionFactory
     */
    public function paragraph(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => QuestionType::PARAGRAPH->value,
        ]);
    }

    /**
     * Indicate that the question is a checkboxes question.
     *
     * @return \Database\Factories\QuestionFactory
     */
    public function checkboxes(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => QuestionType::CHECKBOXES->value,
        ]);
    }
}
