<?php

namespace App\Models;

use App\Models\PelakuUsaha;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KelompokBinaan extends Model
{
    protected $guarded = ['id'];

    /* ============================= RELATIONSHIPS */

    /* Pelaku Usaha */
    public function pelakuUsaha(): HasMany
    {
        return $this->hasMany(PelakuUsaha::class);
    }
}
