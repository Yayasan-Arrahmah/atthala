<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\Attribute\AmalanAttribute;


class AmalansListsAbsens extends Model
{
    use AmalanAttribute;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_amalan_list',
        'user_amalan_list',
        'waktu_hijriyah_amalan_list',
        'tanggal_hijriyah_amalan_list',
    ];
}
