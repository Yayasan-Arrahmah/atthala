<?php

namespace App\Events\Backend\Rtq;

use Illuminate\Queue\SerializesModels;

/**
 * Class RtqUpdated.
 */
class RtqUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $rtqs;

    /**
     * @param $rtqs
     */
    public function __construct($rtqs)
    {
        $this->rtqs = $rtqs;
    }
}
