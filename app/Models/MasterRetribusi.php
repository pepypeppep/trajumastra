<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterRetribusi extends Model
{
    protected $guarded = ['id'];

    // =========================== RELATIONSHIPS */
    /* Master Jenis Ikan Relationship */
    public function jenisIkan()
    {
        return $this->belongsTo(MasterJenisIkan::class, 'id_jenis_ikan');
    }
}
