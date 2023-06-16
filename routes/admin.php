<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PetController;



//USUARIOS
Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/usuarios-nuevos', [UserController::class, 'create'])->name('admin.usuarios-nuevos');
Route::post('/users.store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}/', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//REPORTES
Route::get('/admin/pdf-pacientes', [PDFController::class, 'pdfPacientes'])->name('admin.pdf-pacientes');
Route::post('/admin/generate-pdf-pat', [PDFController::class, 'generatePDFPaciente'])->name('admin.generate-pdf-pat');
Route::get('/admin/generate-pdf-users', [PDFController::class, 'generatePDFUsers'])->name('admin.generate-pdf-users');
Route::get('/admin/pdf-ingresos', [PDFController::class, 'pdfIngresos'])->name('admin.pdf-ingresos');
Route::post('/admin/generate-pdf-ingresos', [PDFController::class, 'generatePDFIngresos'])->name('admin.generate-pdf-ingresos');
