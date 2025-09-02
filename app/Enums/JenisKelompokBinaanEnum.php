<?php
namespace App\Enums;

enum JenisKelompokBinaanEnum: string
{
    case POKLASHAR = 'poklashar'; // Kelompok Pembudidaya Ikan
    case POKDAKAN = 'pokdakan'; // Kelompok Pengolah dan Pemasar
    case POKMASWAS = 'pokmaswas'; // Kelompok Masyarakat & Pengawas
    case KUB = 'kub'; // Kelompok Usaha Bersama
    case KUGAR = 'kugar'; // Kelompok Usaha Garam Rakyat
    case POKWISRI = 'pokwisri'; // Kelompok Wisata Bahari

    public function label(): string
    {
        return match ($this) {
            self::POKLASHAR => 'Kelompok Pembudidaya Ikan',
            self::POKDAKAN => 'Kelompok Pengolah dan Pemasar',
            self::POKMASWAS => 'Kelompok Masyarakat & Pengawas',
            self::KUB => 'Kelompok Usaha Bersama',
            self::KUGAR => 'Kelompok Usaha Garam Rakyat',
            self::POKWISRI => 'Kelompok Wisata Bahari',
        };
    }
}