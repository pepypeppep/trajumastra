<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($kabupaten) {
            if ($kabupaten->kecamatan()->exists()) {
                throw new Exception("Penghapusan data Kabupaten tidak bisa dilakukan karena data telah digunakan pada data Kecamatan.");
            }
        });
    }

    /* =========================== RELATIONSHIPS */
    /* Kecamatan Relationship */
    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'kabupaten_id');
    }
}
