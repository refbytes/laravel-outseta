# Integrate Outseta with Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/refbytes/laravel-outseta.svg?style=flat-square)](https://packagist.org/packages/refbytes/laravel-outseta)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/refbytes/laravel-outseta/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/refbytes/laravel-outseta/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/refbytes/laravel-outseta/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/refbytes/laravel-outseta/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/refbytes/laravel-outseta.svg?style=flat-square)](https://packagist.org/packages/refbytes/laravel-outseta)

This [Laravel](https://laravel.com) package integrates [Outseta](http://www.outseta.com/?via=laravel) registration, login, and internal user creation with Laravel. It also includes a webhook configuration for receiving Outseta events.

[![Intro to Outseta for Laravel](https://img.youtube.com/vi/el3TvMVsRR8/0.jpg)](https://www.youtube.com/watch?v=el3TvMVsRR8)

> [!NOTE]
> If you don't already have an account, you can register for a an [Outseta account](http://www.outseta.com/?via=laravel). This is an affiliate link that helps me keep the lights on.

## Usage
In order to use this package, you'll need to have an [Outseta account](http://www.outseta.com/?via=laravel). Once you account is created, you can follow these steps to get started. A full integration guide is provided in the [wiki](https://github.com/refbytes/laravel-outseta/wiki).

### Outseta Account
Copy the subdomain portion of your Outseta URL to `OUTSETA_SUBDOMAIN` in your .env file. The subdomain can be copied from your browser's address bar. It can also be viewed and changed by going to Settings -> General -> Outseta URL.


## Installation

You can install the package via composer:

```bash
composer require refbytes/laravel-outseta
```

The included migrations create an accounts table and adds an account_id column to your users table. If you need to customize the models used by this package you can specify them in the config file using `.env` keys. 

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="outseta-migrations"
php artisan migrate
```

In order to integrate the Outseta Authentication, you need to add the Quick Start script to the header of every page. You can do this be adding the included component to the `<head>` section of your layouts.

```blade
<x-outseta-quick-start-script />
```

There are a few configuration options that are required to be set up in your `.env` file and several optional settings depending on your app:

```dotenv
OUTSETA_SUBDOMAIN=
OUTSETA_PUBLIC_KEY=
OUTSETA_WEBHOOK_KEY= 

OUTSETA_REDIRECT_AFTER_LOGIN= # default is /dashboard
OUTSETA_REDIRECT_IF_NOT_SUBSCRIBED= # default is /
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
