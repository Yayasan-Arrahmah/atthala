<?php

namespace App\Events\Backend\Pengajar;

use Illuminate\Queue\SerializesModels;

/**
 * Class PengajarCreated.
 */
class PengajarCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $pengajars;

    /**
     * @param $pengajars
     */
    public function __construct($pengajars)
    {
        $this->pengajars = $pengajars;
    }
}
