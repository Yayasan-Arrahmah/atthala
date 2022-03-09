<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\TahsinAttribute;

class Tahsin extends Model
{
    use TahsinAttribute,
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
        'no_tahsin',
        'nama_peserta',
        'nohp_peserta',
        'level_peserta',
        'nama_pengajar',
        'jadwal_tahsin',
        'sudah_daftar_tahsin',
        'belum_daftar_tahsin',
        'keterangan_tahsin',
        'pindahan_tahsin',
        'pindahan_tahsin_2',
        'jenis_peserta',
        'jenis_pembelajaran',
        'angkatan_peserta',
        'pilih_jadwal_peserta',
        'pilih_jadwal_cadangan_1_peserta',
        'pilih_jadwal_cadangan_2_peserta',
        'alamat_peserta',
        'pekerjaan_peserta',
        'tempat_lahir_peserta',
        'waktu_lahir_peserta',
        'fotoktp_peserta',
        'rekaman_peserta',
        'status_peserta',
        'status_pembayaran',
        'status_kelulusan'
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid_tahsin = (string) Uuid::generate(4);
    //     });
    // }

    public static function search($query)
    {
        return empty($query)
            ? static::query()
            : static::where('nama_peserta', 'like', '%' . $query . '%')
            ->orWhere('nama_pengajar', 'like', '%' . $query . '%')
            ->where('angkatan_peserta', '=', session('angkatan_tahsin'));
    }

    public function absens(){
        return $this->hasMany('App\Models\Absen');
    }

    public function scopeCariNama($query, $nama)
    {
        return $query->where('nama_peserta', 'like', '%'.$nama.'%');
    }

    public function scopeCariLevel($query, $level)
    {
        if( $level != 'SEMUA') {
            return $query->where('level_peserta', '=', $level);
        }
    }

    public function scopeJenis($query, $jenis)
    {
        if( $jenis != 'SEMUA') {
            return $query->where('jenis_peserta', '=', $jenis);
        }
    }

    public function scopeAngkatan($query, $angkatan)
    {
        return $query->where('angkatan_peserta', 'like', '%'.$angkatan.'%');
    }

    public function scopePengajar($query, $pengajar)
    {
        if( $pengajar != 'SEMUA') {
            return $query->where('nama_pengajar', '=', $pengajar);
        }
    }

    public function scopeStatusPeserta($query, $status)
    {
        if( $status != 'SEMUA') {
            if( $status == 'UMUM') {
                return $query->where('pilih_jadwal_peserta', null);
            } elseif( $status == 'WARGA-SP') {
                return $query->where('pilih_jadwal_peserta', 'sepinggan-pratama');
            }
        }
    }
}
