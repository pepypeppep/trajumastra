<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Uptd extends Model
{
    protected $guarded = ['id'];

    const TPI = 1;
    const UPTD = 2;

    /**
     * Get the user that owns the Uptd
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kalurahan that owns the Uptd
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kalurahan(): BelongsTo
    {
        return $this->belongsTo(Kalurahan::class);
    }

    /**
     * Get all of the stok_ikans for the Uptd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stok_ikans(): HasMany
    {
        return $this->hasMany(StokIkan::class);
    }

    /**
     * The jenis_ikans that owns the Uptd
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jenis_ikans(): BelongsToMany
    {
        return $this->belongsToMany(MasterJenisIkan::class, 'uptd_jenis_ikan', 'uptd_id', 'jenis_ikan_id');
    }
}
