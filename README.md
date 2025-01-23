# Integrate Outseta with Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/refbytes/laravel-outseta.svg?style=flat-square)](https://packagist.org/packages/refbytes/laravel-outseta)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/refbytes/laravel-outseta/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/refbytes/laravel-outseta/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/refbytes/laravel-outseta/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/refbytes/laravel-outseta/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/refbytes/laravel-outseta.svg?style=flat-square)](https://packagist.org/packages/refbytes/laravel-outseta)

This [Laravel](https://laravel.com) package integrates [Outseta](http://www.outseta.com/?via=refbytes) registration, login, and internal user creation with Laravel. It also includes a webhook configuration for receiving Outseta events.

> [!NOTE]
> If you don't already have an account, you can register for a an [Outseta account](http://www.outseta.com/?via=refbytes). This is an affiliate link that helps me keep the lights on.

## Usage
In order to use this package, you'll need to have an [Outseta account](http://www.outseta.com/?via=refbytes). Once you account is created, you can follow these steps to integrate with your Laravel app.

### Outseta Account
Copy the subdomain portion of your Outseta URL to `OUTSETA_SUBDOMAIN` in your .env file. The subdmain can be copied from your browser's address bar. It can also be viewed and changed by going to Settings -> General -> Outseta URL.


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
OUTSETA_PUBLIC_KEY=
OUTSETA_REDIRECT_AFTER_LOGIN= # default is /dashboard
OUTSETA_REDIRECT_IF_NOT_SUBSCRIBED= # default is /
OUTSETA_WEBHOOK_KEY= 
```

If you choose to, you can publish the config file with:

```bash
php artisan vendor:publish --tag="outseta-config"
```

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


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
