<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    Queue::fake();

    Event::fake();
});
it('can create and login a new user', function () {
    config()->set('outseta.auth.user', \RefBytes\Outseta\Tests\TestSupport\Models\User::class);
    config()->set('outseta.auth.public_key', file_get_contents(__DIR__.'/TestSupport/public.key'));

    $accessToken = \Firebase\JWT\JWT::encode([
        'email' => $email = fake()->email,
        'given_name' => fake()->firstName,
        'family_name' => fake()->lastName,
        'outseta:accountUid' => \Illuminate\Support\Str::orderedUuid(),
    ], file_get_contents(__DIR__.'/TestSupport/private.key'), 'RS256');

    $this->get("/auth/callback?access_token=$accessToken")
        ->assertStatus(302);

    $user = \RefBytes\Outseta\Tests\TestSupport\Models\User::query()
        ->firstWhere('email', $email);
    expect($user)->not->toBeNull();
    expect(auth()->user())->not->toBeNull();
});

it('has a login page', function () {
    $this->get('/login')->assertStatus(200);
});

it('has a registration page', function () {
    $this->get('/register')->assertStatus(200);
});

it('requires login', function () {
    $this->get('/profile')->assertRedirect('login');
});

it('allows logged in user to view profile', function () {
    $user = \RefBytes\Outseta\Tests\TestSupport\Models\User::factory()->create();
    actingAs($user)->get('/profile')->assertStatus(200);
});

it('requires user to be subscribed to view protected content', function () {
    $user = \RefBytes\Outseta\Tests\TestSupport\Models\User::factory()
        ->for(\RefBytes\Outseta\Models\Account::factory()->create())
        ->create();
    actingAs($user)->get('/testing/dashboard')->assertStatus(302);
});
