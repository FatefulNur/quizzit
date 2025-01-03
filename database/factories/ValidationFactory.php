<?php

namespace Database\Factories;

use App\Enums\ValidationRule;
use App\Models\Question;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionValidation>
 */
class ValidationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rule = fake()->randomElement(ValidationRule::class);
        return [
            'rule' => $rule->value,
            'tenant_id' => Tenant::factory(),
            'question_id' => Question::factory(),
            'parameters' => $this->fakeParameters($rule),
            'error_message' => fake()->sentence(),
        ];
    }

    /**
     * @param ValidationRule $rule
     * @return array<string, mixed>|null
     */
    private function fakeParameters(ValidationRule $rule): ?array
    {
        return match ($rule) {
            ValidationRule::GREATER_THAN,
            ValidationRule::GREATER_THAN_OR_EQUAL_TO,
            ValidationRule::LESS_THAN,
            ValidationRule::LESS_THAN_OR_EQUAL_TO,
            ValidationRule::EQUAL_TO,
            ValidationRule::NOT_EQUAL_TO => [
                'value' => fake()->numberBetween(1, 100),
            ],

            ValidationRule::BETWEEN,
            ValidationRule::NOT_BETWEEN => [
                'min' => fake()->numberBetween(1, 50),
                'max' => fake()->numberBetween(51, 100),
            ],

            ValidationRule::CONTAINS,
            ValidationRule::DOES_NOT_CONTAIN => [
                'substring' => fake()->word(),
            ],

            ValidationRule::REGEX_CONTAINS,
            ValidationRule::REGEX_DOES_NOT_CONTAIN,
            ValidationRule::REGEX_MATCHES,
            ValidationRule::REGEX_DOES_NOT_MATCH => [
                'pattern' => fake()->regexify('[a-zA-Z0-9]{10}'),
            ],

            ValidationRule::MAX_CHARACTERS => [
                'max' => fake()->numberBetween(1, 255),
            ],
            ValidationRule::MIN_CHARACTERS => [
                'min' => fake()->numberBetween(10, 255),
            ],

            ValidationRule::SELECT_AT_LEAST => [
                'min' => fake()->numberBetween(1, 5),
            ],
            ValidationRule::SELECT_AT_MOST => [
                'max' => fake()->numberBetween(2, 10),
            ],
            ValidationRule::SELECT_EXACTLY => [
                'exact' => fake()->numberBetween(1, 10),
            ],

            default => null,
        };
    }
}
