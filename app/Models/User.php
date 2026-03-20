<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

 
class User extends Authenticatable implements JWTSubject{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_USUARIO = 'usuario';
   

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
