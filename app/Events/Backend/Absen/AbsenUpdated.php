<?php

namespace App\Events\Backend\Absen;

use Illuminate\Queue\SerializesModels;

/**
 * Class AbsenUpdated.
 */
class AbsenUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $absens;

    /**
     * @param $absens
     */
    public function __construct($absens)
    {
        $this->absens = $absens;
    }
}
