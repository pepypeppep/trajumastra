<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MasterJenisAset extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($masterJenisAset) {
            if ($masterJenisAset->kelompokBinaan()->exists()) {
                throw new Exception("Penghapusan data Master Jenis Aset tidak bisa dilakukan karena data telah digunakan pada data Kelompok Binaan.");
            }
        });
    }

    // =========================== RELATIONSHIPS */
    /* Kelompok Binaan Relationship (Pivot) */
    public function kelompokBinaan(): BelongsToMany
    {
        return $this->belongsToMany(KelompokBinaan::class, 'kelompok_binaan_jenis_kolam', 'jenis_aset_id', 'kelompok_binaan_id');
    }
}
