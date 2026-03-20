<?php

namespace App\Services;

use App\Models\Cuota;


/**
 * Servicio CuotaService
 *
 * Este servicio maneja la lógica relacionada con las cuotas de los eventos.
 * Permite crear, consultar, actualizar y eliminar cuotas asociadas a un evento.
 *
 * Funciones:
 * - crear(array $data): Crea una nueva cuota en la base de datos con la información proporcionada.
 * - getByEvento(int $eventoId): Obtiene todas las cuotas asociadas a un evento específico.
 * - actualizar(int $id, array $data): Actualiza los datos de una cuota existente según su ID.
 * - eliminar(int $id): Elimina una cuota de la base de datos según su ID.
 */

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