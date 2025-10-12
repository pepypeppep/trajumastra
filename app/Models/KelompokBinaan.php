<?php

namespace App\Models;

use Exception;
use App\Models\Kalurahan;
use App\Models\PelakuUsaha;
use App\Models\MasterBidang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KelompokBinaan extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($kelompokBinaan) {
            // Validation existing child datas before delete
            if ($kelompokBinaan->pelakuUsaha()->exists()) {
                throw new Exception("Penghapusan data Kelompok Binaan tidak bisa dilakukan karena data telah digunakan pada data Pelaku Usaha.");
            }
        });
    }

    /* ============================= GENERAL RELATIONSHIPS */

    /* Pelaku Usaha */
    public function pelakuUsaha(): HasMany
    {
        return $this->hasMany(PelakuUsaha::class);
    }

    /* Kalurahan */
    public function kalurahan(): BelongsTo
    {
        return $this->belongsTo(Kalurahan::class);
    }

    /* Kecamatan */
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /* =========================== POKDAKAN RELATIONSHIPS */

    /* Jenis Ikan (Pivot) */
    public function jenis_ikans(): BelongsToMany
    {
        return $this->belongsToMany(MasterJenisIkan::class, 'kelompok_binaan_jenis_ikan', 'kelompok_binaan_id', 'jenis_ikan_id');
    }

    /* Jenis Kolam (Pivot) */
    public function jenis_kolams(): BelongsToMany
    {
        return $this->belongsToMany(MasterJenisAset::class, 'kelompok_binaan_jenis_kolam', 'kelompok_binaan_id', 'jenis_aset_id');
    }

    /* =========================== POKLASHAR RELATIONSHIPS */

    /* Jenis Usaha (Pivot) */
    public function jenis_usahas(): BelongsToMany
    {
        return $this->belongsToMany(MasterJenisUsaha::class, 'kelompok_binaan_jenis_usaha', 'kelompok_binaan_id', 'jenis_usaha_id');
    }

    /* =========================== POKMASWAS RELATIONSHIPS */
    /* Bidang (Pivot) */
    public function bidangs(): BelongsToMany
    {
        return $this->belongsToMany(MasterBidang::class, 'kelompok_binaan_bidang', 'kelompok_binaan_id', 'master_bidang_id');
    }

}
