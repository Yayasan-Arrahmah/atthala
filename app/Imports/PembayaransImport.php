<?php

namespace App\Imports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PembayaransImport implements ToModel, WithStartRow
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

        return new Pembayaran([
            'nominal_pembayaran' => @$row[23] === 400000 ? 0 : 400000 - @$row[23],
            'uuid_pembayaran' => @$row[24],
            'jenis_pembayaran' => 'TAHSIN',
            'admin_pembayaran' => 'head.cashier@arrahmahbalikpapan.or.id',
        ]);
    }

    public function startRow(): int
    {
        return 5;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
