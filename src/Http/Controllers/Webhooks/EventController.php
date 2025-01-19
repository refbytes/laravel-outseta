<?php

namespace RefBytes\Outseta\Http\Controllers\Webhooks;

use Illuminate\Http\Request;
use RefBytes\Outseta\Events\OutsetaEvent;

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

        (config()->get('outseta.webhooks.events')[$request->get('event')] ?? OutsetaEvent::class)::dispatch($data);

        return response()->json(['message' => 'Webhook received.'], 200);
    }
}
