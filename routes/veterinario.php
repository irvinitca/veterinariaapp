<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PetController;
use App\Http\Livewire\SelectAnidado;

 //Histories(diagnosticos)
 Route::get('/vet/diagnostico-nuevo', [HistoryController::class, 'showForm'])->name('vet.diagnostico-nuevo');
 Route::post('/vet/diagnostico-nuevo', [HistoryController::class, 'create'])->name('vet.diagnostico-nuevo.create');
 Route::get('/vet/diagnostico-nuevo/{appointment_id}', [HistoryController::class, 'showForm'])->name('vet.diagnostico-nuevo');
 Route::post('/vet/diagnostico-nuevo', [HistoryController::class, 'store'])->name('vet.diagnostico-nuevo.store');
 Route::post('/vet/diagnostico-nuevo/{appointment_id}', [HistoryController::class, 'store'])->name('vet.diagnostico-nuevo');
 Route::get('/vet/diagnostico-nuevo/{id}/details', [HistoryController::class, 'showDetails'])->name('vet.diagnostico-nuevo.showDetails');
 Route::get('/vet/dashboard', [AppointmentsController::class, 'index'])->name('vet.dashboard');
 Route::patch('/vet/update-status/{id}', [AppointmentsController::class, 'updateStatus'])->name('vet.updateStatus');
 Route::get('/appointments.update', [AppointmentsController::class, 'update'])->name('citas.editar');
 Route::get('/pet.histories', [HistoryController::class, 'histories'])->name('pet.histories');
 Route::get('/pets/{pet}/history', [HistoryController::class, 'history']);
