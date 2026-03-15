<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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