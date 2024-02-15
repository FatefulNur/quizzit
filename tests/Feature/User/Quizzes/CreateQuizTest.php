<?php

use App\Livewire\User\Quizzes\CreateQuiz;
use App\Livewire\User\Quizzes\Index;
use App\Models\Quiz;
use Livewire\Livewire;
use App\Models\User;

test('create quiz page can be visited', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get(route('user.quizzes.create'));

    $response
        ->assertOk()
        ->assertSeeLivewire(CreateQuiz::class);

    $this->assertAuthenticated();
});

test('create quiz page cannot be visited when unauthenticated', function () {
    $response = $this->get(route('user.quizzes.create'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});

test('questions can be added', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(CreateQuiz::class);

    // initial question
    $component->assertSet('questions', [
        [
            'title' => '',
            'hint' => '',
            'marks' => '',
            'type' => '',
            'options' => [
                [
                    'label' => 'Option 1',
                    'is_correct' => 0,
                ]
            ],
        ],
    ]);

    $component->call('addQuestion');

    $component->assertSet('questions', [
        [
            'title' => '',
            'hint' => '',
            'marks' => '',
            'type' => '',
            'options' => [
                [
                    'label' => 'Option 1',
                    'is_correct' => 0,
                ]
            ],
        ],
        [
            'title' => '',
            'hint' => '',
            'marks' => '',
            'type' => '',
            'options' => [
                [
                    'label' => 'Option 1',
                    'is_correct' => 0,
                ]
            ],
        ],
    ]);
});

test('questions can be removed', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(CreateQuiz::class)
        ->set('questions', [
            [
                'title' => 'question 1?',
                'hint' => 'first question',
                'marks' => '',
                'type' => '',
                'options' => [
                    [
                        'label' => 'Option 1',
                        'is_correct' => 0,
                    ]
                ],
            ],
            [
                'title' => 'question 2?',
                'hint' => 'second question',
                'marks' => '',
                'type' => '',
                'options' => [
                    [
                        'label' => 'Option 1',
                        'is_correct' => 0,
                    ]
                ],
            ],
        ]);

    $component->call('removeQuestion', 1);

    $component->assertSet('questions', [
        [
            'title' => 'question 1?',
            'hint' => 'first question',
            'marks' => '',
            'type' => '',
            'options' => [
                [
                    'label' => 'Option 1',
                    'is_correct' => 0,
                ]
            ],
        ],
    ]);
});

test('options can be added', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(CreateQuiz::class);

    $component->call('addOption', 0);
    $component->call('addOption', 0);

    $component->assertSet('questions.0.options', [
        [
            'label' => 'Option 1',
            'is_correct' => 0,
        ],
        [
            'label' => 'Option 2',
            'is_correct' => 0,
        ],
        [
            'label' => 'Option 3',
            'is_correct' => 0,
        ],
    ]);
});

test('options can be removed', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(CreateQuiz::class);

    $component->call('addOption', 0);
    $component->call('addOption', 0);

    $component->assertSet('questions.0.options', [
        [
            'label' => 'Option 1',
            'is_correct' => 0,
        ],
        [
            'label' => 'Option 2',
            'is_correct' => 0,
        ],
        [
            'label' => 'Option 3',
            'is_correct' => 0,
        ],
    ]);

    $component->call('removeOption', 0, 1);

    $component->assertSet('questions.0.options', [
        0 => [
            'label' => 'Option 1',
            'is_correct' => 0,
        ],
        2 => [
            'label' => 'Option 3',
            'is_correct' => 0,
        ],
    ]);
});

test('quiz can be created', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(CreateQuiz::class);

    // Quiz
    $component
        ->set('title', 'New Quiz')
        ->set('description', 'new quiz description.')
        ->set('type', false)
        ->set('started_at', now()->addDay())
        ->set('expired_at', now()->addDays(3));

    // Question 1
    $component
        ->set('questions.0.title', 'question 1?')
        ->set('questions.0.hint', 'short text')
        ->set('questions.0.marks', 2)
        ->set('questions.0.type', 'short_text')

        ->set('questions.0.options.0.is_correct', 1)
        ->set('questions.0.options.0.label', 'answer');

    $component->call('addQuestion');

    // Question 2
    $component
        ->set('questions.1.title', 'question 2?')
        ->set('questions.1.hint', 'long text')
        ->set('questions.1.marks', 5)
        ->set('questions.1.type', 'long_text')

        ->set('questions.1.options.0.is_correct', 1)
        ->set('questions.1.options.0.label', 'answer');

    $component->call('addQuestion');

    // Question 3
    $component
        ->set('questions.2.title', 'question 3?')
        ->set('questions.2.hint', 'this is question 3')
        ->set('questions.2.hint', 'radio')
        ->set('questions.2.marks', 1)
        ->set('questions.2.type', 'radio')

        ->set('questions.2.options.0.is_correct', 0)
        ->set('questions.2.options.0.label', 'option 1 f')
        ->set('questions.2.options.1.is_correct', 1)
        ->set('questions.2.options.1.label', 'option 2 t')
        ->set('questions.2.options.2.is_correct', 0)
        ->set('questions.2.options.2.label', 'option 3 f');

    $component->call('addQuestion');

    // Question 4
    $component
        ->set('questions.3.title', 'question 4?')
        ->set('questions.3.hint', 'checkbox')
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

test('quiz cannot be created with invalid inputs', function ($title, $description, $type, $started_at, $expired_at, $question_title, $question_hint, $question_marks, $question_type, $errors) {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(CreateQuiz::class);

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

        ->set('questions.0.options.0.is_correct', 1)
        ->set('questions.0.options.0.label', 'yes')
        ->set('questions.0.options.1.is_correct', 0)
        ->set('questions.0.options.1.label', 'no');

    $component->call('save');

    $component->assertHasErrors($errors);
})->with('quiz_validation');
