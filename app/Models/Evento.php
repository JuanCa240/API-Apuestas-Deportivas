<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}