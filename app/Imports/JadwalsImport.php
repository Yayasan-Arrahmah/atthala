<?php

namespace App\Imports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class JadwalsImport implements ToModel, WithHeadingRow
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
        // if (!isset($row[0])) {
        //     return null;
        // }
        ++$this->rows;
        $jenispeserta = session('jenispeserta');
        $angkatanpeserta = session('angkatanpeserta');
        return new Jadwal([
            'no_jadwal' => @$row[0],
            'nama_peserta' => @$row[1],
            'nohp_peserta' => @$row[2],
            'level_peserta' => @$row[3],
            'nama_pengajar' => @$row[4],
            'jadwal_tahsin' => @$row[5],
            'sudah_daftar_jadwal' => @$row[6],
            'belum_daftar_jadwal' => @$row[7],
            'keterangan_jadwal' => @$row[8],
            'pindahan_jadwal' => @$row[9],
            'pindahan_jadwal_2' => @$row[10],
            'jenis_peserta' => $jenispeserta,
            'angkatan_peserta' => $angkatanpeserta,
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
