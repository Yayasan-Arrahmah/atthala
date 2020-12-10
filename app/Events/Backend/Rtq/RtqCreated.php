<?php

namespace App\Events\Backend\Rtq;

use Illuminate\Queue\SerializesModels;

/**
 * Class RtqCreated.
 */
class RtqCreated
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
