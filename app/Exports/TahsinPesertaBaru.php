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

class TahsinPesertaBaru extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function query()
    {
        return Tahsin::query()->where('no_tahsin', 'like', '%-'.'18'.'-%');
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
            $tahsin->created_at,
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
           'Tanggak Daftar',
        ] ;
    }
}
