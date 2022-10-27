<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\Attribute\PembayaranAttribute;

class Pembayaran extends Model
{
    use PembayaranAttribute,
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
        'uuid_pembayaran',
        'nominal_pembayaran',
        'keterangan_pembayaran',
        'jenis_pembayaran',
        'admin_pembayaran',
    ];

    public function tahsin()
    {
        return $this->belongsTo(Tahsin::class, 'id_peserta', 'id');
    }

    public function tahsinspp()
    {
        return $this->hasOne(Tahsin::class, 'id', 'id_peserta');
    }

    public function pembayarantahsin()
    {
        return $this->hasMany(Tahsin::class, 'id', 'id_peserta');
    }

    public function scopeJumlahdaftarbaru($query, $jenis = null, $angkatan = null)
    {
        $this->jenis_ = $jenis;
        $this->ang_ = $angkatan;
        return $query->whereHas('pembayarantahsin', function (Builder $q){
                $q->when($this->jenis_, function ($q_) {
                    if ($this->jenis_) {
                        return $q_->where('jenis_peserta', $this->jenis_);
                    }
                })
                ->where('no_tahsin', 'like', '%-'.$this->ang_.'-%')
                ->where('jenis_pembayaran', 'TAHSIN')
                ->where('angkatan_peserta', $this->ang_)
                ;
            });
    }

    public function scopeJumlahdaftarulang($query, $jenis = null, $angkatan = null)
    {
        $this->jenis_ = $jenis;
        $this->ang_ = $angkatan;
        return $query->whereHas('pembayarantahsin', function (Builder $q){
                $q->when($this->jenis_, function ($q_) {
                    if ($this->jenis_) {
                        return $q_->where('jenis_peserta', $this->jenis_);
                    }
                })
                ->where('no_tahsin', 'not like', '%-'.$this->ang_.'-%')
                ->where('jenis_pembayaran', 'TAHSIN')
                ->where('angkatan_peserta', $this->ang_)
                ;
            });
    }

    public function scopeJumlahspp($query, $jenis = null, $angkatan = null)
    {
        $this->jenis_ = $jenis;
        $this->ang_ = $angkatan;
        return $query->whereHas('pembayarantahsin', function (Builder $q){
                $q->when($this->jenis_, function ($q_) {
                    if ($this->jenis_) {
                        return $q_->where('jenis_peserta', $this->jenis_);
                    }
                })
                ->where('jenis_pembayaran', 'SPP TAHSIN')
                ->where('angkatan_peserta', $this->ang_)
                ;
            });
    }
}
