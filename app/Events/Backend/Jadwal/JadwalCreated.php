<?php

namespace App\Events\Backend\Jadwal;

use Illuminate\Queue\SerializesModels;

/**
 * Class JadwalCreated.
 */
class JadwalCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $jadwals;

    /**
     * @param $jadwals
     */
    public function __construct($jadwals)
    {
        $this->jadwals = $jadwals;
    }
}
