<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Clase Handler
 *
 * Se encarga de manejar las excepciones de la aplicación.
 * Extiende el manejador de excepciones de Laravel y permite:
 * - Definir excepciones que no deben reportarse.
 * - Proteger campos sensibles al mostrar errores.
 * - Registrar excepciones personalizadas.
 * - Retornar respuestas JSON para errores comunes (ej. 404: recurso no encontrado).
 */

class Handler extends ExceptionHandler{

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(){

        $this->reportable(function (Throwable $e) {
            //
        });

        // Manejo de error 404 para API
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'error' => 'Recurso no encontrado'
            ], 404);
        });
    }
}