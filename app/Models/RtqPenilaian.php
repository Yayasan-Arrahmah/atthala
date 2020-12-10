<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RtqPenilaian extends Model
{
    protected $fillable = [
        'id_rapor',
        'id_santri',
        'id_sub_kategori',
        'nilai_santri',
        'keterangan_nilai_santri'
    ];
}
