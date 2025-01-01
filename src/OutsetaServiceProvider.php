<?php

namespace RefBytes\Outseta;

use RefBytes\Outseta\Commands\OutsetaCommand;
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
            ->hasMigration('create_laravel_outseta_table')
            ->hasCommand(OutsetaCommand::class);
    }
}
