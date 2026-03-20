<?php

namespace App\Enums;

/**
 * Enum EstadoApuesta
 *
 * Define los posibles estados de una apuesta dentro del sistema:
 * - PENDIENTE: La apuesta aún no ha sido resuelta.
 * - GANADA: La apuesta fue acertada por el usuario.
 * - PERDIDA: La apuesta no fue acertada.
 *
 * Se utiliza para mantener consistencia y claridad en el manejo de estados.
 */

enum EstadoApuesta: string{
    case PENDIENTE = 'pendiente';
    case GANADA = 'ganada';
    case PERDIDA = 'perdida';
}