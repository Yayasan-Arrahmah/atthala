<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'uuid',
        'no_tahsin',
        'status_pelunasan',
        'bukti_transfer',
        'angkatan_ujian',
    ];
}
