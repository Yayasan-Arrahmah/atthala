<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tahsin;
use Illuminate\Database\Eloquent\Builder;

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

    public function tahsin()
    {
        return $this->hasOne(Tahsin::class, 'no_tahsin', 'no_tahsin')->where('angkatan_peserta', request()->angkatan ?? $this->angkatan);
    }

    public function pembayarantahsin()
    {
        return $this->hasMany(Tahsin::class, 'no_tahsin', 'no_tahsin');
    }

    public function scopeJumlahpembayaran($query, $jenis = null, $angkatan = null)
    {
        $this->jenis_ = $jenis;
        $this->ang_ = $angkatan;
        return $query->whereHas('pembayarantahsin', function (Builder $q){
                $q->when($this->jenis_, function ($q_) {
                    if ($this->jenis_) {
                        return $q_->where('jenis_peserta', $this->jenis_)
                                  ->where('angkatan_peserta',$this->ang_);
                    }
                })
                ->where('angkatan_ujian', $this->ang_)
                ;
            });
    }
}
