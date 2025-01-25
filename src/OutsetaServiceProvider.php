<?php

namespace RefBytes\Outseta;

use RefBytes\Outseta\Commands\OutsetaPlanFamiliesCommand;
use RefBytes\Outseta\Commands\OutsetaPlansCommand;
use RefBytes\Outseta\View\Components\AppLayout;
use RefBytes\Outseta\View\Components\GuestLayout;
use RefBytes\Outseta\View\Components\QuickStartScript;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OutsetaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-outseta')
            ->hasConfigFile()
            ->hasViews()
            ->hasViewComponent('outseta', QuickStartScript::class)
            ->hasRoutes(['auth', 'web', 'webhooks'])
            ->hasMigration('create_accounts_table')
            ->hasCommands([
                OutsetaPlanFamiliesCommand::class,
                OutsetaPlansCommand::class,
            ]);

        app('router')->aliasMiddleware('outseta', \RefBytes\Outseta\Http\Middleware\SubscribedMiddleware::class);

        if (! class_exists('App\View\Components\AppLayout')) {
            $package->hasViewComponent('', AppLayout::class);
        }

        if (! class_exists('App\View\Components\GuestLayout')) {
            $package->hasViewComponent('', GuestLayout::class);
        }

        if (app()->environment('testing')) {
            $package->hasRoute('testing');
        }

    }
}
