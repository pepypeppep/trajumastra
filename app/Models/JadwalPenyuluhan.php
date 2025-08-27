<?php

namespace App\Models;

use App\Models\Materi;
use App\Models\MasterKategori;
use App\Models\MasterJenisPenyuluhan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JadwalPenyuluhan extends Model
{
    protected $guarded = ['id'];

    /* ============================= RELATIONSHIPS */

    /* Jenis Penyuluhan */
    public function jenisPenyuluhan(): BelongsTo    
    {
        return $this->belongsTo(MasterJenisPenyuluhan::class);
    }

    /* Materi */
    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class);
    }

    /* Kategori */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(MasterKategori::class);
    }

    /* Jadwal Penyuluhan has Penyuluhs */
    public function penyuluhs(): BelongsToMany
    {
        return $this->belongsToMany(
            Penyuluh::class,                             // model tujuan
            'jadwal_penyuluhan_has_penyuluhs',           // tabel pivot
            'jadwal_penyuluhan_id',                      // foreign key di pivot yang mengacu ke jadwal
            'penyuluh_id'                                // foreign key di pivot yang mengacu ke penyuluh
        );
    }
}
