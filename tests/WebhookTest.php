<?php

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use RefBytes\Outseta\Events\OutsetaEvent;

$headers = [];
function determineSignature(array $payload): string
{
    $secret = hex2bin(config('outseta.webhooks.signature_key'));

    return hash_hmac('sha256', json_encode($payload), $secret);
}

function getHeaders(array $payload): array
{
    return [
        'x-hub-signature-256' => determineSignature($payload),
    ];
}

beforeEach(function () {
    config()->set('outseta.webhooks.signature_key', 'ff2dc262eb445306911de743f778df2e1aa5c817d2428a43a2cff60f081f4b85');

    Queue::fake();

    Event::fake();
});

it('can process a webhook request', function () {
    $payload = [
        'a' => 1,
    ];

    $this->postJson('/webhooks/event', $payload, getHeaders($payload))
        ->assertSuccessful();

    Event::assertDispatched(OutsetaEvent::class);
});

it('can update account info in a webhook request', function () {
    $account = \RefBytes\Outseta\Models\Account::factory()
        ->trialing()
        ->create();

    $payload = [
        'Uid' => $account->uid,
        'Name' => $name = fake()->company,
        'AccountStage' => $stage = \RefBytes\Outseta\Enums\AccountStage::Subscribing->value,
        'IsDemo' => $isDemo = false,
        'CurrentSubscription' => $currentSubscription = [],
        'Subscriptions' => $subscriptions = [],
    ];

    $this->postJson('/webhooks/event', $payload, getHeaders($payload))
        ->assertSuccessful();

    $account = \RefBytes\Outseta\Models\Account::first();

    assert($account->name === $name);
    assert($account->account_stage === \RefBytes\Outseta\Enums\AccountStage::Subscribing->value);

    Event::assertDispatched(OutsetaEvent::class);
});

it('can trigger all events from a webhook request', function () {
    $payload = [
        'a' => 1,
    ];

    $events = [
        'AccountCreated' => \RefBytes\Outseta\Events\AccountCreatedEvent::class,
        'AccountUpdated' => \RefBytes\Outseta\Events\AccountUpdatedEvent::class,
        'AccountDeleted' => \RefBytes\Outseta\Events\AccountDeletedEvent::class,
        'AccountPaidSubscriptionCreated' => \RefBytes\Outseta\Events\AccountPaidSubscriptionCreatedEvent::class,
        'AccountSubscriptionAddOnsChanged' => \RefBytes\Outseta\Events\AccountSubscriptionAddOnsChangedEvent::class,
        'AccountSubscriptionPlanUpdated' => \RefBytes\Outseta\Events\AccountSubscriptionPlanUpdatedEvent::class,
        'PersonCreated' => \RefBytes\Outseta\Events\PersonCreatedEvent::class,
        'PersonUpdated' => \RefBytes\Outseta\Events\PersonUpdatedEvent::class,
        'PersonDeleted' => \RefBytes\Outseta\Events\PersonDeletedEvent::class,
    ];

    foreach ($events as $name => $event) {
        $this->postJson("/webhooks/event?event=$name", $payload, getHeaders($payload))
            ->assertSuccessful();
        Event::assertDispatched($event);
    }
});

it('can create a new account when a user signs up', function () {
    $account = \RefBytes\Outseta\Models\Account::factory()->create([
        'uid' => \Illuminate\Support\Str::orderedUuid(),
    ]);
    $payload = [
        'Uid' => $account->uid,
        'Name' => fake()->company,
        'AccountStage' => \RefBytes\Outseta\Enums\AccountStage::Subscribing->value,
        'IsDemo' => false,
        'CurrentSubscription' => [],
        'Subscriptions' => [],
    ];

    $this->postJson('/signup/callback', $payload, getHeaders($payload))
        ->assertSuccessful()
        ->assertJsonFragment([
            'ClientIdentifier' => $account->id,
        ]);
});
