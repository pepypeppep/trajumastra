<?php

namespace App\Models;

use Exception;
use App\Models\JadwalPenyuluhan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Penyuluh extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($penyuluh) {
            if ($penyuluh->jadwalPenyuluhans()->exists()) {
                throw new Exception("Penghapusan data Penyuluh tidak bisa dilakukan karena data telah digunakan pada data Jadwal Penyuluhan.");
            }
        });
    }

    /* =========================== RELATIONSHIPS */

    /* User */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* Jadwal penyuluhan */
    public function jadwalPenyuluhans(): BelongsToMany
    {
        return $this->belongsToMany(
            JadwalPenyuluhan::class,
            'jadwal_penyuluhan_has_penyuluhs',
            'penyuluh_id',
            'jadwal_penyuluhan_id'
        );
    }
}
