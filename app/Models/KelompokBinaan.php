<?php

namespace App\Models;

use App\Models\Kalurahan;
use App\Models\PelakuUsaha;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KelompokBinaan extends Model
{
    protected $guarded = ['id'];

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
    
    /* Jenis Usaha (Pivot) */
    public function jenis_usahas(): BelongsToMany
    {
        return $this->belongsToMany(MasterJenisUsaha::class, 'kelompok_binaan_jenis_usaha', 'kelompok_binaan_id', 'jenis_usaha_id');
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

}
