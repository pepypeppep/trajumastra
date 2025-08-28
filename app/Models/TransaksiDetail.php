<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiDetail extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the transaksi that owns the TransaksiDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }

    /**
     * Get the jenis_ikan that owns the TransaksiDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenis_ikan(): BelongsTo
    {
        return $this->belongsTo(MasterJenisIkan::class, 'master_jenis_ikans_id');
    }
}
