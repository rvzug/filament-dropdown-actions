<?php

namespace Rvzug\FilamentDropdownActions\Pages\Contracts;

use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ViewRecord;
use Rvzug\FilamentDropdownActions\Actions\DropdownActions;
use Rvzug\FilamentDropdownActions\FilamentDropdownActionsPlugin;

trait HasHeaderSelectActions
{
    public $selectedSelectOption = null;

    public function placeHeaderSelectActions(): DropdownActions
    {
        return DropdownActions::make()
            ->placeholder($this->getHeaderSelectPlacholder())
            ->options($this->getHeaderSelectActions());
    }

    /** @internal */
    public function updatedSelectedSelectOption($selectedAction): void
    {
        $actions = FilamentDropdownActionsPlugin::prepareActionsCollection($this->getHeaderSelectActions());
        $action = $actions->findByName($selectedAction);

        $dropdown = $this->placeHeaderSelectActions();

        if (! $action || ! $action instanceof Action) {
            throw new \Exception('Action not found');
        }

        $parameters = [
            'livewire' => $this,
            'action' => $action,
            'dropdown' => $dropdown,
        ];

        switch (true) {
            case $this instanceof ListRecords:
                $afterCall = function () {
                    $this->resetTable();
                };

                break;

            case $this instanceof ViewRecord:
                $parameters['record'] = $this->record;
                $afterCall = function () {
                    $this->record->refresh();
                    $this->fillForm();
                };

                break;

            case $this instanceof EditRecord:
                $parameters['record'] = $this->record;
                $afterCall = function () {
                    $this->record->refresh();
                    $this->fillForm();
                };

                break;

            case $this instanceof CreateRecord:
                $afterCall = function () {};

                break;

        }

        if ($overwriteAfterCall = $dropdown->getAfterCall()) {
            $afterCall = $overwriteAfterCall;
        }

        $action->call($parameters);

        if ($dropdown->getResetSelectStateAfterCall()) {
            $this->selectedSelectOption = null;
        }

        $afterCall();
    }

    public function getHeaderSelectPlacholder(): string
    {
        return __('Select an action');
    }

    abstract public function getHeaderSelectActions(): array;
}
