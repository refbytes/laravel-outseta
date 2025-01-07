<?php

namespace RefBytes\Outseta\Http\Controllers\Webhooks;

use Illuminate\Http\Request;

class BaseWebhookController
{
    protected function isValid(Request $request): bool
    {
        $signature = str($request->header('x-hub-signature-256'))
            ->after('sha256=')
            ->toString();

        if (! $signature) {
            return false;
        }

        $signingSecret = config('outseta.webhooks.signature_key');
        $decodedKey = hex2bin($signingSecret);

        if (empty($signingSecret)) {
            throw new \Exception('Outseta webhook signing secret is not set.');
        }

        $computedSignature = hash_hmac('sha256', $request->getContent(), $decodedKey);

        return hash_equals($computedSignature, $signature);
    }
}
