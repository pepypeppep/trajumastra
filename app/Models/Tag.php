<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($tag) {
            if ($tag->materis()->exists()) {
                throw new Exception("Penghapusan data Tag tidak bisa dilakukan karena data telah digunakan pada data Materi.");
            }
        });
    }

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
