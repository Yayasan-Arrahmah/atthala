<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\AbsenAttribute;

class Absen extends Model
{
    use AbsenAttribute,
        SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_peserta',
        'user_create_absen',
        'pertemuan_ke_absen',
        'jenis_absen',
        'level_kelas_absen',
        'waktu_kelas_absen',
        'jenis_kelas_absen',
        'angkatan_absen',
        'keterangan_absen',
    ];
}
