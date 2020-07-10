<?php

namespace App\Imports;

use App\Models\Tahsin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TahsinsImport implements ToModel, WithStartRow
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
        $jenispeserta = session('jenispeserta');
        $angkatanpeserta = session('angkatanpeserta');
        return new Tahsin([
            'no_tahsin' => @$row[1],
            'nama_peserta' => @$row[0],
            'nohp_peserta' => @$row[2],
            'level_peserta' => @$row[3],
            'jadwal_tahsin' => @$row[4],
            'nama_pengajar' => @$row[6],
            // 'status_peserta' => @$row[7],
            // 'sudah_daftar_jadwal' => @$row[6],
            // 'belum_daftar_jadwal' => @$row[7],
            // 'keterangan_jadwal' => @$row[7],
            // 'pindahan_jadwal' => @$row[9],
            // 'pindahan_jadwal_2' => @$row[10],
            // 'status_pembayaran' => @$row[23] === 0 ? '2' : '1',   // 2 = BELUM LUNAS . 1 = LUNAS
            'jenis_peserta' => $jenispeserta,
            'angkatan_peserta' => $angkatanpeserta,

        ]);
    }

    public function startRow(): int
    {
        return 1;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
