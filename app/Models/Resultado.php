<?php

namespace App\Models;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Modelo Resultado
 *
 * Representa el resultado de un evento deportivo en el sistema.
 * Cada resultado está asociado a un evento específico (relación 1:1).
 *
 * Atributos:
 * - $fillable: Define los campos que se pueden asignar masivamente (evento_id, resultado).
 *
 * Relaciones:
 * - evento(): Indica que un resultado pertenece a un evento (relación belongsTo).
 */

class Resultado extends Model{

    use HasFactory;

    protected $fillable = [
        'evento_id',
        'resultado',
    ];

    # Un resultado pertenece a un evento (Evento 1:1 Resultado)
    public function evento(){
        return $this->belongsTo(Evento::class);

    }

}