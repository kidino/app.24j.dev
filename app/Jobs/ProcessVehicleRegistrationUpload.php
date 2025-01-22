<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\VehicleRegistration;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Events\BeforeProcessVehicleRegistrationUpload;

class ProcessVehicleRegistrationUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private string $filePath
    ) {}

    public function handle(): void
    {
        try {
            $handle = fopen(Storage::path($this->filePath), 'r');
            Log::info("CSV import started: " . $this->filePath);
            if ($handle === false) {
                throw new \Exception("Cannot open file");
            }
    
            // Skip header row
            $headers = fgetcsv($handle);
            
            // Process each line
            $counter = 0;
            while (($row = fgetcsv($handle)) !== false) {

                echo "[". ++$counter ."] - " .implode(" | ",$row) . "\n";

                if (count($row) === 7) { // Adjust count based on your columns
                    VehicleRegistration::create([
                        'date_reg' => $row[0],
                        'type' => $row[1],
                        'maker' => $row[2],
                        'model' => $row[3],
                        'colour' => $row[4],
                        'fuel' => $row[5],
                        'state' => $row[6],
                    ]);
                }
            }
    
            fclose($handle);
            Storage::delete($this->filePath);
            
        } catch (\Exception $e) {
            if (isset($handle) && is_resource($handle)) {
                fclose($handle);
            }
            Log::error("CSV import failed: " . $e->getMessage());
            throw $e;
        }
    }
    
    
}