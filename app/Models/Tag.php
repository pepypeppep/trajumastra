<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $guarded = ['id'];

    /**
     * The materis that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function materis(): BelongsToMany
    {
        return $this->belongsToMany(Materi::class, 'materi_tag');
    }
}
