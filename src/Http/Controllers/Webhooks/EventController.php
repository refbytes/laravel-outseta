<?php

namespace RefBytes\Outseta\Http\Controllers\Webhooks;

use Illuminate\Http\Request;
use RefBytes\Outseta\Events\AccountCreatedEvent;
use RefBytes\Outseta\Events\AccountDeletedEvent;
use RefBytes\Outseta\Events\AccountPaidSubscriptionCreatedEvent;
use RefBytes\Outseta\Events\AccountSubscriptionAddOnsChangedEvent;
use RefBytes\Outseta\Events\AccountSubscriptionPlanUpdatedEvent;
use RefBytes\Outseta\Events\AccountUpdatedEvent;
use RefBytes\Outseta\Events\OutsetaEvent;
use RefBytes\Outseta\Events\PersonCreatedEvent;
use RefBytes\Outseta\Events\PersonDeletedEvent;
use RefBytes\Outseta\Events\PersonUpdatedEvent;

class EventController extends BaseWebhookController
{
    public function __invoke(Request $request)
    {
        abort_unless($this->isValid($request), 403);

        $data = $request->all();

        if (! empty($account = config()->get('outseta.auth.account')::firstWhere('uid', data_get($data, 'Uid')))) {
            $newAccountInfo = collect([
                'name' => data_get($data, 'Name'),
                'account_stage' => data_get($data, 'AccountStage'),
                'is_demo' => data_get($data, 'IsDemo'),
                'current_subscription' => data_get($data, 'CurrentSubscription'),
                'subscriptions' => data_get($data, 'Subscriptions'),
            ])
                ->filter()
                ->toArray();
            $account->update($newAccountInfo);
        }

        match ($request->get('event')) {
            'AccountCreated' => AccountCreatedEvent::dispatch($data),
            'AccountUpdated' => AccountUpdatedEvent::dispatch($data),
            'AccountDeleted' => AccountDeletedEvent::dispatch($data),
            'AccountPaidSubscriptionCreated' => AccountPaidSubscriptionCreatedEvent::dispatch($data),
            'AccountSubscriptionPlanUpdated' => AccountSubscriptionPlanUpdatedEvent::dispatch($data),
            'AccountSubscriptionAddOnsChanged' => AccountSubscriptionAddOnsChangedEvent::dispatch($data),
            'PersonCreated' => PersonCreatedEvent::dispatch($data),
            'PersonUpdated' => PersonUpdatedEvent::dispatch($data),
            'PersonDeleted' => PersonDeletedEvent::dispatch($data),
            default => OutsetaEvent::dispatch($data),
        };

        return response()->json(['message' => 'Webhook received.'], 200);
    }
}
