<?php

use App\Models\Quiz;
use App\Models\User;

it('has home page', function () {
    $response = $this->get('/');

    $response->assertOk();
});

it('has access without authentication', function () {
    $response = $this->get('/');

    $response->assertOk();

    $this->assertGuest();
});

it('has access with authentication', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get('/');

    $response->assertOk();

    $this->assertAuthenticated();
});

it('has list of quizzes', function () {
    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertViewIs('index')
        ->assertViewHas('quizzes');
});

it('has 12 quizzes data per pages', function () {
    Quiz::factory(18)->create([
        'started_at' => now(),
    ]);

    $response = $this->get('/');

    $response->assertViewHas('quizzes', fn($quizzes) => $quizzes->count() === 12);

    $response = $this->get('/?page=2');

    $response->assertViewHas('quizzes', fn($quizzes) => $quizzes->count() === 6);
});

it('cannot show quizzes has not been started yet', function () {
    Quiz::factory(6)->create([
        'started_at' => now()->addDays(2),
    ]);
    Quiz::factory(6)->create([
        'started_at' => now(),
    ]);

    $response = $this->get('/');

    $response->assertViewHas('quizzes', fn($quizzes) => $quizzes->count() === 6);

    $response = $this->get('/?page=2');

    $response->assertViewHas('quizzes', fn($quizzes) => $quizzes->count() === 0);
});
