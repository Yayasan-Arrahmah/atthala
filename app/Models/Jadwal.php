<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\JadwalAttribute;

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
        'uuid_jadwal',
        'pengajar_jadwal',
        'level_jadwal',
        'hari_jadwal',
        'waktu_jadwal',
        'jenis_jadwal',
        'angkatan_jadwal',
        'jumlah_peserta',
        'status_belajar',
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid_jadwal = (string) Uuid::generate(4);
    //     });
    // }

    public function level()
    {
        return $this->hasOne(LevelTahsin::class, 'nama', 'level_jadwal');
    }

    public function scopePengajar($query, $pengajar)
    {
        if (!null == $pengajar) {
            if( $pengajar != 'SEMUA') {
                return $query->where('nama_pengajar', '=', $pengajar);
            }
        }
    }
    public function scopeLevel($query, $level)
    {
        if (!null == $level) {
            if( $level != 'SEMUA') {
                return $query->where('level_jadwal', '=', $level);
            }
        }
    }
    public function scopeHari($query, $hari)
    {
        if (!null == $hari) {
            if( $hari != 'SEMUA') {
                return $query->where('hari_jadwal', '=', $hari);
            }
        }
    }
    public function scopeWaktu($query, $waktu)
    {
        if (!null == $waktu) {
            if( $waktu != 'SEMUA') {
                return $query->where('waktu_jadwal', '=', $waktu);
            }
        }
    }

    public function scopeJenis($query, $jenis)
    {
        if (!null == $jenis) {
            if( $jenis != 'SEMUA') {
                return $query->where('jenis_jadwal', '=', $jenis);
            }
        }
    }

    public function scopeStatus($query, $status)
    {
        if (!null == $status) {
            if( $status != 'SEMUA') {
                return $query->where('status_belajar', '=', $status);
            }
        }
    }

    public function scopeAngkatan($query, $angkatan)
    {
        if (!null == $angkatan) {
            return $query->where('angkatan_jadwal', '=', $angkatan);
        }
    }


}
