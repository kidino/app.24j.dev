<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::command('app:test-command')->everyTwoMinutes();

Schedule::command('app:send-happy-birthday-email')->daily();

Artisan::command('tambah {number1} {number2}', function () {
    $number1 = $this->argument('number1');
    $number2 = $this->argument('number2');  
    $this->info("{$number1} + {$number2} = " . ($number1 + $number2));
})->describe('Calculates the square of a given number');
