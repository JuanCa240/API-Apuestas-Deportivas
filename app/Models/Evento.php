<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Evento
 *
 * Representa un evento deportivo dentro del sistema.
 * Contiene información sobre el deporte, equipos participantes, fecha y estado del evento.
 *
 * Atributos:
 * - $fillable: Define los campos que se pueden asignar masivamente (deporte, equipo_local, equipo_visitante, fecha, estado).
 * - $casts: Convierte automáticamente el campo 'fecha' a tipo datetime.
 *
 * Relaciones:
 * - apuestas(): Un evento puede tener muchas apuestas asociadas (relación hasMany).
 * - resultado(): Un evento tiene un único resultado asociado (relación hasOne).
 * - cuotas(): Un evento puede tener múltiples cuotas asociadas (relación hasMany).
 */

class Evento extends Model{
    use HasFactory;

    protected $fillable = [
        'deporte',
        'equipo_local',
        'equipo_visitante',
        'fecha',
        'estado'
    ];

    protected $casts = [
        'fecha' => 'datetime'
    ];

    // Un evento puede tener muchas apuestas
    public function apuestas(){
        return $this->hasMany(Apuesta::class);
    }

    // Un evento tiene un resultado
    public function resultado(){
        return $this->hasOne(Resultado::class);
    }

    public function cuotas(){
        return $this->hasMany(Cuota::class);
    }
}