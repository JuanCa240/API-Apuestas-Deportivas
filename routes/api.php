<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\EventoController;
use App\Http\Controllers\Admin\CuotaController;

Route::prefix('auth')->group(function(){

    // AUTH
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);
    Route::post('/verify-otp', [AuthController::class,'verificarOtp']);

});

   // MIDDLEWARE

Route::middleware('auth:api')->group(function(){

    Route::get('/me', [AuthController::class,'me']);

    // EVENTOS
    Route::get('/eventos',[EventoController::class,'index']);
    Route::post('/eventos',[EventoController::class,'store']);
    Route::get('/eventos/{id}', [EventoController::class,'show']);
    Route::put('/eventos/{id}', [EventoController::class,'update']);
    Route::delete('/eventos/{id}', [EventoController::class,'destroy']);
    Route::post('/apuestas',[ApuestaController::class,'store']);
    Route::get('/mis-apuestas',[ApuestaController::class,'misApuestas']);
    Route::get('/apuestas/{id}',[ApuestaController::class,'show']);
    Route::put('/eventos/{id}/resultado',[EventoController::class,'resultado']);


    // CUOTAS
    Route::post('/cuotas',[CuotaController::class,'store']);
    Route::get('/eventos/{evento}/cuotas',[CuotaController::class,'cuotasPorEvento']);
    Route::put('/cuotas/{id}',[CuotaController::class,'update']);
    Route::delete('/cuotas/{id}',[CuotaController::class,'destroy']);

});