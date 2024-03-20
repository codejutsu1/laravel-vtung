<?php

namespace Codejutsu1\LaravelVtuNg\Vtu;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Codejutsu1\LaravelVtuNg\Vtu\Commands\VtuCommand;

class VtuServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-vtung')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-vtung_table')
            ->hasCommand(VtuCommand::class);
    }
}
