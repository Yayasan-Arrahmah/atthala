<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsTo(Tahsin::class, 'uuid_pembayaran', 'uuid_tahsin');
    }
}