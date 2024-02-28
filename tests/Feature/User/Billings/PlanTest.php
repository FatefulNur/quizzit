<?php

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\User\Billings\Product;

test('plan page can be visited', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->get(route('user.billings.plan'));

    $response
        ->assertOk()
        ->assertSeeLivewire(Product::class);

    $this->assertAuthenticated();
});

test('plan page cannot be visited when unauthenticated', function () {
    $response = $this->get(route('user.billings.plan'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});

test('responses data can be displayed', function () {
    $this->artisan('app:generate-plans')->assertSuccessful();

    $this->actingAs(User::factory()->create());

    $component = Livewire::test(Product::class);

    $component
        ->assertSee('Fresher')
        ->assertSee('Enterprise');
});
