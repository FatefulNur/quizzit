<?php
use App\Models\User;

test('dashboard page can be visited', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get(route('user.dashboard'));

    $response->assertOk();

    $this->assertAuthenticated();
});

test('dashboard page cannot be visited when unauthenticated', function () {
    $response = $this->get(route('user.dashboard'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});
