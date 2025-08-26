<?php

namespace App\Models;

use App\Models\Kalurahan;
use App\Models\PelakuUsaha;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelompokBinaan extends Model
{
    protected $guarded = ['id'];

    /* ============================= RELATIONSHIPS */

    /* Pelaku Usaha */
    public function pelakuUsaha(): HasMany
    {
        return $this->hasMany(PelakuUsaha::class);
    }

    /* Kalurahan */
    public function kalurahan(): BelongsTo
    {
        return $this->belongsTo(Kalurahan::class);
    }
}
