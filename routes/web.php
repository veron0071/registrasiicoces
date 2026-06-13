<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;


Route::get('/', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/success', [RegistrationController::class, 'success'])->name('registration.success');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login')->middleware('guest:admin');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit')->middleware('guest:admin');

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        Route::get('/participants', [AdminController::class, 'participants'])->name('admin.participants');
        Route::get('/participants/{participant}', [AdminController::class, 'show'])->name('admin.participants.show');
        Route::patch('/participants/{participant}/payment', [AdminController::class, 'updatePaymentStatus'])->name('admin.participants.update_payment');
        
        Route::get('/export/excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
        Route::get('/export/csv', [AdminController::class, 'exportCsv'])->name('admin.export.csv');
    });
});

