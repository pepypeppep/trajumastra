<?php

namespace App\Models;

use App\Models\Materi;
use App\Models\MasterKategori;
use App\Models\MasterJenisPenyuluhan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
