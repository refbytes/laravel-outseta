<?php

namespace RefBytes\Outseta\Commands;

use Illuminate\Console\Command;

class OutsetaCommand extends Command
{
    public $signature = 'laravel-outseta';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
