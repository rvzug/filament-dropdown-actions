<?php

namespace Rvzug\FilamentDropdownActions\Commands;

use Illuminate\Console\Command;

class FilamentDropdownActionsCommand extends Command
{
    public $signature = 'filament-dropdown-actions';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
