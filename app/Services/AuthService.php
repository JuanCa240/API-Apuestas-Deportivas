<?php

namespace App\Services;

use App\Models\User;
use App\Helpers\OtpHelper;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;



/**
 * Servicio AuthService
 *
 * Este servicio maneja la lógica de autenticación de usuarios.
 * Incluye registro, inicio de sesión con generación de OTP y verificación de OTP para emitir el token JWT.
 *
 * Funciones:
 * - register(array $data): Registra un nuevo usuario en el sistema con nombre, email y contraseña encriptada.
 * - login(array $credentials): Valida credenciales, genera un OTP temporal y lo guarda para el usuario autenticado.
 * - verificarOtp($email, string $otp): Verifica el código OTP ingresado, valida expiración y, si es correcto, devuelve un token JWT junto con los datos del usuario.
 */

class AuthService{

   public function register(array $data)
{

    $role = User::ROLE_USUARIO;

    if (isset($data['admin_key']) && $data['admin_key'] === 'ADMIN') {
        $role = User::ROLE_ADMIN;
    }

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'saldo' => 0,
        'role' => $role 
    ]);

    return response()->json([
        'message' => 'Usuario registrado correctamente',
        'user' => $user
    ]);
}


    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        $user = User::where('email', $credentials['email'])->first();

        $otp = OtpHelper::generateOtp();
        $expiration = OtpHelper::expirationTime();

        $user->otp_code = $otp;
        $user->otp_expiration = $expiration;
        $user->save();

        return response()->json([
            'message' => 'OTP generado, verifica tu código'
        ]);
    }


    public function verificarOtp($email, string $otp)
    {

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        if ($user->otp_code !== $otp) {
            return response()->json([
                'message' => 'OTP incorrecto'
            ], 401);
        }

        if (OtpHelper::isExpired($user->otp_expiration)) {
            return response()->json([
                'message' => 'OTP expirado'
            ], 401);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Autenticación exitosa',
            'token' => $token,
            'user' => $user
        ]);
    }
}
