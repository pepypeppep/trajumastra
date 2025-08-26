<?php
namespace App\Enums;

enum JenisPenyuluhanStatusEnum: string
{
    case NEW = 'new';
    case VERIFIED = 'verified';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'Baru',
            self::VERIFIED => 'Terverifikasi',
            self::REJECTED => 'Ditolak',
        };
    }
}