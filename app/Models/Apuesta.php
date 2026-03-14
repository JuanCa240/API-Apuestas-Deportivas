<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apuesta extends Model{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'evento_id',
        'tipo_apuesta',
        'monto',
        'cuota',
        'estado',
        'ganancia'
    ];

    protected $casts = [
        'monto' => 'float',
        'cuota' => 'float',
        'ganancia' => 'float',
    ];

    // Relación con Usuario (User 1:N Apuestas)
    public function usuario(){
        return $this->belongsTo(User::class);
    }

    // Relación con Evento (Evento 1:N Apuestas)
    public function evento(){
        return $this->belongsTo(Evento::class);
    }
}