<?php

namespace Rvzug\FilamentDropdownActions\Actions;

use Closure;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Actions\Concerns\HasSelect;
use Rvzug\FilamentDropdownActions\FilamentDropdownActionsPlugin;

class DropdownActions extends Action
{
    use CanCustomizeProcess;
    use HasSelect;

    protected $afterCall = null;

    protected $resetSelectStateAfterCall = null;

    public static function getDefaultName(): ?string
    {
        return 'dropdown-actions';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->resetSelectStateAfterCall(true);

        $this->view('filament-dropdown-actions::actions.dropdown-actions');

    }

    public function afterCall(Closure $callback)
    {
        $this->afterCall = $callback;

        return $this;
    }

    public function getAfterCall(): ?Closure
    {
        return $this->afterCall;
    }

    public function resetSelectStateAfterCall(bool $bool = true): self
    {
        $this->resetSelectStateAfterCall = $bool;

        return $this;
    }

    public function getResetSelectStateAfterCall(): ?bool
    {
        return $this->resetSelectStateAfterCall;
    }

    /**
     * @return array<string>
     */
    public function getOptions(): array
    {
        $options = $this->evaluate($this->options) ?? [];

        // validate if all $options are of type Action
        $options = FilamentDropdownActionsPlugin::prepareActionsCollection($options);

        return $options->toArray();
    }
}
