<?php

namespace App\Enums;

enum RoleEnum: string
{
    case DEVELOPER = 'Developer';
    case SUPERADMIN = 'Superadmin';
    case ADMIN = 'Admin';
    case ADMIN_TEKNIS = 'Admin teknis';
    case KABID_ESELON_III = 'Kabid Eselon III';
    case SEKDIN = 'Sekdin';
    case KEPALA_DINAS = 'Kepala Dinas';
    case PETUGAS_TPI = 'Petugas TPI';
    case PENYULUH = 'Penyuluh';
    case PELAKU_USAHA = 'Pelaku Usaha';

    public static function getID(string $role): int
    {
        return match ($role) {
            self::DEVELOPER => 1,
            self::SUPERADMIN => 2,
            self::ADMIN => 3,
            self::ADMIN_TEKNIS => 4,
            self::KABID_ESELON_III => 5,
            self::SEKDIN => 6,
            self::KEPALA_DINAS => 7,
            self::PETUGAS_TPI => 8,
            self::PENYULUH => 9,
            self::PELAKU_USAHA => 10,
        };
    }
}
