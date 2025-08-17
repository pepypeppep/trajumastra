<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HargaIkan extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the uptd that owns the StokIkan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uptd(): BelongsTo
    {
        return $this->belongsTo(Uptd::class);
    }

    /**
     * Get the jenis_ikan that owns the StokIkan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenis_ikan(): BelongsTo
    {
        return $this->belongsTo(MasterJenisIkan::class);
    }
}
