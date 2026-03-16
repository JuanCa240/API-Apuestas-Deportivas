<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\EventoController;

Route::prefix('auth')->group(function(){

    // AUTH
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);
    Route::post('/verify-otp', [AuthController::class,'verificarOtp']);

});

Route::middleware('auth:api')->group(function(){

    Route::get('/me', [AuthController::class,'me']);

    Route::get('/eventos',[EventoController::class,'index']);
    Route::post('/eventos',[EventoController::class,'store']);
    Route::get('/eventos/{id}', [EventoController::class,'show']);
    Route::put('/eventos/{id}', [EventoController::class,'update']);
    Route::delete('/eventos/{id}', [EventoController::class,'destroy']);


});