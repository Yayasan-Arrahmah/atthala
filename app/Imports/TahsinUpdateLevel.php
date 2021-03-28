<?php

namespace App\Imports;

use App\Models\Tahsin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithLimit;
class TahsinUpdateLevel implements ToModel, WithStartRow
// , WithLimit
{
    use Importable;
    private $rows = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rows;
        return new Tahsin([
            'notahsin'     => @$row[1],
            'levelpeserta' => @$row[4],
            'namapengajar' => @$row[5],
            'jadwaltahsin' => @$row[6],
            'jenispeserta' => @$row[7],
            'levelbaru'    => @$row[11]
        ]);
    }

    public function startRow(): int
    {
        return 3;
    }

    // public function limit(): int
    // {
    //     return 392;
    // }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
