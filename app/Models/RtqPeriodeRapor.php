<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RtqPeriodeRapor extends Model
{
    protected $fillable = [
        'nama_periode',
        'waktu_periode',
        'status_periode',
        'tahun_ajaran',
        'keterangan_periode',
    ];
}
