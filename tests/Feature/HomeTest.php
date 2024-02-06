<?php

use App\Models\User;

it('has home page', function () {
    $response = $this->get('/');

    $response->assertOk();
});

it("has access without authentication", function () {
    $response = $this->get('/');

    $response->assertOk();

    $this->assertGuest();
});

it("has access with authentication", function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get('/');

    $response->assertOk();

    $this->assertAuthenticated();
});
