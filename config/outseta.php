<?php

// config for RefBytes/Outseta
return [

    'api' => [

        'subdomain' => env('OUTSETA_SUBDOMAIN'),

        'key' => env('OUTSETA_API_KEY'),

        'secret' => env('OUTSETA_API_SECRET'),

    ],

    'auth' => [

        'public_key' => env('OUTSETA_PUBLIC_KEY'),

        'redirect_after_login' => env('OUTSETA_REDIRECT_AFTER_LOGIN', '/dashboard'),

        'redirect_to_login' => env('OUTSETA_REDIRECT_IF_NOT_SUBSCRIBED', '/login'),

    ],

    'webhooks' => [

        'signature_key' => env('OUTSETA_WEBHOOK_KEY'),

    ],

    'support' => [

        'form' => [

            'url' => env('OUTSETA_SUPPORT_URL', '/support'),

            'middleware' => ['auth'],

        ],

    ],

];
