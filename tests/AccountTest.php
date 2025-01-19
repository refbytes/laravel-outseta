<?php

it('user can be assigned to a new account', function () {
    $user = \RefBytes\Outseta\Tests\TestSupport\Models\User::factory()->create();
    $account = \RefBytes\Outseta\Models\Account::factory()->create();
    $user->account()->associate($account)->save();

    expect($user->account)->not->toBeNull();
});

it('can assign multiple users to an account', function () {
    $users = \RefBytes\Outseta\Tests\TestSupport\Models\User::factory()->count(5)->create();
    $account = \RefBytes\Outseta\Models\Account::factory()->create();

    foreach ($users as $user) {
        $user->account()->associate($account)->save();
    }

    expect(
        \RefBytes\Outseta\Tests\TestSupport\Models\User::query()->where('account_id', $account->id)->count() === 5)
        ->toBeTrue();

    expect($user->users()->count() === 5)->toBeTrue();
});
