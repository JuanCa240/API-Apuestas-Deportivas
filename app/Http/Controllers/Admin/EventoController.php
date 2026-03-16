<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Services\EventoService;

class EventoController extends Controller
{
    private $eventoService;

    public function __construct(EventoService $eventoService)
    {
        $this->eventoService = $eventoService;
    }

    public function index()
    {
        return Evento::all();
    }

    public function store(Request $request)
    {
        $evento = Evento::create([
            'deporte' => $request->deporte,
            'equipo_local' => $request->equipo_local,
            'equipo_visitante' => $request->equipo_visitante,
            'fecha' => $request->fecha,
            'estado' => 'pendiente'
        ]);

        return response()->json([
            'message' => 'Evento creado',
            'evento' => $evento
        ], 201);
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
