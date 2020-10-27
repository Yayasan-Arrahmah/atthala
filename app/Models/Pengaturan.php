<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = ['deleted_at'];
    public $table = 'pengaturan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pengaturan',
        'nama_pengaturan',
        'keterangan_pengaturan',
        'nilai_pengaturan',
        'user_pengaturan',
    ];
}
