<?php

namespace Rvzug\FilamentDropdownActions\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rvzug\FilamentDropdownActions\FilamentDropdownActions
 */
class FilamentDropdownActions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Rvzug\FilamentDropdownActions\FilamentDropdownActions::class;
    }
}
