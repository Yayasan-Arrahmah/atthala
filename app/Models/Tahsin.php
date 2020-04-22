<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\TahsinAttribute;
use Webpatser\Uuid\Uuid;

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
        'angkatan_peserta',
        'status_peserta',
        'status_pembayaran'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid_tahsin = (string) Uuid::generate(4);
        });
    }

    public static function search($query)
    {
        return empty($query)
            ? static::query()
            : static::where('nama_peserta', 'like', '%'.$query.'%')
                ->orWhere('nama_pengajar', 'like', '%'.$query.'%')
                ->where('angkatan_peserta', '=', '15');
    }
    public static function statusLunas($query)
    {
        if ($query = '1') {
            return static::query();
        } elseif ($query = '2') {
            return static::where('nama_peserta', '=', 'LUNAS');
        } elseif ($query = '3') {
            return static::where('nama_peserta', '=', 'BELUM LUNAS');
        } else {
            return static::query();
        }
    }
}
