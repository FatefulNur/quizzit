<?php

use App\Models\Quiz;
use App\Models\User;
use Livewire\Livewire;
use App\Models\UserResponse;
use App\Livewire\User\Responses\Index;

test('index page can be visited', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get(route('user.responses.index'));

    $response
        ->assertOk()
        ->assertSeeLivewire(Index::class);

    $this->assertAuthenticated();
});

test('index page cannot be visited when unauthenticated', function () {
    $response = $this->get(route('user.responses.index'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});

test('responses data can be displayed', function () {
    $this->actingAs($user = User::factory()->create());

    $quiz1 = Quiz::factory()->create([
        'title' => 'Quiz 1',
        'user_id' => $user->id,
    ]);
    $quiz2 = Quiz::factory()->create([
        'title' => 'Quiz 2',
        'user_id' => $user->id,
    ]);

    UserResponse::factory()->create([
        'user_id' => $user->id,
        'quiz_id' => $quiz1->id,
    ]);

    $component = Livewire::test(Index::class);

    $component
        ->assertSee('Quiz 1')
        ->assertDontSee('Quiz 2');
});

test('index is paginated with 10 quizzes per page', function () {
    $this->actingAs($user = User::factory()->create());

    UserResponse::factory(20)->state(['user_id' => $user->id])->create();

    $component = Livewire::test(Index::class);

    $component
        ->assertViewHas('responses', fn($responses) => $responses->count() === 10);
});
