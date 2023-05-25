<?php

use Illuminate\Support\Facades\Route;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->hasRole('Administrador')) {
            return Redirect::route('citas');
        } elseif ($user->hasRole('Recepcion')) {
            return Redirect::route('citas');
        } else {
            return Redirect::route('dashboard');
        }
    })->name('dashboard');

    Route::get('/citas', [AppointmentsController::class, 'index'])->name('citas');
    Route::get('/citas-nuevas', [AppointmentsController::class, 'create'])->name('citas.nueva');
    Route::post('/appointments.store', [AppointmentsController::class, 'store'])->name('appointments.store');
    
});


