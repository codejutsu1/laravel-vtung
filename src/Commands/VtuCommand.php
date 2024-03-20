<?php

namespace Codejutsu1\LaravelVtuNg\Commands;

use Illuminate\Console\Command;

class VtuCommand extends Command
{
    public $signature = 'laravel-vtung';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
