<?php

namespace App\Services;

use App\Models\Evento;

class EventoService{

    public function getEventos(){
        return response()->json(Evento::all());
    }

    public function crearEvento(array $data){

        $evento = Evento::create([
            'deporte' => $data['deporte'],
            'equipo_local' => $data['equipo_local'],
            'equipo_visitante' => $data['equipo_visitante'],
            'fecha' => $data['fecha'],
            'estado' => 'pendiente'
        ]);

        return response()->json([
            'message' => 'Evento creado',
            'evento' => $evento
        ]);
    }
}