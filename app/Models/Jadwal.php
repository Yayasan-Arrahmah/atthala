<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\JadwalAttribute;
use Webpatser\Uuid\Uuid;

class Jadwal extends Model
{
    use JadwalAttribute,
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
        'no_jadwal',
        'nama_peserta',
        'nohp_peserta',
        'level_peserta',
        'nama_pengajar',
        'jadwal_tahsin',
        'sudah_daftar_jadwal',
        'belum_daftar_jadwal',
        'keterangan_jadwal',
        'pindahan_jadwal',
        'pindahan_jadwal_2',
        'jenis_peserta',
        'angkatan_peserta'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid_jadwal = (string) Uuid::generate(4);
        });
    }
}
