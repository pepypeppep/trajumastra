<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class MasterJenisPenyuluhan extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($masterJenisPenyuluhan) {
            if ($masterJenisPenyuluhan->jadwalPenyuluhan()->exists()) {
                throw new Exception("Penghapusan data Master Jenis Penyuluhan tidak bisa dilakukan karena data telah digunakan pada data Jadwal Penyuluhan.");
            }
        });
    }

    /* =========================== RELATIONSHIPS */
    /* Jadwal Penyuluhan Relationship */
    public function jadwalPenyuluhan()
    {
        return $this->hasMany(JadwalPenyuluhan::class, 'jenis_penyuluhan_id');
    }
}
