<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kalurahan extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($kalurahan) {
            if ($kalurahan->pelakuUsaha()->exists()) {
                throw new Exception("Penghapusan data Kalurahan tidak bisa dilakukan karena data telah digunakan pada data Pelaku Usaha.");
            }
            if ($kalurahan->kelompokBinaan()->exists()) {
                throw new Exception("Penghapusan data Kalurahan tidak bisa dilakukan karena data telah digunakan pada data Kelompok Binaan.");
            }
            if ($kalurahan->kelompokUsaha()->exists()) {
                throw new Exception("Penghapusan data Kalurahan tidak bisa dilakukan karena data telah digunakan pada data Kelompok Usaha.");
            }
        });
    }

    /* =========================== RELATIONSHIPS */

    /**
     * Get the kecamatan that owns the Kalurahan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /* Pelaku Usaha Relationship */
    public function pelakuUsaha()
    {
        return $this->hasMany(PelakuUsaha::class, 'kalurahan_id');
    }

    /* Kelompok Binaan Relationship */
    public function kelompokBinaan()
    {
        return $this->hasMany(KelompokBinaan::class, 'kalurahan_id');
    }

    /* Kelompok Usaha Relationship */
    public function kelompokUsaha()
    {
        return $this->hasMany(KelompokUsaha::class, 'kalurahan_id');
    }
}
