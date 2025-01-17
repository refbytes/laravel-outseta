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

        match ($request->get('event')) {
            'AccountCreated' => AccountCreatedEvent::dispatch($request->all()),
            'AccountUpdated' => AccountUpdatedEvent::dispatch($request->all()),
            'AccountDeleted' => AccountDeletedEvent::dispatch($request->all()),
            'AccountPaidSubscriptionCreated' => AccountPaidSubscriptionCreatedEvent::dispatch($request->all()),
            'AccountSubscriptionPlanUpdated' => AccountSubscriptionPlanUpdatedEvent::dispatch($request->all()),
            'AccountSubscriptionAddOnsChanged' => AccountSubscriptionAddOnsChangedEvent::dispatch($request->all()),
            'PersonCreated' => PersonCreatedEvent::dispatch($request->all()),
            'PersonUpdated' => PersonUpdatedEvent::dispatch($request->all()),
            'PersonDeleted' => PersonDeletedEvent::dispatch($request->all()),
            default => OutsetaEvent::dispatch($request->all()),
        };

        return response()->json(['message' => 'Webhook received.'], 200);
    }
}
