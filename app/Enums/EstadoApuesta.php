<?php

namespace App\Enums;

enum EstadoApuesta: string{
    case PENDIENTE = 'pendiente';
    case GANADA = 'ganada';
    case PERDIDA = 'perdida';
}