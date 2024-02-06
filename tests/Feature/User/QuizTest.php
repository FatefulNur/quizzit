<?php

use App\Models\User;

test('user can see create quiz page', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get(route('user.quizzes.create'));

    $response->assertOk();

    $this->assertAuthenticated();
});

test('user cannot see create quiz page when unauthenticated', function () {
    $response = $this->get(route('user.quizzes.create'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});
