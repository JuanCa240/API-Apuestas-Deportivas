<?php

namespace App\Services;

use App\Models\User;
use App\Helpers\OtpHelper;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService{

    public function register(array $data){

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'saldo' => 0,
            'role' => 'usuario'
        ]);

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $user
        ]);
    }


    public function login(array $credentials){
        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json([
                'message' => 'Credenciales inválidas'
            ],401);
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


    public function verificarOtp($email, string $otp){

        $user = User::where('email',$email)->first();

        if(!$user){
            return response()->json([
                'message' => 'Usuario no encontrado'
            ],404);
        }

        if($user->otp_code !== $otp){
            return response()->json([
                'message' => 'OTP incorrecto'
            ],401);
        }

        if(OtpHelper::isExpired($user->otp_expiration)){
            return response()->json([
                'message' => 'OTP expirado'
            ],401);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Autenticación exitosa',
            'token' => $token,
            'user' => $user
        ]);
    }

}