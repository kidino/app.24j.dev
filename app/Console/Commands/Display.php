<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Display extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:display';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('This is a line');
        $this->newLine(2);
        $this->info('This is an info');
        $this->comment('This is a comment');
        $this->question('This is a question...?');
        $this->warn('This is a warning');
        $this->error('This is an error');
    }
}
