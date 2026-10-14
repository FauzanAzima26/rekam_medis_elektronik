<?php

use App\Http\Controllers\Dashboard\ResepsionisController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ResepsionisController::class, 'index'])
        ->name('dashboard');

    Route::get('/pasien/getData', [PasienController::class, 'getData'])->name('pasien.getData');
    Route::resource('/pasien', PasienController::class)->names('pasien');

    Route::get('/pendaftaran/getData', [PendaftaranController::class, 'getData'])->name('pendaftaran.getData');
    Route::resource('/pendaftaran', PendaftaranController::class)->names('pendaftaran');
});



require __DIR__ . '/auth.php';
