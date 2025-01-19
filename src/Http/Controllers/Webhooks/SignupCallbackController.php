<?php

namespace RefBytes\Outseta\Http\Controllers\Webhooks;

use Illuminate\Http\Request;

class SignupCallbackController extends BaseWebhookController
{
    public function __invoke(Request $request)
    {
        abort_unless($this->isValid($request), 403);

        $data = $request->all();

        $account = config()->get('outseta.auth.account')::firstOrCreate([
            'uid' => data_get($data, 'Uid'),
        ], [
            'name' => data_get($data, 'Name'),
            'account_stage' => data_get($data, 'AccountStage'),
            'is_demo' => data_get($data, 'IsDemo'),
            'current_subscription' => data_get($data, 'CurrentSubscription'),
            'subscriptions' => data_get($data, 'Subscriptions'),
        ]);

        $data['ClientIdentifier'] = $account->id;

        return response()
            ->json($data, 200);
    }
}
