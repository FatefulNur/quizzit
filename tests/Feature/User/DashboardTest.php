<?php
use App\Models\User;

test('user can see dashboard page', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get(route('user.dashboard'));

    $response->assertOk();

    $this->assertAuthenticated();
});

test("user cannot see dashboard page when unauthenticated", function () {
    $response = $this->get(route('user.dashboard'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});
