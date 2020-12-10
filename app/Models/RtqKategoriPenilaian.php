<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RtqKategoriPenilaian extends Model
{
    protected $fillable = [
        'nama_kategori',
        'keterangan_kategori',
        'status_kategori',
    ];
}
