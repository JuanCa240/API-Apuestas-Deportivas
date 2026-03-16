<?php

namespace App\Services;

use App\Models\Evento;

class EventoService{

    public function crear(array $data){
        return Evento::create($data);
    }

    public function getAll(){
        return Evento::all();
    }

    public function getById(int $id){
        return Evento::findOrFail($id);
    }

    public function actualizar(int $id, array $data){
        $evento = Evento::findOrFail($id);
        $evento->update($data);
        return $evento;
    }

    public function show($id)
    {
        $evento = Evento::find($id);
            if(!$evento){
            throw new \Exception("Evento no encontrado");
        }

        return $evento;
    }

    public function destroy($id)
    {
        $evento = Evento::find($id);
        if(!$evento){
            throw new \Exception("Evento no encontrado");
        }

        $evento->delete();
        return ['message' => 'Evento eliminado'];
    }

    public function update($id, $data)
    {
        $evento = Evento::find($id);
            if(!$evento){
            throw new \Exception("Evento no encontrado");
       }

        $evento->update([
            'deporte' => $data['deporte'],
            'equipo_local' => $data['equipo_local'],
            'equipo_visitante' => $data['equipo_visitante'],
            'fecha' => $data['fecha']
        ]);

        return $evento;
    }

}