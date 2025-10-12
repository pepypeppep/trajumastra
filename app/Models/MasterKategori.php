<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class MasterKategori extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($masterKategori) {
            if ($masterKategori->jadwalPenyuluhan()->exists()) {
                throw new Exception("Penghapusan data Master Kategori tidak bisa dilakukan karena data telah digunakan pada data Jadwal Penyuluhan.");
            }
        });
    }
    
    /* =========================== RELATIONSHIPS */
    /* Jadwal penyuluhan Relationship */
    public function jadwalPenyuluhan()
    {
        return $this->hasMany(JadwalPenyuluhan::class, 'kategori_id');
    }
}
