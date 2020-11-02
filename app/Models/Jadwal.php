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
        'uuid_jadwal',
        'pengajar_jadwal',
        'level_jadwal',
        'hari_jadwal',
        'waktu_jadwal',
        'jenis_jadwal',
        'angkatan_jadwal',
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid_jadwal = (string) Uuid::generate(4);
    //     });
    // }
}
