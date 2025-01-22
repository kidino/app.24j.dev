<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCommand extends Command
{
    protected $signature = 'app:test-command';

    protected $description = 'Test command';

    public function handle()
    {
        $currentDateTime = now();

        // paparan di skrin terminal
        $this->info("Test Command triggered at: " . $currentDateTime);
        
        // salinan dalam fail storage/logs/laravel.log
        Log::info("Test Command triggered at: " . $currentDateTime);
    }
}
