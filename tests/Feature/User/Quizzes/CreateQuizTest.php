<?php

use App\Livewire\User\Quizzes\CreateQuiz;
use App\Livewire\User\Quizzes\Index;
use App\Models\Quiz;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;

test('user can see create quiz page', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get(route('user.quizzes.create'));

    $response
        ->assertOk()
        ->assertSeeLivewire(CreateQuiz::class);

    $this->assertAuthenticated();
});

test('user cannot see create quiz page when unauthenticated', function () {
    $response = $this->get(route('user.quizzes.create'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});

test('user can create quiz', function () {
    /** @var TestCase $this */
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(CreateQuiz::class);

    $component
        ->set('title', 'New Quiz')
        ->set('description', 'new quiz description.')
        ->set('expired_at', now()->addDays(3));

    $component
        ->set('questions.0.title', 'question 1?')
        ->set('questions.0.description', 'short text')
        ->set('questions.0.marks', 2)
        ->set('questions.0.type', 'short_text')

        ->set('questions.0.options.0.is_correct', 1)
        ->set('questions.0.options.0.label', 'answer');

    $component->call('addQuestion');

    $component
        ->set('questions.1.title', 'question 2?')
        ->set('questions.1.description', 'long text')
        ->set('questions.1.marks', 5)
        ->set('questions.1.type', 'long_text')

        ->set('questions.1.options.0.is_correct', 1)
        ->set('questions.1.options.0.label', 'answer');

    $component->call('addQuestion');

    $component
        ->set('questions.2.title', 'question 3?')
        ->set('questions.2.hint', 'this is question 3')
        ->set('questions.2.description', 'radio')
        ->set('questions.2.marks', 1)
        ->set('questions.2.type', 'radio')

        ->set('questions.2.options.0.is_correct', 0)
        ->set('questions.2.options.0.label', 'option 1 f')
        ->set('questions.2.options.1.is_correct', 1)
        ->set('questions.2.options.1.label', 'option 2 t')
        ->set('questions.2.options.2.is_correct', 0)
        ->set('questions.2.options.2.label', 'option 3 f');

    $component->call('addQuestion');

    $component
        ->set('questions.3.title', 'question 4?')
        ->set('questions.3.description', 'checkbox')
        ->set('questions.3.marks', 3)
        ->set('questions.3.type', 'checkbox')

        ->set('questions.3.options.0.is_correct', 0)
        ->set('questions.3.options.0.label', 'option 1 f')
        ->set('questions.3.options.1.is_correct', 1)
        ->set('questions.3.options.1.label', 'option 2 t')
        ->set('questions.3.options.2.is_correct', 1)
        ->set('questions.3.options.2.label', 'option 3 t');

    $component
        ->call('save')
        ->assertOk()
        ->assertHasNoErrors()
        ->assertSessionHas('status', 'Success!')
        ->assertRedirect(Index::class);

    $this->assertDatabaseCount('quizzes', 1);
    $this->assertDatabaseCount('questions', 4);
    $this->assertDatabaseCount('options', 8);
    $this->assertSame(11, Quiz::first()->marks_total);
});
