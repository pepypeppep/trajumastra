<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Materi extends Model
{
    protected $guarded = ['id'];

    // protected static function booted()
    // {
    //     static::deleting(function ($materi) {
    //         if ($materi->tags()->exists()) {
    //             throw new Exception("Penghapusan data Materi tidak bisa dilakukan karena data telah digunakan pada data Tag.");
    //         }
    //     });
    // }

    /**
     * The tags that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'materi_tag');
    }
}
