<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class MasterBidang extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($masterBidang) {
            if ($masterBidang->kelompokBinaan()->exists()) {
                throw new Exception("Penghapusan data Master Bidang tidak bisa dilakukan karena data telah digunakan pada data Kelompok Binaan.");
            }
        });
    }

    /* =========================== RELATIONSHIPS */

    /* Kelompok Binaan Relationship (Pivot) */
    public function kelompokBinaan()
    {
        return $this->belongsToMany(KelompokBinaan::class, 'kelompok_binaan_bidang', 'master_bidang_id', 'kelompok_binaan_id');
    }
}
