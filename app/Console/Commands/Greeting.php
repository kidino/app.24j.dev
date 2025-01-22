<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class Greeting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:greeting {userId}';

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
        // Get the user ID from the argument
        $userId = $this->argument('userId');

        // Retrieve the user from the database
        $user = User::find($userId);

        if (!$user) {
            $this->error('User not found.');
            return 1;
        }

        // Get the current hour using Carbon
        $currentTime = Carbon::now();
        $timeNow = $currentTime->format('h:i A');
        $currentHour = $currentTime->hour;

        // Determine the greeting based on the time of day
        if ($currentHour >= 5 && $currentHour < 12) {
            $greeting = 'Good morning';
        } elseif ($currentHour >= 12 && $currentHour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }

        // Output the greeting to the console
        $this->info("The time now is {$timeNow}");
        $this->info("$greeting, {$user->name}!");
    }
}
