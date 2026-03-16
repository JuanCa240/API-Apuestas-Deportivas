<?php

namespace App\Services;

use App\Models\Apuesta;
use App\Models\Cuota;
use Illuminate\Support\Facades\DB;
use App\Enums\EstadoApuesta;

class ApuestaService
{

    public function crearApuesta($data)
    {
        $user = auth()->user();

        $cuota = Cuota::find($data['cuota_id']);

        if (!$cuota) {
            return response()->json([
                'message' => 'Cuota no encontrada'
            ], 404);
        }

        if ($user->saldo < $data['monto']) {
            return response()->json([
                'message' => 'Saldo insuficiente'
            ], 422);
        }

        DB::beginTransaction();

        try {

            // Descontar saldo
            $user->saldo -= $data['monto'];
            $user->save();

            // Crear apuesta
            $apuesta = Apuesta::create([
                'usuario_id' => $user->id,
                'evento_id' => $cuota->evento_id,
                'tipo_apuesta' => $cuota->tipo_apuesta,
                'monto' => $data['monto'],
                'cuota' => $cuota->cuota,
                'estado' => EstadoApuesta::PENDIENTE->value,
                'ganancia' => $data['monto'] * $cuota->cuota
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Apuesta creada correctamente',
                'apuesta' => $apuesta
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Error al crear la apuesta'
            ], 500);

        }
    }

    public function misApuestas()
    {
        $user = auth()->user();

        $apuestas = Apuesta::where('usuario_id', $user->id)->get();

        return response()->json($apuestas);
    }

    public function detalleApuesta($id)
    {
        $user = auth()->user();

        $apuesta = Apuesta::where('id', $id)
            ->where('usuario_id', $user->id)
            ->first();

        if (!$apuesta) {
            return response()->json([
                'message' => 'Apuesta no encontrada'
            ], 404);
        }

        return response()->json($apuesta);
    }

}