<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * Modelo User
 *
 * Representa a los usuarios del sistema, incluyendo autenticación, roles y manejo de OTP.
 * Implementa la interfaz JWTSubject para generar tokens JWT personalizados.
 *
 * Atributos:
 * - $fillable: Define los campos que se pueden asignar masivamente (name, email, password, saldo, role, otp_code, otp_expiration).
 * - $hidden: Oculta campos sensibles al serializar (password, remember_token, otp_code).
 * - $casts: Convierte automáticamente ciertos campos a tipos específicos (email_verified_at y otp_expiration como datetime).
 *
 * Funciones:
 * - getJWTIdentifier(): Retorna el identificador único del usuario para el token JWT.
 * - getJWTCustomClaims(): Agrega el rol del usuario como claim personalizado en el token JWT.
 * - isAdmin(): Verifica si el usuario tiene rol de administrador.
 * - isUser(): Verifica si el usuario tiene rol de usuario estándar.
 */

 
class User extends Authenticatable implements JWTSubject{
    use HasApiTokens, HasFactory, Notifiable;
   

    protected $fillable = [
        'name',
        'email',
        'password',
        'saldo',
        'role',
        'otp_code',
        'otp_expiration'
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code'
    ];

   
    # Manejo correcto de fechas del OTP
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expiration' => 'datetime'
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    # El token incluya el rol automaticamente
    public function getJWTCustomClaims(){
        return ['role' => $this->role];
    }

    public function isAdmin(): bool {
        return $this-> role === Role::ADMIN->value;
    }

    public function isUser(): bool{
        return $this-> role === Role::USUARIO->value;
    }
}
