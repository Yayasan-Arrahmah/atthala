<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sembako extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    public $table = 'sembako';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'notelp',
        'status',
        'pesanan',
        'total',
    ];
}
