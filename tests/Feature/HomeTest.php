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

it('cannot contain more that 12 quiz information', function () {
    $quizzes = Quiz::factory(18)->create();

    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertViewIs('index')
        ->assertViewHas('quizzes', fn($quizzes) => $quizzes->count() === 12);
});
