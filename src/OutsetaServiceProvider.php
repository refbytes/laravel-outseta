<?php

namespace RefBytes\Outseta;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RefBytes\Outseta\Commands\OutsetaCommand;

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
            ->hasMigration('create_laravel_outseta_table')
            ->hasCommand(OutsetaCommand::class);
    }
}
