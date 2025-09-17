<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware('auth')->group(function() {
    // Employee CRUD
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');          // List semua atau company sendiri
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create'); // Form tambah
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employee.store');         // Simpan
    Route::get('/employees/{employeeId}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employees/{employeeId}', [EmployeeController::class, 'update'])->name('employee.update');  // Update
    Route::delete('/employees/{employeeId}', [EmployeeController::class, 'destroy'])->name('employee.destroy'); // Hapus
});


Route::resource('company', CompanyController::class);
Route::get('/companies', [CompanyController::class, 'index'])->name('company.index');
Route::get('/companies/create', [CompanyController::class, 'create']);
Route::post('/companies/create', [CompanyController::class, 'store']);


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


require __DIR__.'/auth.php';
