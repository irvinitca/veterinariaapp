<?php

use Illuminate\Support\Facades\Route;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Owner;
use App\Models\Pet;
use App\Http\Livewire\SelectAnidado;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PetController;

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
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('Administrador')) {
            return Redirect::route('admin.dashboard');
        } elseif ($user->hasRole('Recepcion')) {
            return Redirect::route('citas');
        } else if ($user->hasRole('Veterinario')){
            return Redirect::route('vet.dashboard');
        }
    })->name('dashboard');

});


