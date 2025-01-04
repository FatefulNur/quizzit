<?php

namespace Database\Seeders;

use App\Enums\QuestionType;
use App\Models\Answer;
use App\Models\Feedback;
use App\Models\Form;
use App\Models\Option;
use App\Models\Question;
use App\Models\Respondent;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Submission;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Users & Tenant
        extract($this->createTenantAndUsers());

        // Form & Sections
        extract($this->createFormAndSections($tenant));

        // Respondent
        $randomUser = $users->random();
        $respondent = $this->createRespondent($randomUser, $tenant, $form);

        // Questions and data
        $this->createQuestionsWithData($tenant, $form, $settings, $defaultSection, $respondent);
        $this->createQuestionsWithData($tenant, $form, $settings, $otherSection, $respondent);
    }

    private function createTenantAndUsers(): array
    {
        $tenant = Tenant::factory()->create();
        $users = User::factory()->count(5)->create();
        $admin = User::factory()->create([
            'name' => 'KM Nurunnabi',
            'email' => 'km.nurunnabi66@gmail.com',
        ]);

        DB::table('tenant_user')->insert([
            'tenant_id' => $tenant->id,
            'user_id' => $admin->id,
        ]);

        return compact('tenant', 'users', 'admin');
    }

    private function createFormAndSections(Tenant $tenant): array
    {
        $form = Form::factory()->published()->create();
        $settings = Setting::factory()->create([
            'tenant_id' => $tenant->id,
            'form_id' => $form->id,
        ]);

        $defaultSection = Section::factory()->default()->create([
            'tenant_id' => $tenant->id,
            'form_id' => $form->id,
        ]);

        $otherSection = Section::factory()->notDefault()->create([
            'tenant_id' => $tenant->id,
            'form_id' => $form->id,
        ]);

        return compact('form', 'settings', 'defaultSection', 'otherSection');
    }

    private function createRespondent(User $user, Tenant $tenant, Form $form): Respondent
    {
        return Respondent::factory()->create([
            'name' => $user->name,
            'email' => $user->email,
            'tenant_id' => $tenant->id,
            'form_id' => $form->id,
            'user_id' => $user->id,
        ]);
    }

    private function createQuestionsWithData(
        Tenant $tenant,
        Form $form,
        Setting $settings,
        Section $section,
        Respondent $respondent
    ): void {
        $questions = Question::factory()->count(5)->create([
            'tenant_id' => $tenant->id,
            'form_id' => $form->id,
            'section_id' => $section->id,
        ]);

        $this->addQuestionsData($questions, $settings, $respondent);
    }

    private function addQuestionsData($questions, $settings, $respondent): void
    {
        $questions->each(function (Question $question) use ($settings, $respondent) {
            if (in_array($question->type, [QuestionType::MULTIPLE_CHOICE, QuestionType::CHECKBOXES])) {
                $options = Option::factory()->count(4)->create([
                    'tenant_id' => $question->tenant_id,
                    'question_id' => $question->id,
                ]);

                if ($settings->is_quiz) {
                    $correctOptions = $options->random(mt_rand(1, 2));
                    $correctOptions->each(fn (Option $option) => Answer::factory()->noText()->create([
                        'tenant_id' => $question->tenant_id,
                        'question_id' => $question->id,
                        'option_id' => $option->id,
                    ]));
                }

                Submission::factory()->create([
                    'answer' => null,
                    'tenant_id' => $question->tenant_id,
                    'form_id' => $question->form_id,
                    'question_id' => $question->id,
                    'respondent_id' => $respondent->id,
                    'option_id' => $options->random()->id,
                ]);

                Feedback::factory()->correctAnswer()->create([
                    'tenant_id' => $question->tenant_id,
                    'question_id' => $question->id,
                ]);
                Feedback::factory()->incorrectAnswer()->create([
                    'tenant_id' => $question->tenant_id,
                    'question_id' => $question->id,
                ]);

            } else {
                if ($settings->is_quiz) {
                    Answer::factory()->noOption()->create([
                        'tenant_id' => $question->tenant_id,
                        'question_id' => $question->id,
                    ]);
                }

                Submission::factory()->noOption()->create([
                    'tenant_id' => $question->tenant_id,
                    'form_id' => $question->form_id,
                    'question_id' => $question->id,
                    'respondent_id' => $respondent->id,
                ]);

                Feedback::factory()->general()->create([
                    'tenant_id' => $question->tenant_id,
                    'question_id' => $question->id,
                ]);
            }
        });
    }
}
