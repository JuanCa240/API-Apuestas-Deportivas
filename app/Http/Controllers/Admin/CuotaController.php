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

    public function store(Request $request){

        $cuota = $this->cuotaService->crear($request->all());

        return response()->json([
            'message' => 'Cuota creada',
            'cuota' => $cuota
        ],201);
    }

    public function cuotasPorEvento($eventoId){

        $cuotas = $this->cuotaService->getByEvento($eventoId);

        return response()->json($cuotas);
    }

}