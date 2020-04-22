<?php

namespace App\Events\Backend\Amalan;

use Illuminate\Queue\SerializesModels;

/**
 * Class AmalanUpdated.
 */
class AmalanUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $amalans;

    /**
     * @param $amalans
     */
    public function __construct($amalans)
    {
        $this->amalans = $amalans;
    }
}
