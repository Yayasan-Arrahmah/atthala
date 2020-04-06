<?php

namespace App\Events\Backend\Pembayaran;

use Illuminate\Queue\SerializesModels;

/**
 * Class PembayaranUpdated.
 */
class PembayaranUpdated
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
