<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the staff that owns the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the uptd that owns the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uptd(): BelongsTo
    {
        return $this->belongsTo(Uptd::class);
    }
}
