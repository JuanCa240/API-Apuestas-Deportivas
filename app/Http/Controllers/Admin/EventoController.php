<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EventoService;

class EventoController extends Controller
{
    private EventoService $eventoService;

    public function __construct(EventoService $eventoService){
        $this->eventoService = $eventoService;
    }

    public function index()
    {
        return response()->json(
            $this->eventoService->getAll()
        );
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Evento creado',
            'evento' => $this->eventoService->crear($request->all())
        ],201);
    }

    public function show($id)
    {
        return response()->json(
            $this->eventoService->show($id)
        );
    }

    public function update(Request $request, $id)
    {
        return response()->json(
            $this->eventoService->update($id, $request->all())
        );
    }

    public function destroy($id)
    {
        return response()->json(
            $this->eventoService->destroy($id)
        );
    }
}