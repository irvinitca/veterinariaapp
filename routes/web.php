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
    //Users
    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/usuarios-nuevos', [UserController::class, 'create'])->name('admin.usuarios-nuevos');
    Route::post('/users.store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}/', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    //Owners
    Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    Route::get('/owner/owners-nuevos', [OwnerController::class, 'create'])->name('owner.owners-nuevos');
    Route::post('/owners.store', [OwnerController::class, 'store'])->name('owners.store');
    Route::get('/owners/{id}/edit', [OwnerController::class, 'edit'])->name('owners.edit');
    Route::put('/owners/{id}/', [OwnerController::class, 'update'])->name('owners.update');
    Route::delete('/owners/{id}', [OwnerController::class, 'destroy'])->name('owners.destroy');
    //Pets
    Route::get('/pet/dashboard', [PetController::class, 'index'])->name('pet.dashboard');
    Route::get('/pet/pets-nuevos', [PetController::class, 'create'])->name('pet.pets-nuevos');
    Route::post('/pets.store', [PetController::class, 'store'])->name('pets.store');
    Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::put('/pets/{id}/', [PetController::class, 'update'])->name('pets.update');
    Route::delete('/pets/{id}', [PetController::class, 'destroy'])->name('pets.destroy');
    Route::get('/select-anidado', SelectAnidado::class);

    //Vets
    Route::get('/vet/dashboard', [AppointmentsController::class, 'index'])->name('vet.dashboard');

    //Histories(diagnosticos)
    Route::get('/vet/diagnostico-nuevo', [HistoryController::class, 'showForm'])->name('vet.diagnostico-nuevo');
    Route::post('/vet/diagnostico-nuevo', [HistoryController::class, 'create'])->name('vet.diagnostico-nuevo.create');
    Route::get('/vet/diagnostico-nuevo/{appointment_id}', [HistoryController::class, 'showForm'])->name('vet.diagnostico-nuevo');
    Route::post('/vet/diagnostico-nuevo', [HistoryController::class, 'store'])->name('vet.diagnostico-nuevo.store');

    //Citas
    Route::get('/citas', [AppointmentsController::class, 'index'])->name('citas');
    Route::get('/citas-nuevas/{pet_id?}', [AppointmentsController::class, 'create'])->name('citas.nueva');
    Route::post('/appointments.store', [AppointmentsController::class, 'store'])->name('appointments.store');
    Route::put('/appointments/{appointmentId}/cancel', [AppointmentsController::class, 'cancel'])->name('appointments.cancel');
    Route::get('/admin/generate-pdf-users', [PDFController::class, 'generatePDFUsers'])->name('admin.generate-pdf-users');
    //REPORTES
    Route::get('/admin/pdf-pacientes', [PDFController::class, 'pdfPacientes'])->name('admin.pdf-pacientes');
    Route::post('/admin/generate-pdf-pat', [PDFController::class, 'generatePDFPaciente'])->name('admin.generate-pdf-pat');

    Route::get('/appointments.update', [AppointmentsController::class, 'update'])->name('citas.editar');
});


