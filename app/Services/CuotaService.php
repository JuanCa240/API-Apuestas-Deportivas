<?php

namespace App\Services;

use App\Models\Cuota;

class CuotaService{

    public function crear(array $data){
        return Cuota::create($data);
    }

    public function getByEvento(int $eventoId){
        return Cuota::where('evento_id', $eventoId)->get();
    }

    public function actualizar(int $id, array $data){
        $cuota = Cuota::findOrFail($id);
        $cuota->update($data);
        return $cuota;
    }

    public function eliminar(int $id){
        $cuota = Cuota::findOrFail($id);
        $cuota->delete();
        return true;
    }

}