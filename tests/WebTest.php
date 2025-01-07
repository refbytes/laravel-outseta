<?php

it('has a support page', function () {
    $user = \RefBytes\Outseta\Tests\TestSupport\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user)->get(config('outseta.support.form.url'))->assertStatus(200);
});
