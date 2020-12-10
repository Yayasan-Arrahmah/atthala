<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\RtqAttribute;

class Rtq extends Model
{
    use RtqAttribute,
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
        'nis_santri',
        'nama_santri',
        'notelp_santri',
        'jenis_santri',
        'status_santri',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nama_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'alamat_orangtua',
        'tanggal_masuk',
        'jumlah_hafalan',
        'pengalaman_pesantren',
        'riwayat_pendidikan',
        'spp_disanggupi',
        'angkatan_santri',
        'domisili',
        'kriteria',
        'keterangan',
    ];
}
