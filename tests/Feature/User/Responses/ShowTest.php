<?php

use App\Livewire\User\Responses\Show;
use App\Models\Quiz;
use App\Models\User;
use App\Models\UserResponse;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->quiz = Quiz::factory()->public()->create();

    $this->response = UserResponse::factory()->create([
        'user_id' => $this->user->id,
        'quiz_id' => $this->quiz->id,
    ]);
});

test('single response page can be visited', function () {
    $response = $this
        ->actingAs($this->user)
        ->get(route('user.responses.show', $this->response));

    $response
        ->assertOk()
        ->assertSeeLivewire(Show::class);

    $this->assertAuthenticated();
});

test('single response page can be visited when unauthenticated', function () {
    $response = $this->get(route('user.responses.show', $this->response->id));

    $response
        ->assertOk()
        ->assertSeeLivewire(Show::class);

    $this->assertGuest();
});
