<?php

use App\Http\Controllers\TruckDriver\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TruckDriver\Auth\ConfirmablePasswordController;
use App\Http\Controllers\TruckDriver\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\TruckDriver\Auth\EmailVerificationPromptController;
use App\Http\Controllers\TruckDriver\Auth\NewPasswordController;
use App\Http\Controllers\TruckDriver\Auth\PasswordResetLinkController;
use App\Http\Controllers\TruckDriver\Auth\RegisteredUserController;
use App\Http\Controllers\TruckDriver\Auth\VerifyEmailController;
use App\Http\Controllers\TruckDriver\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\TruckDriver;
use App\Http\Controllers\TruckDriver\ViajesController;
use App\Http\Controllers\TruckDriver\SolicitudesController;

Route::prefix('truck_driver')->name('truck_driver.')->group(function () {

    // Rutas asociadas al logueo

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('auth:truck_driver')
        ->name('dashboard');

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware('guest:truck_driver')
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest:truck_driver');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest:truck_driver')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest:truck_driver');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest:truck_driver')
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest:truck_driver')
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware('guest:truck_driver')
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest:truck_driver')
        ->name('password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->middleware('auth:truck_driver')
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth:truck_driver', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth:truck_driver', 'throttle:6,1'])
        ->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->middleware('auth:truck_driver')
        ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware('auth:truck_driver');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:truck_driver')
        ->name('logout');

    // Rutas sobre el chofer
    Route::get('/', [DashboardController::class, 'index'])
        ->middleware('auth:truck_driver');

    // Rutas sobre las solicitudes
    Route::get('solicitudes', [SolicitudesController::class, 'index'])->middleware('auth:truck_driver')->name('solicitudes.index');
    Route::put('solicitudes/{id}', [SolicitudesController::class, 'crearViaje'])->middleware('auth:truck_driver')->name('crearViaje');
    Route::delete('solicitudes/{id}', [SolicitudesController::class, 'destroy'])->middleware('auth:truck_driver')->name('solicitudes.destroy');

    // Rutas sobre los viajes
    Route::get('viajes', [ViajesController::class, 'index'])->middleware('auth:truck_driver');
    Route::get('viajes/{id}', [ViajesController::class, 'showViaje'])->middleware('auth:truck_driver');
    Route::get('viajes/b/{id}', [ViajesController::class, 'showViajePartTwo'])->middleware('auth:truck_driver');
    Route::post('viajes/b/{id}', [ViajesController::class, 'storeCombustible'])->middleware('auth:truck_driver')->name('combustible');
    Route::put('viajes/{id}', [ViajesController::class, 'updateViaje'])->middleware('auth:truck_driver');
    Route::put('viajes/b/{id}', [ViajesController::class, 'updateViajeSecondPart'])->middleware('auth:truck_driver')->name('viaje');
    Route::get('viajes/image/{id}', [ViajesController::class, 'showImage'])->middleware('auth:truck_driver');
    Route::put('viajes/image/{id}', [ViajesController::class, 'storeImage'])->middleware('auth:truck_driver');

});
