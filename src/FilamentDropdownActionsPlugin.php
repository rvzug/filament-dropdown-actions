<?php

namespace Rvzug\FilamentDropdownActions;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentDropdownActionsPlugin implements Plugin
{
    public function getId(): string
    {
        return 'dropdown-actions';
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function prepareActionsCollection(array $actions): HeaderSelectActionsCollection
    {
        return (new HeaderSelectActionsCollection($actions))
            ->setNameAsKey();

    }
}
