<?php

namespace App\Events\Backend\Jadwal;

use Illuminate\Queue\SerializesModels;

/**
 * Class JadwalUpdated.
 */
class JadwalUpdated
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
