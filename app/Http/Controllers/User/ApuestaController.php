<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApuestaService;

/**
 * Controlador ApuestaController
 *
 * Maneja las operaciones relacionadas con las apuestas de los usuarios.
 * Utiliza el servicio ApuestaService para:
 * - Crear nuevas apuestas.
 * - Consultar las apuestas del usuario autenticado.
 * - Ver el detalle de una apuesta específica.
 *
 * Todas las respuestas se retornan en formato JSON.
 */

class ApuestaController extends Controller
{

    private $apuestaService;
    public function __construct(ApuestaService $apuestaService){
        $this->apuestaService = $apuestaService;
    }

    public function store(Request $request){
        return $this->apuestaService->crearApuesta($request->all());
    }

    public function misApuestas(){
        return $this->apuestaService->misApuestas();
    }

    public function show($id){
        return $this->apuestaService->detalleApuesta($id);
    }
}
