<?php

use App\Models\Quiz;
use App\Models\User;
use App\Models\Option;
use App\Models\UserResponse;
use Livewire\Livewire;
use App\Models\Question;
use App\Livewire\User\Quizzes\Show;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->quiz = Quiz::factory()->public()->create(['user_id' => $this->user->id]);
    $this->shortTextQuestion = Question::factory()->shortText()->create(['quiz_id' => $this->quiz->id]);
    $this->longTextQuestion = Question::factory()->longText()->create(['quiz_id' => $this->quiz->id]);
    $this->radioQuestion = Question::factory()->radio()->create(['quiz_id' => $this->quiz->id]);
    $this->checkboxQuestion = Question::factory()->checkbox()->create(['quiz_id' => $this->quiz->id]);

    Option::factory()->create(['question_id' => $this->shortTextQuestion->id]);
    Option::factory()->create(['question_id' => $this->longTextQuestion->id]);
    Option::factory(3)->create(['question_id' => $this->radioQuestion->id]);
    Option::factory(3)->create(['question_id' => $this->checkboxQuestion->id]);
});

test('single quiz page can be visited', function () {
    $response = $this
        ->actingAs($this->user)
        ->get(route('user.quizzes.show', $this->quiz->id));

    $response
        ->assertOk()
        ->assertSeeLivewire(Show::class);

    $this->assertAuthenticated();
});

test('single quiz page can be visited when unauthenticated', function () {
    $response = $this->get(route('user.quizzes.show', $this->quiz->id));

    $response
        ->assertOk()
        ->assertSeeLivewire(Show::class);

    $this->assertGuest();
});

test('user need to authenticate to participate private quiz', function () {
    $quiz = Quiz::factory()->private()->create();

    $response = $this->get(route('user.quizzes.show', $quiz->id));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('notify.quizzes.show');

    $this->assertGuest();
});

test('quiz can be participated', function () {
    $this->actingAs($this->user);

    $component = Livewire::test(Show::class, ['quiz' => $this->quiz]);

    $component
        ->set('answers.0.answer.0', 'A short text answer')
        ->set('answers.0.option_id.0', $this->shortTextQuestion->options[0]->id)
        ->set('answers.0.question_id', $this->shortTextQuestion->id);

    $component
        ->set('answers.1.answer.0', 'A Long text answer')
        ->set('answers.1.option_id.0', $this->longTextQuestion->options[0]->id)
        ->set('answers.1.question_id', $this->longTextQuestion->id);

    $component
        ->set('answers.2.answer.0', $this->radioQuestion->options[1]->label)
        ->set('answers.2.option_id.0', $this->radioQuestion->options[1]->id)
        ->set('answers.2.question_id', $this->radioQuestion->id);

    $component
        ->set('answers.3.answer.0', $this->checkboxQuestion->options[1]->label)
        ->set('answers.3.answer.1', $this->checkboxQuestion->options[2]->label)
        ->set('answers.3.option_id.0', $this->checkboxQuestion->options[1]->id)
        ->set('answers.3.option_id.1', $this->checkboxQuestion->options[2]->id)
        ->set('answers.3.question_id', $this->checkboxQuestion->id);

    $component->call('save')
        ->assertOk()
        ->assertHasNoErrors()
        ->assertSessionHas('status', 'Success!')
        ->assertRedirect(route('notify.responses.show', UserResponse::first()->id));

    $this->assertDatabaseCount('quizzes', 1);
    $this->assertDatabaseCount('questions', 4);
    $this->assertDatabaseCount('options', 8);
    $this->assertDatabaseCount('user_responses', 1);
    $this->assertDatabaseCount('answers', 5);
});

test('result can be generate from the quiz response', function () {
    $quiz = Quiz::factory()->public()->create();

    $shortTextQuestion = Question::factory()->shortText()->create(['quiz_id' => $quiz->id]);
    $longTextQuestion = Question::factory()->longText()->create(['quiz_id' => $quiz->id]);
    $radioQuestion = Question::factory()->radio()->create(['quiz_id' => $quiz->id]);
    $checkboxQuestion = Question::factory()->checkbox()->create(['quiz_id' => $quiz->id]);

    $shortTextOption = Option::factory()->correct()->create(['question_id' => $shortTextQuestion->id]);
    $longTextOption = Option::factory()->correct()->create(['question_id' => $longTextQuestion->id]);
    $radioOption1 = Option::factory()->correct()->create(['question_id' => $radioQuestion->id]);
    $radioOption2 = Option::factory()->incorrect()->create(['question_id' => $radioQuestion->id]);
    $checkboxOption1 = Option::factory()->correct()->create(['question_id' => $checkboxQuestion->id]);
    $checkboxOption2 = Option::factory()->incorrect()->create(['question_id' => $checkboxQuestion->id]);
    $checkboxOption3 = Option::factory()->correct()->create(['question_id' => $checkboxQuestion->id]);

    $component = Livewire::test(Show::class, ['quiz' => $quiz]);

    $component
        ->set('answers.0.answer.0', $shortTextOption->label)
        ->set('answers.0.option_id.0', $shortTextOption->id)
        ->set('answers.0.question_id', $shortTextQuestion->id);

    $component
        ->set('answers.1.answer.0', 'wrong answer')
        ->set('answers.1.option_id.0', $longTextOption->id)
        ->set('answers.1.question_id', $longTextQuestion->id);

    $component
        ->set('answers.2.answer.0', $radioOption1->label)
        ->set('answers.2.option_id.0', $radioOption1->id)
        ->set('answers.2.question_id', $radioQuestion->id);

    $component
        ->set('answers.3.answer.0', $checkboxOption1->label)
        ->set('answers.3.answer.1', $checkboxOption3->label)
        ->set('answers.3.option_id.0', $checkboxOption1->id)
        ->set('answers.3.option_id.1', $checkboxOption3->id)
        ->set('answers.3.question_id', $checkboxQuestion->id);

    $component->call('save');

    $this->assertDatabaseCount('user_responses', 1);
    $this->assertSame(4, UserResponse::first()->result);
});

test('quiz answers inputs cannot be null', function () {
    $this->actingAs($this->user);

    $component = Livewire::test(Show::class, ['quiz' => $this->quiz]);

    $component
        ->set('answers.0.answer', '')
        ->set('answers.0.option_id', '')
        ->set('answers.0.question_id', '');

    $component
        ->set('answers.1.answer', '')
        ->set('answers.1.option_id', '')
        ->set('answers.1.question_id', '');

    $component
        ->set('answers.2.answer', '')
        ->set('answers.2.option_id', '')
        ->set('answers.2.question_id', '');

    $component
        ->set('answers.3.answer', '')
        ->set('answers.3.answer', '')
        ->set('answers.3.option_id', '')
        ->set('answers.3.option_id', '')
        ->set('answers.3.question_id', '');

    $component->call('save')
        ->assertHasErrors([
            "answers.0.answer",
            "answers.1.answer",
            "answers.2.answer",
            "answers.3.answer",
            "answers.0.option_id",
            "answers.1.option_id",
            "answers.2.option_id",
            "answers.3.option_id",
            "answers.0.question_id",
            "answers.1.question_id",
            "answers.2.question_id",
            "answers.3.question_id"
        ]);
});
