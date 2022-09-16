<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BaseExcelController;
use App\Http\Controllers\FirmarPDF;
use App\Http\Controllers\Polizas;
use App\Http\Controllers\Renombrado;
use App\Http\Controllers\Soportes;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');
    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');

    Route::resource('renombrado', Renombrado::class);
    Route::resource('soportes', Soportes::class);
    Route::get('soportes/zipDownload/{poliza}', [Soportes::class, 'zipDownload'])->name('soportes.zipDownload');
    Route::resource('polizas', Polizas::class);
    Route::get('polizas/zipDownload/{poliza}', [Polizas::class, 'zipDownload'])->name('polizas.zipDownload');
    Route::resource('firmas-PDF', FirmarPDF::class);
    Route::resource('comparar', BaseExcelController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
