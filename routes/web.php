<?php

use Illuminate\Support\Facades\Route;
use App\Models\Appointment;

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
            return Redirect::route('admin.dashboard');
        } elseif ($user->hasRole('Recepcion')) {
            return Redirect::route('recepcion.dashboard');
        } else {
            return Redirect::route('dashboard');
        }
    })->name('dashboard');

    Route::get('/recepcion/dashboard', function () {
        $appointments = Appointment::orderByDesc('date_start')->paginate(10);
        return view('recepcion.dashboard', compact('appointments'));
    })->name('recepcion.dashboard');
    
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
