<?php

use App\Models\Quiz;
use App\Models\User;
use App\Models\Option;
use Livewire\Livewire;
use App\Models\Question;
use App\Livewire\User\Quizzes\Edit;
use App\Livewire\User\Quizzes\Index;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->quiz = Quiz::factory()->create(['user_id' => $this->user->id]);
    $questions = Question::factory(2)->create(['quiz_id' => $this->quiz->id]);
    foreach ($questions as $question) {
        Option::factory()->create(['question_id' => $question->id]);
    }
});

test('Edit quiz page can be visited', function () {
    $response = $this
        ->actingAs($this->user)
        ->get(route('user.quizzes.edit', $this->quiz->id));

    $response
        ->assertOk()
        ->assertSeeLivewire(Edit::class);

    $this->assertAuthenticated();
});

test('Edit quiz page cannot be visited when unauthenticated', function () {
    $response = $this->get(route('user.quizzes.edit', $this->quiz->id));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});

test('Edit quiz page cannot be visited when unauthorized', function () {
    $this->actingAs(User::factory()->create());

    $response = $this->get(route('user.quizzes.edit', $this->quiz->id));

    $response
        ->assertForbidden();

    $this->assertAuthenticated();
});

test('questions can be added', function () {
    $this->actingAs($this->user);

    $component = Livewire::test(Edit::class, ['quiz' => $this->quiz]);

    // initial questions
    $component->assertSet("questions", [
        [
            ...$this->quiz->questions[0]->only('id', 'title', 'hint', 'marks'),
            'type' => $this->quiz->questions[0]->type->value,
            'options' => [
                [
                    ...$this->quiz->questions[0]->options[0]->only('id', 'is_correct', 'label')
                ],
            ]
        ],
        [
            ...$this->quiz->questions[1]->only('id', 'title', 'hint', 'marks'),
            'type' => $this->quiz->questions[1]->type->value,
            'options' => [
                [
                    ...$this->quiz->questions[1]->options[0]->only('id', 'is_correct', 'label')
                ],
            ]
        ],
    ]);

    $component->call('addQuestion');
    $component->call('addQuestion');

    $component->assertSet('questions', [
        [
            ...$this->quiz->questions[0]->only('id', 'title', 'hint', 'marks'),
            'type' => $this->quiz->questions[0]->type->value,
            'options' => [
                [
                    ...$this->quiz->questions[0]->options[0]->only('id', 'is_correct', 'label')
                ],
            ]
        ],
        [
            ...$this->quiz->questions[1]->only('id', 'title', 'hint', 'marks'),
            'type' => $this->quiz->questions[1]->type->value,
            'options' => [
                [
                    ...$this->quiz->questions[1]->options[0]->only('id', 'is_correct', 'label')
                ],
            ]
        ],
        [
            'id' => '',
            'title' => '',
            'hint' => '',
            'marks' => '',
            'type' => '',
            'options' => [
                [
                    'id' => '',
                    'label' => 'Option 1',
                    'is_correct' => false,
                ]
            ],
        ],
        [
            'id' => '',
            'title' => '',
            'hint' => '',
            'marks' => '',
            'type' => '',
            'options' => [
                [
                    'id' => '',
                    'label' => 'Option 1',
                    'is_correct' => false,
                ]
            ],
        ],
    ]);
});

test('questions can be removed', function () {
    $this->actingAs($this->user);

    $component = Livewire::test(Edit::class, ['quiz' => $this->quiz]);

    $component->assertSet("questions", [
        [
            ...$this->quiz->questions[0]->only('id', 'title', 'hint', 'marks'),
            'type' => $this->quiz->questions[0]->type->value,
            'options' => [
                [
                    ...$this->quiz->questions[0]->options[0]->only('id', 'is_correct', 'label')
                ],
            ]
        ],
        [
            ...$this->quiz->questions[1]->only('id', 'title', 'hint', 'marks'),
            'type' => $this->quiz->questions[1]->type->value,
            'options' => [
                [
                    ...$this->quiz->questions[1]->options[0]->only('id', 'is_correct', 'label')
                ],
            ]
        ],
    ]);

    $component->call('removeQuestion', 0);

    $component->assertSet('questions', [
        1 => [
            ...$this->quiz->questions[1]->only('id', 'title', 'hint', 'marks'),
            'type' => $this->quiz->questions[1]->type->value,
            'options' => [
                [
                    ...$this->quiz->questions[1]->options[0]->only('id', 'is_correct', 'label')
                ],
            ]
        ],
    ]);

    $component->call('addQuestion');
    $component->call('removeQuestion', 1);

    $component->assertSet('questions', [
        2 => [
            'id' => '',
            'title' => '',
            'hint' => '',
            'marks' => '',
            'type' => '',
            'options' => [
                [
                    'id' => '',
                    'label' => 'Option 1',
                    'is_correct' => false,
                ]
            ],
        ],
    ]);
});

test('options can be added', function () {
    $this->actingAs($this->user);

    $component = Livewire::test(Edit::class, ['quiz' => $this->quiz]);

    $component->call('addOption', 0);
    $component->call('addOption', 0);

    $component->assertSet('questions.0.options', [
        [...$this->quiz->questions[0]->options[0]->only('id', 'is_correct', 'label')],
        [
            'id' => '',
            'label' => 'Option 2',
            'is_correct' => false,
        ],
        [
            'id' => '',
            'label' => 'Option 3',
            'is_correct' => false,
        ],
    ]);

    $component->call('addOption', 1);

    $component->assertSet('questions.1.options', [
        [...$this->quiz->questions[1]->options[0]->only('id', 'is_correct', 'label')],
        [
            'id' => '',
            'label' => 'Option 2',
            'is_correct' => false,
        ],
    ]);
});

test('options can be removed', function () {
    $this->actingAs($this->user);

    $component = Livewire::test(Edit::class, ['quiz' => $this->quiz]);

    $component->call('addOption', 0);
    $component->call('addOption', 0);

    $component->assertSet('questions.0.options', [
        [...$this->quiz->questions[0]->options[0]->only('id', 'is_correct', 'label')],
        [
            'id' => '',
            'label' => 'Option 2',
            'is_correct' => false,
        ],
        [
            'id' => '',
            'label' => 'Option 3',
            'is_correct' => false,
        ],
    ]);

    $component->call('removeOption', 0, 1);

    $component->assertSet('questions.0.options', [
        0 => [...$this->quiz->questions[0]->options[0]->only('id', 'is_correct', 'label')],
        2 => [
            'id' => '',
            'label' => 'Option 3',
            'is_correct' => false,
        ],
    ]);
});

test('quiz can be edited without any modification', function () {
    $this->actingAs($this->user);

    $component = Livewire::test(Edit::class, ['quiz' => $this->quiz]);

    // Quiz
    $component
        ->set('title', 'Updated Quiz Title')
        ->set('description', 'Updated Quiz Description.')
        ->set('type', true)
        ->set('started_at', now()->addDay())
        ->set('expired_at', now()->addDays(3));

    // Question 1
    $component
        ->set('questions.0.id', $this->quiz->questions[0]->id)
        ->set('questions.0.title', 'question 1 updated?')
        ->set('questions.0.hint', 'updated short text hint')
        ->set('questions.0.marks', 3)
        ->set('questions.0.type', 'short_text')

        ->set('questions.0.options.0.id', $this->quiz->questions[0]->options[0]->id)
        ->set('questions.0.options.0.is_correct', true)
        ->set('questions.0.options.0.label', 'answer updated');

    // Question 2
    $component
        ->set('questions.1.id', $this->quiz->questions[1]->id)
        ->set('questions.1.title', 'question 2 updated?')
        ->set('questions.1.hint', 'updated long text hint')
        ->set('questions.1.marks', 3)
        ->set('questions.1.type', 'long_text')

        ->set('questions.1.options.0.id', $this->quiz->questions[1]->options[0]->id)
        ->set('questions.1.options.0.is_correct', false)
        ->set('questions.1.options.0.label', 'answer updated 2');

    $component->call('addQuestion');

    // Question 3
    $component
        ->set('questions.2.id', '')
        ->set('questions.2.title', 'add question 3?')
        ->set('questions.2.hint', 'this is add question 3')
        ->set('questions.2.marks', 1)
        ->set('questions.2.type', 'radio')

        ->set('questions.2.options.0.id', '')
        ->set('questions.2.options.0.is_correct', false)
        ->set('questions.2.options.0.label', 'option 1 f')
        ->set('questions.2.options.1.id', '')
        ->set('questions.2.options.1.is_correct', true)
        ->set('questions.2.options.1.label', 'option 2 t')
        ->set('questions.2.options.2.id', '')
        ->set('questions.2.options.2.is_correct', false)
        ->set('questions.2.options.2.label', 'option 3 f');

    $component->call('addQuestion');

    // Question 4
    $component
        ->set('questions.3.id', '')
        ->set('questions.3.title', 'add question 4?')
        ->set('questions.3.hint', 'add checkbox')
        ->set('questions.3.marks', 3)
        ->set('questions.3.type', 'checkbox')

        ->set('questions.3.options.0.id', '')
        ->set('questions.3.options.0.is_correct', false)
        ->set('questions.3.options.0.label', 'option 1 f')
        ->set('questions.3.options.1.id', '')
        ->set('questions.3.options.1.is_correct', true)
        ->set('questions.3.options.1.label', 'option 2 t')
        ->set('questions.3.options.2.id', '')
        ->set('questions.3.options.2.is_correct', true)
        ->set('questions.3.options.2.label', 'option 3 t');

    $component
        ->call('save')
        ->assertOk()
        ->assertHasNoErrors()
        ->assertSessionHas('status', 'Success!')
        ->assertRedirect(route('user.quizzes.edit', $this->quiz->id));

    $this->assertDatabaseCount('quizzes', 1);
    $this->assertDatabaseHas('quizzes', [
        'title' => 'Updated Quiz Title',
        'description' => 'Updated Quiz Description.',
        'type' => 'private',
    ]);
    $this->assertDatabaseCount('questions', 4);
    $this->assertDatabaseHas('questions', [
        'title' => 'question 1 updated?',
        'hint' => 'updated short text hint',
        'marks' => 3,
        'type' => 'short_text',
        'quiz_id' => $this->quiz->id,
    ]);
    $this->assertDatabaseHas('questions', [
        'title' => 'question 2 updated?',
        'hint' => 'updated long text hint',
        'marks' => 3,
        'type' => 'long_text',
        'quiz_id' => $this->quiz->id,
    ]);
    $this->assertDatabaseHas('questions', [
        'title' => 'add question 3?',
        'hint' => 'this is add question 3',
        'marks' => 1,
        'type' => 'radio',
        'quiz_id' => $this->quiz->id,
    ]);
    $this->assertDatabaseHas('questions', [
        'title' => 'add question 4?',
        'hint' => 'add checkbox',
        'marks' => 3,
        'type' => 'checkbox',
        'quiz_id' => $this->quiz->id,
    ]);
    $this->assertDatabaseCount('options', 8);
    $this->assertSame(10, $this->quiz->fresh()->marks_total);
});

test('quiz can be edited with modification of questions', function () {
    $this->actingAs($this->user);

    $component = Livewire::test(Edit::class, ['quiz' => $this->quiz]);

    // Quiz
    $component
        ->set('title', 'Updated Quiz Title')
        ->set('description', 'Updated Quiz Description.')
        ->set('type', true)
        ->set('started_at', now()->addDay())
        ->set('expired_at', now()->addDays(3));

    // Question 1
    $component
        ->set('questions.0.id', $this->quiz->questions[0]->id)
        ->set('questions.0.title', 'question 1 updated?')
        ->set('questions.0.hint', 'updated short text hint')
        ->set('questions.0.marks', 3)
        ->set('questions.0.type', 'short_text')

        ->set('questions.0.options.0.id', $this->quiz->questions[0]->options[0]->id)
        ->set('questions.0.options.0.is_correct', true)
        ->set('questions.0.options.0.label', 'answer updated');

    // Question 2
    $component
        ->set('questions.1.id', $this->quiz->questions[1]->id)
        ->set('questions.1.title', 'question 2 updated?')
        ->set('questions.1.hint', 'updated long text hint')
        ->set('questions.1.marks', 3)
        ->set('questions.1.type', 'long_text')

        ->set('questions.1.options.0.id', $this->quiz->questions[1]->options[0]->id)
        ->set('questions.1.options.0.is_correct', false)
        ->set('questions.1.options.0.label', 'answer updated 2');

    $component->call('addQuestion');

    // Question 3
    $component
        ->set('questions.2.id', '')
        ->set('questions.2.title', 'add question 3?')
        ->set('questions.2.hint', 'this is add question 3')
        ->set('questions.2.marks', 1)
        ->set('questions.2.type', 'radio')

        ->set('questions.2.options.0.id', '')
        ->set('questions.2.options.0.is_correct', false)
        ->set('questions.2.options.0.label', 'option 1 f')
        ->set('questions.2.options.1.id', '')
        ->set('questions.2.options.1.is_correct', true)
        ->set('questions.2.options.1.label', 'option 2 t')
        ->set('questions.2.options.2.id', '')
        ->set('questions.2.options.2.is_correct', false)
        ->set('questions.2.options.2.label', 'option 3 f');

    $component->call('addQuestion');

    // Question 4
    $component
        ->set('questions.3.id', '')
        ->set('questions.3.title', 'add question 4?')
        ->set('questions.3.hint', 'add checkbox')
        ->set('questions.3.marks', 2)
        ->set('questions.3.type', 'checkbox')

        ->set('questions.3.options.0.id', '')
        ->set('questions.3.options.0.is_correct', false)
        ->set('questions.3.options.0.label', 'option 1 f')
        ->set('questions.3.options.1.id', '')
        ->set('questions.3.options.1.is_correct', true)
        ->set('questions.3.options.1.label', 'option 2 t')
        ->set('questions.3.options.2.id', '')
        ->set('questions.3.options.2.is_correct', true)
        ->set('questions.3.options.2.label', 'option 3 t');


    // Modify question
    $component->call('removeQuestion', 1);
    $component->call('removeQuestion', 2);

    $component
        ->call('save')
        ->assertOk()
        ->assertHasNoErrors()
        ->assertSessionHas('status', 'Success!')
        ->assertRedirect(route('user.quizzes.edit', $this->quiz->id));

    $this->assertDatabaseCount('quizzes', 1);
    $this->assertDatabaseHas('quizzes', [
        'title' => 'Updated Quiz Title',
        'description' => 'Updated Quiz Description.',
        'type' => 'private',
    ]);
    $this->assertDatabaseCount('questions', 2);
    $this->assertDatabaseHas('questions', [
        'title' => 'question 1 updated?',
        'hint' => 'updated short text hint',
        'marks' => 3,
        'type' => 'short_text',
        'quiz_id' => $this->quiz->id,
    ]);
    $this->assertDatabaseHas('questions', [
        'title' => 'add question 4?',
        'hint' => 'add checkbox',
        'marks' => 2,
        'type' => 'checkbox',
        'quiz_id' => $this->quiz->id,
    ]);
    $this->assertDatabaseCount('options', 4);
    $this->assertSame(5, $this->quiz->fresh()->marks_total);
});

test('quiz can be edited with modification of options', function () {
    $this->actingAs($this->user);

    $component = Livewire::test(Edit::class, ['quiz' => $this->quiz]);

    // Quiz
    $component
        ->set('title', 'Updated Quiz Title')
        ->set('description', 'Updated Quiz Description.')
        ->set('type', true)
        ->set('started_at', now()->addDay())
        ->set('expired_at', now()->addDays(3));

    // Question 1
    $component
        ->set('questions.0.id', $this->quiz->questions[0]->id)
        ->set('questions.0.title', 'question 1 updated?')
        ->set('questions.0.hint', 'updated short text hint')
        ->set('questions.0.marks', 3)
        ->set('questions.0.type', 'short_text')

        ->set('questions.0.options.0.id', $this->quiz->questions[0]->options[0]->id)
        ->set('questions.0.options.0.is_correct', true)
        ->set('questions.0.options.0.label', 'answer updated');

    // Question 2
    $component
        ->set('questions.1.id', $this->quiz->questions[1]->id)
        ->set('questions.1.title', 'question 2 updated?')
        ->set('questions.1.hint', 'updated long text hint')
        ->set('questions.1.marks', 3)
        ->set('questions.1.type', 'long_text')

        ->set('questions.1.options.0.id', $this->quiz->questions[1]->options[0]->id)
        ->set('questions.1.options.0.is_correct', false)
        ->set('questions.1.options.0.label', 'answer updated 2');

    $component->call('addQuestion');

    // Question 3
    $component
        ->set('questions.2.id', '')
        ->set('questions.2.title', 'add question 3?')
        ->set('questions.2.hint', 'this is add question 3')
        ->set('questions.2.marks', 1)
        ->set('questions.2.type', 'radio')

        ->set('questions.2.options.0.id', '')
        ->set('questions.2.options.0.is_correct', false)
        ->set('questions.2.options.0.label', 'option 1 f')
        ->set('questions.2.options.1.id', '')
        ->set('questions.2.options.1.is_correct', true)
        ->set('questions.2.options.1.label', 'option 2 t')
        ->set('questions.2.options.2.id', '')
        ->set('questions.2.options.2.is_correct', false)
        ->set('questions.2.options.2.label', 'option 3 f');

    $component->call('addQuestion');

    // Question 4
    $component
        ->set('questions.3.id', '')
        ->set('questions.3.title', 'add question 4?')
        ->set('questions.3.hint', 'add checkbox')
        ->set('questions.3.marks', 2)
        ->set('questions.3.type', 'checkbox')

        ->set('questions.3.options.0.id', '')
        ->set('questions.3.options.0.is_correct', false)
        ->set('questions.3.options.0.label', 'option 1 f')
        ->set('questions.3.options.1.id', '')
        ->set('questions.3.options.1.is_correct', true)
        ->set('questions.3.options.1.label', 'option 2 t')
        ->set('questions.3.options.2.id', '')
        ->set('questions.3.options.2.is_correct', true)
        ->set('questions.3.options.2.label', 'option 3 t');


    // Modify options
    $component->call('removeOption', 1, 0);
    $component->call('removeOption', 2, 2);

    $component
        ->call('save')
        ->assertOk()
        ->assertHasNoErrors()
        ->assertSessionHas('status', 'Success!')
        ->assertRedirect(route('user.quizzes.edit', $this->quiz->id));

    $this->assertDatabaseCount('quizzes', 1);
    $this->assertDatabaseCount('questions', 4);
    $this->assertDatabaseCount('options', 6);
    $this->assertSame(9, $this->quiz->fresh()->marks_total);
});

test('Options destroyed from database when switch question type', function () {
    $this->actingAs($this->user);
    $question = Question::factory()->create([
        'quiz_id' => $this->quiz->id,
        'type' => 'radio',
    ]);
    Option::factory(3)->create(['question_id' => $question->id]);

    $component = Livewire::test(Edit::class, ['quiz' => $this->quiz]);

    $component
        ->set('questions.2.id', $question->id)
        ->set('questions.2.title', 'question updated?')
        ->set('questions.2.hint', 'updated radio hint')
        ->set('questions.2.marks', 3)
        ->set('questions.2.type', 'checkbox');

    // calling when changing question type
    $component->call('resetOptions', 2);

    $component
        ->set('questions.2.options.0.id', '')
        ->set('questions.2.options.0.is_correct', false)
        ->set('questions.2.options.0.label', 'answer 1')
        ->set('questions.2.options.1.id', '')
        ->set('questions.2.options.1.is_correct', false)
        ->set('questions.2.options.1.label', 'answer 2')
        ->set('questions.2.options.2.id', '')
        ->set('questions.2.options.2.is_correct', false)
        ->set('questions.2.options.2.label', 'answer 3');

    $component
        ->call('save')
        ->assertOk()
        ->assertHasNoErrors()
        ->assertSessionHas('status', 'Success!')
        ->assertRedirect(route('user.quizzes.edit', $this->quiz->id));

    $this->assertDatabaseCount('quizzes', 1);
    $this->assertDatabaseCount('questions', 3);
    $this->assertDatabaseCount('options', 5); // options still 5 instead of 8
});

test('quiz cannot be updated with invalid inputs', function ($title, $description, $type, $started_at, $expired_at, $question_title, $question_hint, $question_marks, $question_type, $errors) {
    $this->actingAs($this->user);

    $component = Livewire::test(Edit::class, ['quiz' => $this->quiz]);

    // Quiz
    $component
        ->set('title', $title)
        ->set('description', $description)
        ->set('type', $type)
        ->set('started_at', $started_at)
        ->set('expired_at', $expired_at);

    // Question 1
    $component
        ->set('questions.0.title', $question_title)
        ->set('questions.0.hint', $question_hint)
        ->set('questions.0.marks', $question_marks)
        ->set('questions.0.type', $question_type)

        ->set('questions.0.options.0.is_correct', true)
        ->set('questions.0.options.0.label', 'yes')
        ->set('questions.0.options.1.is_correct', false)
        ->set('questions.0.options.1.label', 'no');

    $component->call('save');

    $component->assertHasErrors($errors);
})->with('quiz_validation');
