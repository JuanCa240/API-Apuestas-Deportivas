<?php

namespace App\Enums;

/**
 * Enum Role
 *
 * Define los roles principales de los usuarios dentro del sistema:
 * - ADMIN: Usuario con privilegios administrativos.
 * - USUARIO: Usuario estándar del sistema.
 *
 * Se utiliza para controlar permisos y accesos según el rol asignado.
 */


enum Role:string{
    case ADMIN = 'admin';
    case USUARIO = 'usuario';
}