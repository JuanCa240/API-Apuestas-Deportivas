<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\AuthService;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
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

    public function verificarOtp(Request $request)
    {
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

    public function me()
    {
        return response()->json(auth('api')->user());
    }
}
