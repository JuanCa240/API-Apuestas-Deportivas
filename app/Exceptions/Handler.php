<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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