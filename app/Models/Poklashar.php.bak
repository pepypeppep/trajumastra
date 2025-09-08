<?php

namespace App\Models;

use App\Models\Kecamatan;
use App\Models\MasterJenisUsaha;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Poklashar extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the kalurahan that owns the poklashar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * The jenis_usahas that belong to the poklashar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jenis_usahas(): BelongsToMany
    {
        return $this->belongsToMany(MasterJenisUsaha::class, 'kelompok_binaan_jenis_usaha', 'kelompok_binaan_id', 'jenis_usaha_id')
                    ->withTimestamps();
    }

}
