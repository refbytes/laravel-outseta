# Integrate Outseta with Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/refbytes/laravel-outseta.svg?style=flat-square)](https://packagist.org/packages/refbytes/laravel-outseta)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/refbytes/laravel-outseta/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/refbytes/laravel-outseta/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/refbytes/laravel-outseta/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/refbytes/laravel-outseta/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/refbytes/laravel-outseta.svg?style=flat-square)](https://packagist.org/packages/refbytes/laravel-outseta)

This [Laravel](https://laravel.com) package integrates [Outseta](http://www.outseta.com/?via=refbytes) registration, login, and internal user creation with Laravel. It also includes a webhook system for receiving Outseta events.

> [!NOTE]
> If you don't already have an account, you can register for a an [Outseta account](http://www.outseta.com/?via=refbytes). This is an affiliate link that helps me keep the lights on.

## Usage
In order to use this package, you'll need to have an [Outseta account](http://www.outseta.com/?via=refbytes). Once you account is created, you can follow these steps to integrate with your Laravel app.

### Outseta Account
Copy the subdomain portion of your Outseta URL to `OUTSETA_SUBDOMAIN` in your .env file. The subdmain can be copied from your browser's address bar. It can also be viewed and changed by going to Settings -> General -> Outseta URL.

### Sign up and Login
Go to Auth -> Sign up and Login -> Login Settings. Add your Post Login URL:

`https://<your-domain>/auth/callback`

Copy your JWT key from Auth -> Sign up and Login -> Login Settings -> Show advanced options -> JWT Key to `OUTSETA_PUBLIC_KEY` in your .env file.

Users will be redirected to the intended path and `/dashboard` by default after logging in. You can change the default by setting `OUTSETA_REDIRECT_AFTER_LOGIN` in your .env file.

There is a middleware alias that can be applied to route called `subscribed`. If the user is not subscribed they will be redirected to the base URL by default, but you can customize this by adding the path to `OUTSETA_REDIRECT_IF_NOT_SUBSCRIBED` in your .env file.

### Support Tickets
By default there is a route protected by auth middleware at `/support`. You can change this path by setting `OUTSETA_SUPPORT_URL` in your .env file.

### Receiving Webhook Events
To receive updates in your app from Outseta, you'll need to set up a webhook for each event. Start by going to Settings -> Notifications and click the cog next to Add a Notification button. You'll need to generate a signature key and add it to your account and copy the key to `OUTSETA_WEBHOOK_KEY` in your .env file. 

Generating a key can be done by running the command below. For more information see [Secure and verify webhooks with a SHA256 Signature](https://go.outseta.com/support/kb/articles/Rm85R5Q4/secure-and-verify-webhooks-with-a-sha256-signature)

```bash
openssl rand -hex 32
```

Once the webhook signature key has been created and saved, you can start adding notifications for your application. Currently there is a subset of events that can be listened for specifically and the rest trigger a generic OutSettaEvent. 

The URLs for notifications should be entered as follows:

```
https://<your-domain>/webhooks/event?event=AccountCreated
https://<your-domain>/webhooks/event?event=AccountDeleted
https://<your-domain>/webhooks/event?event=AccountPaidSubscriptionCreated
https://<your-domain>/webhooks/event?event=AccountSubscriptionAddOnsChangedEvent
https://<your-domain>/webhooks/event?event=AccountSubscriptionPlanUpdatedEvent
https://<your-domain>/webhooks/event?event=AccountUpdatedEvent
https://<your-domain>/webhooks/event?event=PersonCreatedEvent
https://<your-domain>/webhooks/event?event=PersonDeletedEvent
https://<your-domain>/webhooks/event?event=PersonUpdatedEvent
```



### API Integration
Currently the API isn't really being used, but there are 2 commands that can be used to list Plan Families and Plans. In future releases this may change. To create an API key, go to Settings -> Integrations -> API Keys and click the button to Add an API Key. Copy the key and secret to `OUTSETA_API_KEY` and `OUTSETA_API_SECRET` respectively in your .env file. 

## Installation

You can install the package via composer:

```bash
composer require refbytes/laravel-outseta
```

The included migrations create an accounts table and adds an account_id column to your users table.

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="outseta-migrations"
php artisan migrate
```

There are several configuration options that need to be set up in your `.env` file:

```dotenv
OUTSETA_SUBDOMAIN=
OUTSETA_API_KEY= # only required if using the API features
OUTSETA_API_SECRET= # only required if using the API features
OUTSETA_PUBLIC_KEY=
OUTSETA_REDIRECT_AFTER_LOGIN= # default is /dashboard
OUTSETA_REDIRECT_IF_NOT_SUBSCRIBED= # default is /
OUTSETA_WEBHOOK_KEY= 
```

```bash
You can publish the config file with:

```bash
php artisan vendor:publish --tag="outseta-config"
```

This is the contents of the published config file:

```php
return [

    'api' => [

        'subdomain' => env('OUTSETA_SUBDOMAIN'),

        'key' => env('OUTSETA_API_KEY'),

        'secret' => env('OUTSETA_API_SECRET'),

    ],

    'auth' => [

        'public_key' => env('OUTSETA_PUBLIC_KEY'),

        'redirect_after_login' => env('OUTSETA_REDIRECT_AFTER_LOGIN', '/dashboard'),

        'redirect_if_not_subscribed' => env('OUTSETA_REDIRECT_IF_NOT_SUBSCRIBED', '/'),

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
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="outseta-views"
```

The view include default embed codes:
 - Sign up
 - Login
 - Profile
 - Support ticket


## Features
 - [x] Registration
 - [x] Authentication
 - [x] Subscription Checking
 - [x] Webhooks with Events

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jon Fackrell](https://github.com/jonfackrell)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
