<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApuestaController extends Controller{
    public function store(Request $request)
    {
        return response()->json(
            $this->apuestaService->crearApuesta($request->all())
        );
    }

    public function misApuestas()
    {
        return response()->json(
             $this->apuestaService->misApuestas()
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->apuestaService->detalleApuesta($id)
        );
    }
}
