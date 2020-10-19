<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tahsin;

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

    public function data()
    {
        return $this->belongsTo(Tahsin::class, 'no_tahsin', 'no_tahsin');
    }
}
