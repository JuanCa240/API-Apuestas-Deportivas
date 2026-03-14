<?php

namespace App\Models;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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