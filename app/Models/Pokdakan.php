<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokdakan extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the kalurahan that owns the Pokdakan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kalurahan(): BelongsTo
    {
        return $this->belongsTo(Kalurahan::class);
    }

    /**
     * The jenis_ikans that belong to the Pokdakan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jenis_ikans(): BelongsToMany
    {
        return $this->belongsToMany(MasterJenisIkan::class, 'pokdakan_jenis_ikan', 'pokdakan_id', 'jenis_ikan_id');
    }

    /**
     * The jenis_usahas that belong to the Pokdakan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jenis_usahas(): BelongsToMany
    {
        return $this->belongsToMany(MasterJenisUsaha::class, 'pokdakan_jenis_usaha', 'pokdakan_id', 'jenis_usaha_id');
    }

    /**
     * The jenis_kolams that belong to the Pokdakan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jenis_kolams(): BelongsToMany
    {
        return $this->belongsToMany(MasterJenisAset::class, 'pokdakan_jenis_kolam', 'pokdakan_id', 'jenis_aset_id');
    }
}
