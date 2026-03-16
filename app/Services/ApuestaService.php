<?php

namespace App\Services;

use App\Models\Apuesta;

class ApuestaService
{

    public function crearApuesta($data)
    {
        $user = auth()->user();
        $cuota = Cuota::find($data['cuota_id']);

        if (!$cuota) {
            throw new \Exception("Cuota no encontrada");
        }

        if ($user->saldo < $data['monto']) {
            throw new \Exception("Saldo insuficiente");
        }

        DB::beginTransaction();

        try {

            $user->saldo -= $data['monto'];
            $user->save();

            $apuesta = Apuesta::create([
                'user_id' => $user->id,
                'cuota_id' => $cuota->id,
                'monto' => $data['monto'],
                'estado' => 'pendiente',
                'ganancia' => $data['monto'] * $cuota->cuota
            ]);

            DB::commit();

            return $apuesta;
        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;
        }
    }

    public function misApuestas()
    {
        $user = auth()->user();

        return Apuesta::where('user_id', $user->id)->get();
    }

    public function detalleApuesta($id)
    {
        $user = auth()->user();

        $apuesta = Apuesta::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$apuesta) {
            throw new \Exception("Apuesta no encontrada");
        }

        return $apuesta;
    }

    public function cobrarApuesta(int $betId) {}
}
