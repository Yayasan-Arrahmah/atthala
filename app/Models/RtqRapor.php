<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RtqRapor extends Model
{
    protected $fillable = [
        'id_periode_rapor',
        'id_santri',
        'hafalan_santri',
        'level_tahsin_santri',
        'jumlah_hari_sakit',
        'jumlah_hari_izin',
        'jumlah_hari_tanpa_ket',
        'catatan_pembimbing_santri',
    ];
}
