<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ProcessVehicleRegistrationUpload;
use App\Events\BeforeProcessVehicleRegistrationUpload;

class VehicleRegistrationController extends Controller
{
    public function create()
    {
        return view('vehicle-registration.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $path = $request->file('csv_file')->store('uploads');
        
        // EVENT -- umumkan peristiwa yang berlaku
        event(new BeforeProcessVehicleRegistrationUpload( $request->user() ) ); 

        // Job dipanggil dengan fungsi dispatch()
        ProcessVehicleRegistrationUpload::dispatch($path);

        return redirect()->back()->with('success', 'File has been uploaded and will be processed shortly.');
    }
}