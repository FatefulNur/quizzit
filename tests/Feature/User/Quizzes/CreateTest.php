<?php

use App\Livewire\User\Quizzes\Create;
use App\Models\Quiz;
use App\Models\Subscription;
use App\Models\Tenant;
use Livewire\Livewire;
use App\Models\User;

test('create quiz page can be visited', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get(route('user.quizzes.create'));

    $response
        ->assertOk()
        ->assertSeeLivewire(Create::class);

    $this->assertAuthenticated();
});

test('create quiz page cannot be visited when unauthenticated', function () {
    $response = $this->get(route('user.quizzes.create'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});

test('quiz cannot be created when fresher reached their max attempt', function () {
    $this->actingAs($user = User::factory()->create());

    Quiz::factory(5)->create(['user_id' => $user->id]);

    $component = Livewire::test(Create::class);

    $component->call('save');

    $component->assertOk()
        ->assertRedirect(route('notify.plans.create_quiz'));

    $this->assertAuthenticated();
});

test('unlimited quiz can be created when fresher upgrade to enterprise plan', function () {
    $this->artisan('app:generate-products')->assertSuccessful();

    $this->actingAs($user = User::factory()->create());

    $tenant = Tenant::factory()->create([
        'email' => 'robert@test.io',
    ]);
    $user->tenant()->associate($tenant);
    Subscription::create([
        'identity' => 2187281,
        'product_name' => 'Enterprise',
        'user_name' => 'robert',
        'user_email' => 'robert@test.io',
        'status' => 'active',
        'cancelled' => 0,
        'card_brand' => 'visa',
        'renews_at' => null,
        'ends_at' => null,
        'tenant_id' => $tenant->id,
        'product_id' => 1,
    ]);

    Quiz::factory(78)->create(['user_id' => $user->id]);

    $component = Livewire::test(Create::class);

    $component->call('save');

    $component->assertOk();

    $this->assertAuthenticated();
});

test('questions can be added', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(Create::class);

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
                    'is_correct' => false,
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
                    'is_correct' => false,
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
                    'is_correct' => false,
                ]
            ],
        ],
    ]);
});

test('questions can be removed', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(Create::class)
        ->set('questions', [
            [
                'title' => 'question 1?',
                'hint' => 'first question',
                'marks' => '',
                'type' => '',
                'options' => [
                    [
                        'label' => 'Option 1',
                        'is_correct' => false,
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
                        'is_correct' => false,
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
                    'is_correct' => false,
                ]
            ],
        ],
    ]);

    $component->call('removeQuestion', 0);

    $component->assertSet('questions', []);
});

test('options can be added', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(Create::class);

    $component->call('addOption', 0);
    $component->call('addOption', 0);

    $component->assertSet('questions.0.options', [
        [
            'label' => 'Option 1',
            'is_correct' => false,
        ],
        [
            'label' => 'Option 2',
            'is_correct' => false,
        ],
        [
            'label' => 'Option 3',
            'is_correct' => false,
        ],
    ]);
});

test('options can be removed', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(Create::class);

    $component->call('addOption', 0);
    $component->call('addOption', 0);

    $component->assertSet('questions.0.options', [
        [
            'label' => 'Option 1',
            'is_correct' => false,
        ],
        [
            'label' => 'Option 2',
            'is_correct' => false,
        ],
        [
            'label' => 'Option 3',
            'is_correct' => false,
        ],
    ]);

    $component->call('removeOption', 0, 1);

    $component->assertSet('questions.0.options', [
        0 => [
            'label' => 'Option 1',
            'is_correct' => false,
        ],
        2 => [
            'label' => 'Option 3',
            'is_correct' => false,
        ],
    ]);
});

test('quiz can be created', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(Create::class);

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

        ->set('questions.0.options.0.is_correct', true)
        ->set('questions.0.options.0.label', 'answer');

    $component->call('addQuestion');

    // Question 2
    $component
        ->set('questions.1.title', 'question 2?')
        ->set('questions.1.hint', 'long text')
        ->set('questions.1.marks', 5)
        ->set('questions.1.type', 'long_text')

        ->set('questions.1.options.0.is_correct', true)
        ->set('questions.1.options.0.label', 'answer');

    $component->call('addQuestion');

    // Question 3
    $component
        ->set('questions.2.title', 'question 3?')
        ->set('questions.2.hint', 'this is question 3')
        ->set('questions.2.marks', 1)
        ->set('questions.2.type', 'radio')

        ->set('questions.2.options.0.is_correct', true)
        ->set('questions.2.options.0.label', 'option 1 f')
        ->set('questions.2.options.1.is_correct', true)
        ->set('questions.2.options.1.label', 'option 2 t')
        ->set('questions.2.options.2.is_correct', false)
        ->set('questions.2.options.2.label', 'option 3 f');

    $component->call('addQuestion');

    // Question 4
    $component
        ->set('questions.3.title', 'question 4?')
        ->set('questions.3.hint', 'checkbox')
        ->set('questions.3.marks', 3)
        ->set('questions.3.type', 'checkbox')

        ->set('questions.3.options.0.is_correct', false)
        ->set('questions.3.options.0.label', 'option 1 f')
        ->set('questions.3.options.1.is_correct', true)
        ->set('questions.3.options.1.label', 'option 2 t')
        ->set('questions.3.options.2.is_correct', true)
        ->set('questions.3.options.2.label', 'option 3 t');

    $component
        ->call('save')
        ->assertOk()
        ->assertHasNoErrors()
        ->assertSessionHas('status', 'Success!')
        ->assertRedirect(route('user.quizzes.edit', Quiz::first()->id));

    $this->assertDatabaseCount('quizzes', 1);
    $this->assertDatabaseHas('quizzes', [
        'title' => 'New Quiz',
        'description' => 'new quiz description.',
        'type' => 'public',
    ]);
    $this->assertDatabaseCount('questions', 4);
    $this->assertDatabaseHas('questions', [
        'title' => 'question 1?',
        'hint' => 'short text',
        'marks' => 2,
        'type' => 'short_text',
        'quiz_id' => Quiz::first()->id,
    ]);
    $this->assertDatabaseHas('questions', [
        'title' => 'question 2?',
        'hint' => 'long text',
        'marks' => 5,
        'type' => 'long_text',
        'quiz_id' => Quiz::first()->id,
    ]);
    $this->assertDatabaseHas('questions', [
        'title' => 'question 3?',
        'hint' => 'this is question 3',
        'marks' => 1,
        'type' => 'radio',
        'quiz_id' => Quiz::first()->id,
    ]);
    $this->assertDatabaseHas('questions', [
        'title' => 'question 4?',
        'hint' => 'checkbox',
        'marks' => 3,
        'type' => 'checkbox',
        'quiz_id' => Quiz::first()->id,
    ]);
    $this->assertDatabaseCount('options', 8);
    $this->assertSame(11, Quiz::first()->marks_total);
});

test('quiz timer can be added', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(Create::class);

    // Quiz
    $component
        ->set('title', 'New Quiz')
        ->set('description', 'new quiz description.')
        ->set('type', false)
        ->set('timer', 40)
        ->set('started_at', now()->addDay())
        ->set('expired_at', now()->addDays(3));

    // Question 1
    $component
        ->set('questions.0.title', 'question 1?')
        ->set('questions.0.hint', 'short text')
        ->set('questions.0.marks', 2)
        ->set('questions.0.type', 'short_text')

        ->set('questions.0.options.0.is_correct', true)
        ->set('questions.0.options.0.label', 'answer');

    $component
        ->call('save')
        ->assertOk()
        ->assertHasNoErrors()
        ->assertSessionHas('status', 'Success!')
        ->assertRedirect(route('user.quizzes.edit', Quiz::first()->id));

    $this->assertDatabaseCount('quizzes', 1);
    $this->assertDatabaseHas('quizzes', [
        'title' => 'New Quiz',
        'description' => 'new quiz description.',
        'type' => 'public',
        'timer' => 40,
        'is_timeout' => 0,
    ]);
    $this->assertDatabaseCount('questions', 1);
    $this->assertDatabaseHas('questions', [
        'title' => 'question 1?',
        'hint' => 'short text',
        'marks' => 2,
        'type' => 'short_text',
        'quiz_id' => Quiz::first()->id,
    ]);

    $this->assertDatabaseCount('options', 1);
    $this->assertSame(2, Quiz::first()->marks_total);
});

test('quiz cannot be created with invalid inputs', function ($title, $description, $type, $started_at, $expired_at, $question_title, $question_hint, $question_marks, $question_type, $errors) {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(Create::class);

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
