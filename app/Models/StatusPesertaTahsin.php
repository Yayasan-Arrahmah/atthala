<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPesertaTahsin extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    public $table = 'peserta_tahsin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'keterangan',
    ];
}
