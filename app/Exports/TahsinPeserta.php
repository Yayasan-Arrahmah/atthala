<?php

namespace App\Exports;

use App\Models\Tahsin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class TahsinPeserta extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function angkatan(string $angkatan)
    {
        $this->angkatan = $angkatan;
        return $this;
    }

    public function level(string $level)
    {
        $this->level = $level;
        return $this;
    }

    public function jenis(string $jenis)
    {
        $this->jenis = $jenis;
        return $this;
    }

    public function query()
    {
        return Tahsin::query()
                        ->where('angkatan_peserta', $this->angkatan)
                        ->when($this->jenis, function($query) {
                            if( $this->jenis != 'SEMUA') {
                                return $query->where('jenis_peserta', '=', $this->jenis);
                            }
                        })
                        ->when($this->level, function($query) {
                            if( $this->level != 'SEMUA') {
                                return $query->where('level_peserta', '=', $this->level);
                            }
                        });
    }

    public function map($tahsin) : array {
        return [
            $tahsin->no_tahsin,
            $tahsin->nama_peserta,
            $tahsin->nohp_peserta,
            $tahsin->level_peserta,
            $tahsin->nama_pengajar,
            $tahsin->jadwal_tahsin,
            $tahsin->jenis_peserta,
            $tahsin->angkatan_peserta,
            Carbon::createFromFormat('d-m-Y', $tahsin->waktu_lahir_peserta ?? '01-01-1901')->format('md'),
        ] ;
    }

    public function headings() : array {
        return [
           'No. Tahsin',
           'Nama Lengkap',
           'No. Telp',
           'Level',
           'Pengajar',
           'Jadwal',
           'Gender',
           'Angkatan',
           'BBTT',
        ] ;
    }
}
