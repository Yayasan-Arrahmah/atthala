<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanTahsin extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_pengaturan',
        'keterangan_pengaturan',
        'pilihan_pengaturan',
        'status_pengaturan',
        'user_pengaturan',
    ];
}