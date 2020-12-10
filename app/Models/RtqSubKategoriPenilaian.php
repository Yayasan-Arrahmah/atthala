<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RtqSubKategoriPenilaian extends Model
{
    protected $fillable = [
        'id_kategori',
        'nama_sub_kategori',
        'keterangan_sub_kategori',
        'status_sub_kategori',
    ];
}
