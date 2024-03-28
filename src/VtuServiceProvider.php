<?php

namespace Codejutsu1\LaravelVtuNg;

use Spatie\LaravelPackageTools\Package;
use Codejutsu1\LaravelVtuNg\Commands\VtuCommand;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

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
            ->name('codejutsu1/laravel-vtung')
            ->hasConfigFile()
            ->publishesServiceProvider('Codejutsu1\LaravelVtuNg\VtuServiceProvider')
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->startWith(function(InstallCommand $command) {
                        $command->info('Hello, and welcome to my great new VTU package!');
                        $command->newLine(2);
                    })
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('codejutsu1/laravel-vtung')
                    ->endWith(function(InstallCommand $command) {
                        $command->newLine(2);
                        $command->info('Have a great day and no forget Enjoy oh!');
                    });
            });
    }
}
