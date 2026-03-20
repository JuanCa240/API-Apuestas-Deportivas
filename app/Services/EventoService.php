<?php

namespace App\Services;

use App\Models\Evento;
use App\Models\Resultado;
use App\Models\Apuesta;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Servicio EventoService
 *
 * Este servicio maneja la lógica relacionada con los eventos deportivos.
 * Permite crear, consultar, actualizar y eliminar eventos, así como registrar resultados
 * y procesar las apuestas asociadas.
 *
 * Funciones:
 * - crear(array $data): Crea un nuevo evento en la base de datos con la información proporcionada.
 * - getAll(): Obtiene todos los eventos registrados.
 * - getById(int $id): Retorna un evento específico según su ID, lanzando excepción si no existe.
 * - actualizar(int $id, array $data): Actualiza los datos de un evento existente según su ID.
 * - show($id): Busca un evento por ID y lo retorna, lanzando excepción si no existe.
 * - destroy($id): Elimina un evento de la base de datos según su ID.
 * - update($id, $data): Actualiza campos específicos de un evento (deporte, equipos, fecha).
 * - registrarResultado($eventoId, $data): Registra el resultado de un evento, lo marca como finalizado,
 *   y procesa las apuestas asociadas, acreditando ganancias a los usuarios que acertaron.
 */

class EventoService
{

    public function crear(array $data)
    {
        return Evento::create($data);
    }

    public function getAll()
    {
        return Evento::all();
    }

    public function getById(int $id)
    {
        return Evento::findOrFail($id);
    }

    public function actualizar(int $id, array $data)
    {
        $evento = Evento::findOrFail($id);
        $evento->update($data);
        return $evento;
    }

    public function show($id)
    {
        $evento = Evento::find($id);
        if (!$evento) {
            throw new \Exception("Evento no encontrado");
        }

        return $evento;
    }

    public function destroy($id)
    {
        $evento = Evento::find($id);
        if (!$evento) {
            throw new \Exception("Evento no encontrado");
        }

        $evento->delete();
        return ['message' => 'Evento eliminado'];
    }

    public function update($id, $data)
    {
        $evento = Evento::find($id);
        if (!$evento) {
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

    public function registrarResultado($eventoId, $data)
    {
        $evento = Evento::find($eventoId);

        if (!$evento) {
            throw new \Exception("Evento no encontrado");
        }

        DB::beginTransaction();

        try {

            // guardar resultado
            Resultado::create([
                'evento_id' => $evento->id,
                'resultado' => $data['resultado']
            ]);

            // cerrar evento
            $evento->estado = "finalizado";
            $evento->save();

            // obtener apuestas del evento
            $apuestas = Apuesta::where('evento_id', $evento->id)->get();

            foreach ($apuestas as $apuesta) {

                if ($apuesta->tipo_apuesta == $data['resultado']) {

                    // apuesta ganada
                    $apuesta->estado = "ganada";

                    $user = User::find($apuesta->user_id);

                    $user->saldo += $apuesta->ganancia;
                    $user->save();
                } else {

                    $apuesta->estado = "perdida";
                }

                $apuesta->save();
            }

            DB::commit();

            return [
                "message" => "Resultado registrado y apuestas pagadas"
            ];
        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;
        }
    }
}
