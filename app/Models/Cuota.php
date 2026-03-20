<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Modelo Cuota
 *
 * Representa la cuota asociada a un evento deportivo dentro del sistema.
 * Cada cuota define un tipo de apuesta y el valor de la cuota correspondiente.
 *
 * Atributos:
 * - $fillable: Define los campos que se pueden asignar masivamente (evento_id, tipo_apuesta, cuota).
 * - $casts: Convierte automáticamente el campo 'cuota' a tipo float.
 *
 * Relaciones:
 * - evento(): Indica que una cuota pertenece a un evento (relación belongsTo).
 */


class Cuota extends Model{
    use HasFactory;

    protected $fillable = [
        'evento_id',
        'tipo_apuesta',
        'cuota'
    ];

    protected $casts = [
        'cuota' => 'float'
    ];

    // La cuota pertenece a un evento
    public function evento(){
        return $this->belongsTo(Evento::class);
    }
}