<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventoService;

class EventoController extends Controller{

    protected $eventoService;

    public function __construct(EventoService $eventoService){
        $this->eventoService = $eventoService;
    }

    public function index(){
        return $this->eventoService->getEventos();
    }

    public function store(Request $request){
        return $this->eventoService->crearEvento($request->all());
    }

}