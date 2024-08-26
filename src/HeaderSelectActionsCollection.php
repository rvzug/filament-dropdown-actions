<?php

namespace Rvzug\FilamentDropdownActions;

use Filament\Actions\Action;
use Illuminate\Support\Collection;

class HeaderSelectActionsCollection extends Collection
{
    public function validate(): self
    {
        $this->each(function ($item) {
            if (! $item instanceof Action) {
                throw new \Exception('DropdownActions::getOptions() expects all options to be of type Filament\Actions\Action');
            }
        });

        return $this;
    }

    public function setNameAsKey(): self
    {
        $this->validate();

        $keyed = $this->keyBy(function (Action $action) {
            return $action->getName();
        });

        return $keyed;
    }

    public function findByName($name): ?Action
    {
        $this->validate();

        $action = $this->first(function ($action) use ($name) {
            return $action->getName() === $name;
        });

        if (! $action) {
            return null;
        }

        return $action;
    }
}
