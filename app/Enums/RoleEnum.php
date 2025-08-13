<?php

namespace App\Enums;

enum RoleEnum: string
{
    case DEVELOPER = 'developer';
    case SUPERADMIN = 'superadmin';

    public static function getID(string $role): int
    {
        return match ($role) {
            self::DEVELOPER => 1,
            self::SUPERADMIN => 2,
        };
    }
}
