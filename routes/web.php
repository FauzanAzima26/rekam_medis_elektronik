<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\ResepsionisController;
use App\Http\Controllers\PasienController;
use App\Models\Pasien;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ResepsionisController::class, 'index'])
        ->name('dashboard');

    Route::get('/pasien/getData', [PasienController::class, 'getData'])->name('pasien.getData');
    Route::resource('/pasien', PasienController::class)->names('pasien');
});



require __DIR__ . '/auth.php';
