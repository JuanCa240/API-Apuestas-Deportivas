<?php

namespace App\Enums;

/**
 * Enum EstadoResultado
 *
 * Define los posibles resultados de un evento deportivo:
 * - LOCAL: El equipo local gana.
 * - EMPATE: El evento termina en empate.
 * - VISITANTE: El equipo visitante gana.
 *
 * Se utiliza para mantener consistencia y claridad en el manejo de resultados.
 */

enum EstadoResultado: string{
    case LOCAL = 'local';
    case EMPATE = 'empate';
    case VISITANTE = 'visitante';
}