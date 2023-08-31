<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenPertemuan extends Model
{
    protected $table = 'absen_pertemuan';
    protected $fillable = [
        'id_jadwal',
        'pertemuan',
        'tilawah_pertemuan_surah',
        'tilawah_pertemuan_ayat',
        'tanggal_pertemuan',
    ];
}
