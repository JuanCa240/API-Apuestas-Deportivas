<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CuotaService;

class CuotaController extends Controller{

    private CuotaService $cuotaService;

    public function __construct(CuotaService $cuotaService){
        $this->cuotaService = $cuotaService;
    }

    // Crear cuota
    public function store(Request $request){

        $cuota = $this->cuotaService->crear($request->all());

        return response()->json([
            'message' => 'Cuota creada',
            'cuota' => $cuota
        ],201);
    }

    // Obtener cuotas por evento
    public function cuotasPorEvento($eventoId){

        $cuotas = $this->cuotaService->getByEvento($eventoId);

        return response()->json($cuotas);
    }

    // ACTUALIZAR CUOTA
    public function update(Request $request, $id){

        $cuota = $this->cuotaService->actualizar($id, $request->all());

        return response()->json([
            'message' => 'Cuota actualizada',
            'cuota' => $cuota
        ]);
    }

    // ELIMINAR CUOTA
    public function destroy($id){

        $this->cuotaService->eliminar($id);

        return response()->json([
            'message' => 'Cuota eliminada correctamente'
        ]);
    }

}