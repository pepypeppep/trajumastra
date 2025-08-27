<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kalurahan;
use App\Models\KelompokBinaan;
use App\Models\MasterJenisUsaha;
use App\Models\MasterBentukUsaha;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelakuUsaha extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /* =========================== RELATIONSHIPS */

    /* Kalurahan Relationship */
    public function kalurahan(): BelongsTo
    {
        return $this->belongsTo(Kalurahan::class);
    }

    /* Kelompok Binaan Relationship */
    public function kelompokBinaan(): BelongsTo
    {
        return $this->belongsTo(KelompokBinaan::class);
    }

    /* Bentuk Usaha Relationship */
    public function bentukUsaha(): BelongsTo
    {
        return $this->belongsTo(MasterBentukUsaha::class);
    }

    /* Jenis Usaha Relationship */
    public function jenisUsaha(): BelongsTo
    {
        return $this->belongsTo(MasterJenisUsaha::class);
    }

    /* User */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
