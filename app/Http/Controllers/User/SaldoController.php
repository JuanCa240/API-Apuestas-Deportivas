<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SaldoService;

/**
 * Controlador SaldoController
 *
 * Maneja las operaciones relacionadas con el saldo de los usuarios.
 * Utiliza el servicio SaldoService para:
 * - Consultar el saldo actual.
 * - Realizar depósitos.
 * - Efectuar retiros.
 *
 * Todas las respuestas se retornan en formato JSON.
 */

class SaldoController extends Controller{
    private $saldoService;

    public function __construct(SaldoService $saldoService)
    {
        $this->saldoService = $saldoService;
    }

    public function saldo()
    {
        return response()->json(
            $this->saldoService->obtenerSaldo()
        );
    }

    public function depositar(Request $request)
    {
        return response()->json(
            $this->saldoService->depositar($request->all())
        );
    }

    public function retirar(Request $request)
    {
        return response()->json(
            $this->saldoService->retirar($request->all())
        );
    }
}