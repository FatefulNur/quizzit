<?php

use App\Models\User;
use App\Models\Tenant;
use Livewire\Livewire;
use App\Livewire\User\Billings\Index;

test('index page can be visited', function () {
    $response = $this
        ->actingAs($user = User::factory()->create())
        ->get(route('user.billings.index'));

    $response
        ->assertOk()
        ->assertSeeLivewire(Index::class);

    $this->assertAuthenticated();
});

test('index page cannot be visited when unauthenticated', function () {
    $response = $this->get(route('user.billings.index'));

    $response
        ->assertStatus(302)
        ->assertRedirectToRoute('login');

    $this->assertGuest();
});

test('user can update their tenant information', function () {
    $tenant = Tenant::create([
        'identity' => 8172812,
        'name' => 'Robert bruce',
        'email' => 'robert@test.io',
    ]);

    $this->actingAs($user = User::factory()->create(['tenant_id' => $tenant->id]));

    $component = Livewire::test(Index::class);

    $component
        ->set('form.name', 'New Name')
        ->set('form.email', 'robert@test.io')
        ->set('form.city', 'Blazeton')
        ->set('form.region', 'Wisconsin')
        ->set('form.country', 'America');

    $component->call('saveChanges');

    $component
        ->assertRedirect(route('user.billings.index'))
        ->assertSessionHas('status', 'Saved!');

    $this->assertDatabaseCount('tenants', 1);
    $this->assertDatabaseHas('tenants', [
        'name' => 'New Name',
        'email' => 'robert@test.io',
        'city' => 'Blazeton',
        'region' => 'Wisconsin',
        'country' => 'America',
    ]);
    $this->assertEquals($user->tenant_id, $tenant->id);
});

test('name & email cannot be null', function ($name, $email, $errors) {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(Index::class);

    $component
        ->set('form.name', $name)
        ->set('form.email', $email)
        ->set('form.city', 'South Blazeton')
        ->set('form.region', 'Wisconsin')
        ->set('form.country', 'America');

    $component->call('saveChanges');

    $component
        ->assertHasErrors($errors);
})->with([
            'null inputs' => ['', '', ['form.name', 'form.email']],
            'invalid email' => ['', 'testEmail.com', ['form.email']],
        ]);
