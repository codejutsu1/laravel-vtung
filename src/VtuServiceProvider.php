<?php

namespace Codejutsu1\LaravelVtuNg;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Codejutsu1\LaravelVtuNg\Commands\VtuCommand;

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
            ->hasConfigFile();
    }
}
