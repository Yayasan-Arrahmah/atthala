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
        'jenis_pengaturan',
        'kode_pengaturan',
        'nama_pengaturan',
        'status_pengaturan',
        'angkatan_pengaturan',
        'link_pengaturan',
        'fungsi_pengaturan',
        'keterangan_pengaturan',
        'user_pengaturan',
    ];

    public function scopeTahsin($query)
    {
        return $query->where('jenis_pengaturan', '=', 'TAHSIN');
    }

    public function scopeTla($query)
    {
        return $query->where('jenis_pengaturan', '=', 'TLA');
    }

    public function scopePeserta($query)
    {
        return $query->where('fungsi_pengaturan', '=', 'PESERTA');
    }

    public function scopePengajar($query)
    {
        return $query->where('fungsi_pengaturan', '=', 'PENGAJAR');
    }

    public function scopeAdmin($query)
    {
        return $query->where('fungsi_pengaturan', '=', 'ADMIN');
    }
}
