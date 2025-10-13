<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kecamatan extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($kecamatan) {
            if ($kecamatan->kelompokBinaan()->exists()) {
                throw new Exception("Penghapusan data Kecamatan tidak bisa dilakukan karena data telah digunakan pada data Kelompok Binaan.");
            }
        });
    }

    /**
     * Get the kabupaten that owns the Kecamatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    /* Kelompok Binaan Relationship */
    public function kelompokBinaan()
    {
        return $this->hasMany(KelompokBinaan::class, 'kecamatan_id');
    }
}
