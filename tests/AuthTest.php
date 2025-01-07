<?php

use function Pest\Laravel\actingAs;

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
