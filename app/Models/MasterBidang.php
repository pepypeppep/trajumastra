<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBidang extends Model
{
    protected $guarded = ['id'];

    /* =========================== RELATIONSHIPS */

    /* User */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
