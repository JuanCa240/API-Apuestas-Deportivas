<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\AuthService;

/**
 * Controlador AuthController
 *
 * Maneja la autenticación de usuarios en la aplicación.
 * Utiliza el servicio AuthService para:
 * - Registrar nuevos usuarios.
 * - Iniciar sesión con credenciales.
 * - Verificar códigos OTP para completar el login.
 * - Obtener información del usuario autenticado.
 *
 * Todas las respuestas se retornan en formato JSON.
 */

class AuthController extends Controller{

    protected $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],422);
        }

        return $this->authService->register($request->all());
    }

    public function login(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validador->fails()) {
            return response()->json([
                'errors' => $validador->errors()
            ], 422);
        }

        return $this->authService->login($request->only('email', 'password'));
    }

    public function verificarOtp(Request $request){
        $validador = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        if ($validador->fails()) {
            return response()->json([
                'errors' => $validador->errors()
            ], 422);
        }

        return $this->authService->verificarOtp(
            $request->email,
            $request->otp
        );
    }

    public function me(){
        return response()->json(auth('api')->user());
    }
}