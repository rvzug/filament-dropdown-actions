<?php

namespace Rvzug\FilamentDropdownActions;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Rvzug\FilamentDropdownActions\Commands\FilamentDropdownActionsCommand;

class FilamentDropdownActionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-dropdown-actions')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament_dropdown_actions_table')
            ->hasCommand(FilamentDropdownActionsCommand::class);
    }
}
