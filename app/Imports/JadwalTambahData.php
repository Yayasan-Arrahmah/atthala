<?php

namespace App\Imports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class JadwalTambahData implements ToModel, WithStartRow
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

        return new Jadwal([
            'uuid_jadwal'     => Str::uuid(),
            'pengajar_jadwal' => @$row[1],
            'level_jadwal'    => @$row[2],
            'hari_jadwal'     => @$row[3],
            'waktu_jadwal'    => @$row[4],
            'angkatan_jadwal' => @$row[5],
            'jumlah_peserta'  => @$row[6],
            'jenis_jadwal'    => @$row[7],
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
