<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MasterJenisUsaha extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($masterJenisUsaha) {
            if ($masterJenisUsaha->pelakuUsaha()->exists()) {
                throw new Exception("Penghapusan data Master Jenis Usaha tidak bisa dilakukan karena data telah digunakan pada data Pelaku Usaha.");
            }
            if ($masterJenisUsaha->kelompokBinaan()->exists()) {
                throw new Exception("Penghapusan data Master Jenis Usaha tidak bisa dilakukan karena data telah digunakan pada data Kelompok Binaan.");
            }
        });
    }

    /* =========================== RELATIONSHIPS */
    /* Pelaku Usaha Relationship */
    public function pelakuUsaha()
    {
        return $this->hasMany(PelakuUsaha::class, 'jenis_usaha_id');
    }

    /* Kelompok Binaan Relationship (Pivot) */
    public function kelompokBinaan(): BelongsToMany
    {
        return $this->belongsToMany(KelompokBinaan::class, 'kelompok_binaan_jenis_usaha', 'jenis_usaha_id', 'kelompok_binaan_id');
    }
}
