<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\VehicleRegistrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/vehicle-registration/upload', [VehicleRegistrationController::class, 'create'])->name('vehicle-registrations.create');
    Route::post('/vehicle-registration/upload', [VehicleRegistrationController::class, 'store'])->name('vehicle-registrations.store');    
});

// Admin Routes
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class)->middleware('can:access-roles');
}); // --Admin Group

// Normal User Routes
Route::middleware(['auth', 'verified'])->group(function(){
    Route::resource('note', NoteController::class);
});


// use App\Models\Role;
 
// Route::put('/role/{role}', function (Role $role) {
//     // kod operasi di sini
// })->middleware('can:update,post');


// Route::put('/role/{role}', function (Role $role) {
//     // kod operasi di sini
// })->can('update', 'post');

// Route::post('/role', function () {
//     // kod operasi di sini
// })->middleware('can:create,App\Models\Role');

// Route::post('/role', function () {
//     // kod operasi di sini
// })->can('create', Role::class);

use Illuminate\Support\Facades\Mail;
use App\Mail\HappyBirthday;
use App\Models\User;

Route::get('/send-birthday-email/{user}', function (User $user) {
    // Trigger the birthday email

    Mail::to($user->email)->send(new HappyBirthday($user));

    return response()->json([
        'message' => "Happy Birthday email sent to {$user->name}!",
        'email' => $user->email,
    ]);
});




require __DIR__.'/auth.php';

