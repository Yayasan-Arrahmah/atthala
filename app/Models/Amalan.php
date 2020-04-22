<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\AmalanAttribute;

class Amalan extends Model
{
    use AmalanAttribute,
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
        'nama_amalan',
        'deskripsi_amalan',
        'waktu_amalan',
        'user_create_amalan',
    ];
}
