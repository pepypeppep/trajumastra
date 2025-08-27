<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KoordinatorUptd extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the uptd that owns the KoordinatorUptd
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uptd(): BelongsTo
    {
        return $this->belongsTo(Uptd::class);
    }

    /* User */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
