<?php

// config for RefBytes/Outseta
return [

    'layouts' => [

        'guest' => env('OUTSETA_GUEST_LAYOUT', 'guest-layout'),

        'app' => env('OUTSETA_APP_LAYOUT', 'app-layout'),

    ],

    'plan' => [

        'family_uid' => env('OUTSETA_PLAN_FAMILY_UID'),

        'payment_term' => env('OUTSETA_PLAN_FAMILY_UID', 'month'),

    ],

    'api' => [

        'subdomain' => env('OUTSETA_SUBDOMAIN'),

        'key' => env('OUTSETA_API_KEY'),

        'secret' => env('OUTSETA_API_SECRET'),

    ],

    'auth' => [

        'user' => env('AUTH_MODEL', App\Models\User::class),

        'account' => env('OUTSETA_ACCOUNT_MODEL', \RefBytes\Outseta\Models\Account::class),

        'public_key' => env('OUTSETA_PUBLIC_KEY'),

        'redirect_after_login' => env('OUTSETA_REDIRECT_AFTER_LOGIN', '/dashboard'),

        'redirect_to_login' => env('OUTSETA_REDIRECT_IF_NOT_SUBSCRIBED', '/login'),

    ],

    'webhooks' => [

        'signature_key' => env('OUTSETA_WEBHOOK_KEY'),

        'events' => [
            'AccountCreated' => \RefBytes\Outseta\Events\AccountCreatedEvent::class,
            'AccountUpdated' => \RefBytes\Outseta\Events\AccountUpdatedEvent::class,
            'AccountDeleted' => \RefBytes\Outseta\Events\AccountDeletedEvent::class,
            'AccountAddPerson' => \RefBytes\Outseta\Events\AccountAddPersonEvent::class,
            'AccountRemovePerson' => \RefBytes\Outseta\Events\AccountRemovePersonEvent::class,
            'AccountPaidSubscriptionCreated' => \RefBytes\Outseta\Events\AccountPaidSubscriptionCreatedEvent::class,
            'AccountSubscriptionAddOnsChanged' => \RefBytes\Outseta\Events\AccountSubscriptionAddOnsChangedEvent::class,
            'AccountSubscriptionPlanUpdated' => \RefBytes\Outseta\Events\AccountSubscriptionPlanUpdatedEvent::class,
            'PersonCreated' => \RefBytes\Outseta\Events\PersonCreatedEvent::class,
            'PersonUpdated' => \RefBytes\Outseta\Events\PersonUpdatedEvent::class,
            'PersonDeleted' => \RefBytes\Outseta\Events\PersonDeletedEvent::class,
        ],

    ],

    'support' => [

        'form' => [

            'url' => env('OUTSETA_SUPPORT_URL', '/support'),

            'middleware' => ['auth'],

        ],

    ],

];
