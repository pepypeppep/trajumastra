<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Navigation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'url',
        'order',
        'icon',
        'active',
        'display',
        'parent_id',
        'page',
    ];

    protected static function booted()
    {
        static::deleting(function ($navigation) {
            if ($navigation->child()->exists()) {
                throw new Exception("Penghapusan data Navigation tidak bisa dilakukan karena data telah digunakan pada data Child Navigation.");
            }
        });
    }

    public function child()
    {
        return $this->hasMany(Navigation::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Navigation::class, 'parent_id', 'id');
    }
}
