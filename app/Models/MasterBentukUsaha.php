<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class MasterBentukUsaha extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($masterBentukUsaha) {
            if ($masterBentukUsaha->pelakuUsaha()->exists()) {
                throw new Exception("Penghapusan data Master Bentuk Usaha tidak bisa dilakukan karena data telah digunakan pada data Pelaku Usaha.");
            }
            if ($masterBentukUsaha->kelompokUsaha()->exists()) {
                throw new Exception("Penghapusan data Master Bentuk Usaha tidak bisa dilakukan karena data telah digunakan pada data Kelompok Usaha.");
            }
        });
    }

    /* =========================== RELATIONSHIPS */
    /* Pelaku Usaha Relationship */
    public function pelakuUsaha()
    {
        return $this->hasMany(PelakuUsaha::class, 'bentuk_usaha_id');
    }

    /* Kelompok Usaha Relationship */
    public function kelompokUsaha()
    {
        return $this->hasMany(KelompokUsaha::class, 'bentuk_usaha_id');
    }
}
