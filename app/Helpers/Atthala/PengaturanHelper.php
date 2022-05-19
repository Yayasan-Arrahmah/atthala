<?php

namespace App\Helpers\Atthala;

use App\Models\Pengaturan;

class PengaturanHelper
{
    public function tahsin()
    {
        $data = Pengaturan::tahsin()->count();
        return $data;
    }
}
