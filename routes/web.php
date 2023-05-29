<?php

use Illuminate\Support\Facades\Route;
use App\Models\Appointment;
use App\Models\User;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
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
            return Redirect::route('citas');
        } else if ($user->hasRole('Veterinario')){
            return Redirect::route('vet.dashboard');
        }else {
            return Redirect::route('dashboard');
        }
    })->name('dashboard');

    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/usuarios-nuevos', [UserController::class, 'create'])->name('admin.usuarios-nuevos');
    Route::post('/users.store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}/', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/vet/dashboard', [UserController::class, 'index'])->name('vet.dashboard');

    Route::get('/citas', [AppointmentsController::class, 'index'])->name('citas');
    Route::get('/citas-nuevas', [AppointmentsController::class, 'create'])->name('citas.nueva');
    Route::post('/appointments.store', [AppointmentsController::class, 'store'])->name('appointments.store');
    
    Route::get('/admin/generate-pdf-users', [PDFController::class, 'generatePDFUsers'])->name('admin.generate-pdf-users');
    //REPORTES
    Route::get('/admin/pdf-pacientes', [PDFController::class, 'pdfPacientes'])->name('admin.pdf-pacientes');
    Route::post('/admin/generate-pdf-pat', [PDFController::class, 'generatePDFPaciente'])->name('admin.generate-pdf-pat');

    Route::get('/appointments.update', [AppointmentsController::class, 'update'])->name('citas.editar');
});


