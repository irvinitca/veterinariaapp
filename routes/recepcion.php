<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;

// Agrega más rutas específicas para el rol de recepcion

//CITAS
Route::get('/citas', [AppointmentsController::class, 'index'])->name('citas');
Route::get('/pagos', [AppointmentsController::class, 'pagos'])->name('pagos');
Route::get('/citas/diagnosticadas', [AppointmentsController::class, 'diagnosticadas'])->name('citas.diagnosticadas');

Route::get('/citas-nuevas/{pet_id?}', [AppointmentsController::class, 'create'])->name('citas.nueva');
Route::get('/pago-cita/{appointmentId}', [AppointmentsController::class, 'pago'])->name('citas.pago');
Route::post('/appointments.store', [AppointmentsController::class, 'store'])->name('appointments.store');
Route::post('/appointments.pay', [AppointmentsController::class, 'pay'])->name('appointments.pay');
Route::put('/appointments/{appointmentId}/cancel', [AppointmentsController::class, 'cancel'])->name('appointments.cancel');
//REPORTES
Route::get('/recepcion/pdf-pacientes', [PDFController::class, 'pdfPacientes'])->name('recepcion.pdf-pacientes');
Route::post('/admin/generate-pdf-pat', [PDFController::class, 'generatePDFPaciente'])->name('admin.generate-pdf-pat');
//MASCOTAS
Route::get('/pet/dashboard', [PetController::class, 'index'])->name('pet.dashboard');
Route::get('/pet/pets-nuevos', [PetController::class, 'create'])->name('pet.pets-nuevos');
Route::post('/pets.store', [PetController::class, 'store'])->name('pets.store');
Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
Route::put('/pets/{id}/', [PetController::class, 'update'])->name('pets.update');
Route::delete('/pets/{id}', [PetController::class, 'destroy'])->name('pets.destroy');
//PROPIETARIOS
 Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
 Route::get('/owner/owners-nuevos', [OwnerController::class, 'create'])->name('owner.owners-nuevos');
 Route::post('/owners.store', [OwnerController::class, 'store'])->name('owners.store');
 Route::get('/owners/{id}/edit', [OwnerController::class, 'edit'])->name('owners.edit');
 Route::put('/owners/{id}/', [OwnerController::class, 'update'])->name('owners.update');
 Route::delete('/owners/{id}', [OwnerController::class, 'destroy'])->name('owners.destroy');