<?php

namespace App\Enums;

enum EstadoResultado: string{
    case LOCAL = 'local';
    case EMPATE = 'empate';
    case VISITANTE = 'visitante';
}