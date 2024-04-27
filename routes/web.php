<?php

use App\Http\Controllers\FirmasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('download/firmas/', [FirmasController::class, 'download'])->name('firmas.download');
    Route::resource('firmas', FirmasController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
