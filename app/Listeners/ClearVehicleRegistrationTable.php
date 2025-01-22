<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\BeforeProcessVehicleRegistrationUpload;

class ClearVehicleRegistrationTable
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(
        BeforeProcessVehicleRegistrationUpload $event 
    ): void
    {       
        Log::info('CAR UPLOAD: vehicle_registrations dikosong oleh '. $event->user->name );
        DB::statement('DELETE FROM vehicle_registrations');
    }
}
