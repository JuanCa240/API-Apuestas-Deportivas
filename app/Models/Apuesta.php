<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Apuesta
 *
 * Representa una apuesta realizada por un usuario sobre un evento deportivo.
 * Contiene información sobre el usuario que la realizó, el evento, el tipo de apuesta,
 * el monto apostado, la cuota, el estado y la posible ganancia.
 *
 * Atributos:
 * - $fillable: Define los campos que se pueden asignar masivamente (usuario_id, evento_id, tipo_apuesta, monto, cuota, estado, ganancia).
 * - $casts: Convierte automáticamente los campos numéricos (monto, cuota, ganancia) a tipo float.
 *
 * Relaciones:
 * - usuario(): Una apuesta pertenece a un usuario
 * - evento(): Una apuesta pertenece a un evento 
 */

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