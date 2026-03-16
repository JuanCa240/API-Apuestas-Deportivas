<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class SaldoService
{

    // Obtener saldo del usuario autenticado
    public function obtenerSaldo()
    {
        $user = auth()->user();

        return [
            "saldo" => $user->saldo
        ];
    }

    // Depositar dinero en la cuenta
    public function depositar($data)
    {
        /** @var User $user */
        $user = auth()->user();

        if(!isset($data['monto']) || $data['monto'] <= 0){
            throw new \Exception("Monto inválido");
        }

        DB::beginTransaction();

        try {

            $user->saldo += $data['monto'];
            $user->save();

            DB::commit();

            return [
                "message" => "Depósito realizado correctamente",
                "nuevo_saldo" => $user->saldo
            ];

        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;

        }
    }

    // Retirar dinero del saldo
    public function retirar($data)
    {
        /** @var User $user */
        $user = auth()->user();

        if(!isset($data['monto']) || $data['monto'] <= 0){
            throw new \Exception("Monto inválido");
        }

        if($user->saldo < $data['monto']){
            throw new \Exception("Saldo insuficiente");
        }

        DB::beginTransaction();

        try {

            $user->saldo -= $data['monto'];
            $user->save();

            DB::commit();

            return [
                "message" => "Retiro realizado correctamente",
                "nuevo_saldo" => $user->saldo
            ];

        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;

        }
    }
}