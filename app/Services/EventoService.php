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

}