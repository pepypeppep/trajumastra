<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MasterJenisIkan extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['imageUrl'];

    /**
     * The uptds that belong to the MasterJenisIkan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function uptds(): BelongsToMany
    {
        return $this->belongsToMany(Uptd::class, 'uptd_jenis_ikan', 'jenis_ikan_id', 'uptd_id');
    }

    function getImageUrlAttribute($value)
    {
        return route('api.product.image', $this->id);
    }
}
