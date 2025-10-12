<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MasterJenisIkan extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['imageUrl', 'economicLevel', 'economicLabel'];

    protected static function booted()
    {
        static::deleting(function ($masterJenisIkan) {
            if ($masterJenisIkan->harga_ikan()->exists()) {
                throw new Exception("Penghapusan data Master Jenis Ikan tidak bisa dilakukan karena data telah digunakan pada data Harga Ikan.");
            }
            if ($masterJenisIkan->retribusi()->exists()) {
                throw new Exception("Penghapusan data Master Jenis Ikan tidak bisa dilakukan karena data telah digunakan pada data Master Retribusi.");
            }
            if ($masterJenisIkan->uptds()->exists()) {
                throw new Exception("Penghapusan data Master Jenis Ikan tidak bisa dilakukan karena data telah digunakan pada data UPTD.");
            }
            if ($masterJenisIkan->kelompokBinaan()->exists()) {
                throw new Exception("Penghapusan data Master Jenis Ikan tidak bisa dilakukan karena data telah digunakan pada data Kelompok Binaan.");
            }
        });
    }

    /**
     * The uptds that belong to the MasterJenisIkan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function uptds(): BelongsToMany
    {
        return $this->belongsToMany(Uptd::class, 'uptd_jenis_ikan', 'jenis_ikan_id', 'uptd_id');
    }

    /**
     * Get all of the harga_ikan for the MasterJenisIkan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function harga_ikan(): HasOne
    {
        return $this->hasOne(HargaIkan::class, 'jenis_ikan_id');
    }

    /* Kelompok Binaan Relationship (Pivot) */
    public function kelompokBinaan(): BelongsToMany
    {
        return $this->belongsToMany(KelompokBinaan::class, 'kelompok_binaan_jenis_ikan', 'jenis_ikan_id', 'kelompok_binaan_id');
    }

    /* Master Retribusi Relationship */
    public function retribusi(): hasMany
    {
        return $this->hasMany(MasterRetribusi::class, 'id_jenis_ikan');
    }

    function getEconomicLevelAttribute($value)
    {
        if ($this->economic_value == 1) {
            return 'Rendah';
        } elseif ($this->economic_value == 2) {
            return 'Sedang';
        } elseif ($this->economic_value == 3) {
            return 'Tinggi';
        } else {
            return null;
        }
    }

    function getEconomicLabelAttribute($value)
    {
        if ($this->economic_value == 1) {
            return '<span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent">Rendah</span>';
        } elseif ($this->economic_value == 2) {
            return '<span class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20">Sedang</span>';
        } elseif ($this->economic_value == 3) {
            return '<span class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20">Tinggi</span>';
        } else {
            return null;
        }
    }

    function getImageUrlAttribute($value)
    {
        return route('api.product.image', $this->id);
    }
}
