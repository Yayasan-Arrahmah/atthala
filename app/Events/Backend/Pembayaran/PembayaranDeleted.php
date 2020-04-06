<?php

namespace App\Events\Backend\Pembayaran;

use Illuminate\Queue\SerializesModels;

/**
 * Class PembayaranDeleted.
 */
class PembayaranDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $pembayarans;

    /**
     * @param $pembayarans
     */
    public function __construct($pembayarans)
    {
        $this->pembayarans = $pembayarans;
    }
}
