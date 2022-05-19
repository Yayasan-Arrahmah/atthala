<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelTahsin extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    public $table = 'level_tahsin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'sort',
        'warna',
        'status',
        'keterangan',
    ];
}
