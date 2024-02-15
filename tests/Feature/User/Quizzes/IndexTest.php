<?php

use App\Models\Quiz;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\User\Quizzes\Index;

test('index page can be visited', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get(route('user.quizzes.index'));

    $response
        ->assertOk()
        ->assertSeeLivewire(Index::class);

    $this->assertAuthenticated();
});

test('index page cannot be visited when unauthenticated', function () {
    $response = $this->get(route('user.quizzes.index'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});

test('quizzes data can be displayed', function () {
    $this->actingAs($user = User::factory()->create());

    Quiz::factory()->create([
        'title' => 'Quiz 1',
        'user_id' => $user->id,
    ]);
    Quiz::factory()->create([
        'title' => 'Quiz 2',
        'user_id' => $user->id,
    ]);

    $component = Livewire::test(Index::class);

    $component
        ->assertSee('Quiz 1')
        ->assertSee('Quiz 2');
});

test('index is paginated with 10 quizzes per page', function () {
    $this->actingAs($user = User::factory()->create());

    Quiz::factory(20)->state(['user_id' => $user->id])->create();

    $component = Livewire::test(Index::class);

    $component
        ->assertViewHas('quizzes', fn($quizzes) => $quizzes->count() === 10);
});
