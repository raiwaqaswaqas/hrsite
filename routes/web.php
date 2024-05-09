<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\employeecontroller;
use Illuminate\Support\Facades\Route;

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/companies',[admincontroller::class, 'index'])->name('companies');
    Route::post('/companies/store', [admincontroller::class,'store'])->name('companies.store');
    Route::get('/edit/{id}', [admincontroller::class, 'edit'])->name('edit');
    Route::get('/update', [admincontroller::class, 'update'])->name('update');
    Route::get('/delete/{id}', [admincontroller::class, 'destroy'])->name('delete');
    
    Route::get('/employee',[employeecontroller::class, 'index'])->name('employee');
    Route::post('/employee/store',[employeecontroller::class, 'store'])->name('employee.store');
    Route::get('employee/edit/{id}',[employeecontroller::class, 'edit'])->name('employee.edit');
    Route::post('employee/update',[employeecontroller::class, 'update'])->name('employee.update');
    Route::get('employee/delete/{id}', [employeecontroller::class, 'destroy'])->name('employee/delete');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
