<?php

namespace RefBytes\Outseta;

use RefBytes\Outseta\Commands\OutsetaPlanFamiliesCommand;
use RefBytes\Outseta\Commands\OutsetaPlansCommand;
use RefBytes\Outseta\View\Components\AppLayout;
use RefBytes\Outseta\View\Components\GuestLayout;
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
            ->hasRoutes(['auth', 'web', 'webhooks'])
            ->hasMigration('create_accounts_table')
            ->hasCommands([
                OutsetaPlanFamiliesCommand::class,
                OutsetaPlansCommand::class,
            ]);

        app('router')->aliasMiddleware('outseta', \RefBytes\Outseta\Http\Middleware\SubscribedMiddleware::class);

        if (app()->environment('testing')) {
            $package->hasRoute('testing');
            $package->hasViewComponent('', GuestLayout::class);
            $package->hasViewComponent('', AppLayout::class);
        }

    }
}
