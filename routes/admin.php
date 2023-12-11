<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SueldoController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->middleware('auth:admin');

    // Rutas asociadas al logueo

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware('guest:admin')
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest:admin');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest:admin')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest:admin');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest:admin')
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest:admin')
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware('guest:admin')
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest:admin')
        ->name('password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->middleware('auth:admin')
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth:admin', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth:admin', 'throttle:6,1'])
        ->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->middleware('auth:admin')
        ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware('auth:admin');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:admin')
        ->name('logout');

    // Rutas asociadas al controlador del admin

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('auth:admin')
        ->name('dashboard');

    Route::get('create', [DashboardController::class, 'createViajeInicial'])
        ->middleware('auth:admin')
        ->name('create');

    Route::post('create', [DashboardController::class, 'storeViajeInicial'])
        ->middleware('auth:admin')
        ->name('store');

    Route::get('viajes', [DashboardController::class, 'createSolicitudes'])
        ->middleware('auth:admin')
        ->name('create2');    

    Route::get('viajes/{id}', [DashboardController::class, 'getInfoViajeInicial'])
        ->middleware('auth:admin')
        ->name('create3');  

    Route::post('viajes/{id}', [DashboardController::class, 'storeSolicitudes'])
        ->middleware('auth:admin')
        ->name('store2');    

    Route::get('show', [DashboardController::class, 'showViajes'])
        ->middleware('auth:admin')
        ->name('show');   

    Route::put('update', [DashboardController::class, 'updateViaje'])
        ->middleware('auth:admin')
        ->name('update');  

    Route::delete('cancelar/{id}', [DashboardController::class, 'cancelarViaje'])
        ->middleware('auth:admin')
        ->name('cancelar');

    Route::get('planilla', [DashboardController::class, 'indexPlanilla'])
    ->middleware('auth:admin');

    Route::get('planilla/{id}', [DashboardController::class, 'showPlanilla'])
    ->middleware('auth:admin');


    // Rutas asociadas al sueldo

    Route::get('sueldo', [SueldoController::class, 'index'])
    ->middleware('auth:admin');
    
    Route::get('sueldo/datos', [SueldoController::class, 'showDatosBasicos'])
    ->middleware('auth:admin');

    Route::put('sueldo/datos', [SueldoController::class, 'updateDatosBasicos'])
    ->middleware('auth:admin');
    
    Route::get('sueldo/calcular', [SueldoController::class, 'indexCalcularSueldo'])
    ->middleware('auth:admin');

    Route::get('sueldo/calcular/{id}', [SueldoController::class, 'showCalcularSueldo'])
    ->middleware('auth:admin');

    Route::post('sueldo/calcular/{id}', [SueldoController::class, 'updateDatos'])
    ->middleware('auth:admin');

    Route::post('sueldo/calcular/{id}/2', [SueldoController::class, 'updateDatosTabla2'])
    ->middleware('auth:admin');

    Route::post('sueldo/calcular/{id}/3', [SueldoController::class, 'updateDatosTabla3'])
    ->middleware('auth:admin');

    Route::post('sueldo/calcular/{id}/4', [SueldoController::class, 'agregarNuevaFila'])
    ->middleware('auth:admin');
});
