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
            'no_tahsin' => @$row[0],
            'kenaikan_level_peserta' => @$row[6],
        ]);
    }

    public function startRow(): int
    {
        return 5;
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
