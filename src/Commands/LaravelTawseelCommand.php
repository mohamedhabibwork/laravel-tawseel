<?php

namespace Habib\LaravelTawseel\Commands;

use Illuminate\Console\Command;

class LaravelTawseelCommand extends Command
{
    public $signature = 'laravel-tawseel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
