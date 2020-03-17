<?php

namespace App\Events\Backend\Tahsin;

use Illuminate\Queue\SerializesModels;

/**
 * Class TahsinCreated.
 */
class TahsinCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $tahsins;

    /**
     * @param $tahsins
     */
    public function __construct($tahsins)
    {
        $this->tahsins = $tahsins;
    }
}
