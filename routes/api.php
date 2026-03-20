<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\EventoController;
use App\Http\Controllers\Admin\CuotaController;
use App\Http\Controllers\Admin\ResultadoController;
use App\Http\Controllers\User\ApuestaController;
use App\Http\Controllers\User\SaldoController;


Route::prefix('auth')->group(function () {
/**
 * Archivo de rutas API
 *
 * Define los endpoints principales de la aplicación.
 * Incluye:
 * - Autenticación (registro, login, verificación OTP, perfil).
 * - Gestión de eventos y cuotas.
 * - Manejo de apuestas de usuarios.
 * - Operaciones de saldo (consultar, depositar, retirar).
 *
 * Todas las rutas protegidas requieren autenticación mediante middleware `auth:api`.
 */

Route::prefix('auth')->group(function(){

    // AUTH
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/verify-otp', [AuthController::class, 'verificarOtp']);
});

// MIDDLEWARE
Route::middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/eventos', [EventoController::class, 'index']);
    Route::get('/eventos/{id}', [EventoController::class, 'show']);

    // USUARIO 
    Route::middleware('role:' . User::ROLE_USUARIO)->group(function () {

        // APUESTAS
        Route::post('/apuestas', [ApuestaController::class, 'store']);
        Route::get('/mis-apuestas', [ApuestaController::class, 'misApuestas']);
        Route::get('/apuestas/{id}', [ApuestaController::class, 'show']);

        // SALDO
        Route::get('/saldo', [SaldoController::class, 'verSaldo']);
        Route::post('/depositar', [SaldoController::class, 'depositar']);
        Route::post('/retirar', [SaldoController::class, 'retirar']);
    });

    // ADMIN 
    Route::middleware('role:' . User::ROLE_ADMIN)->group(function () {

        // EVENTOS
        Route::post('/eventos', [EventoController::class, 'store']);
        Route::put('/eventos/{id}', [EventoController::class, 'update']);
        Route::delete('/eventos/{id}', [EventoController::class, 'destroy']);

        // CUOTAS
        Route::post('/cuotas', [CuotaController::class, 'store']);
        Route::get('/eventos/{evento}/cuotas', [CuotaController::class, 'cuotasPorEvento']);
        Route::put('/cuotas/{id}', [CuotaController::class, 'update']);
        Route::delete('/cuotas/{id}', [CuotaController::class, 'destroy']);

        // RESULTADOS
        Route::put('/eventos/{id}/resultado', [ResultadoController::class, 'registrarResultado']);
    });
});
