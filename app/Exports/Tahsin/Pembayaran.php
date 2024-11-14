<?php

namespace App\Exports\Tahsin;

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

class Pembayaran extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function pengajar(string $pengajar=null)
    {
        $this->pengajar = $pengajar;
        return $this;
    }
    public function level(string $level=null)
    {
        $this->level = $level;
        return $this;
    }
    public function angkatan(string $angkatan=null)
    {
        $this->angkatan = $angkatan;
        return $this;
    }
    public function jenis(string $jenis=null)
    {
        $this->jenis = $jenis;
        return $this;
    }

    public function jadwal(string $jadwal=null)
    {
        $this->jadwal = $jadwal;
        return $this;
    }

    public function waktu(string $waktu=null)
    {
        $this->waktu = $waktu;
        return $this;
    }

    public function status(string $status=null)
    {
        $this->status = $status;
        return $this;
    }

    public function statuskeaktifan(string $statuskeaktifan=null)
    {
        $this->statuskeaktifan = $statuskeaktifan;
        return $this;
    }

    public function statusdaftar(string $statusdaftar=null)
    {
        $this->statusdaftar = $statusdaftar;
        return $this;
    }

    public function cari(string $cari=null)
    {
        $this->cari = $cari;
        return $this;
    }
    public function start(string $start=null)
    {
        $this->start = $start;
        return $this;
    }
    public function end(string $end=null)
    {
        $this->end = $end;
        return $this;
    }

    public function query()
    {
        // return Tahsin::query()
        //                 ->where('angkatan_peserta', $this->angkatan)
        //                 ->when($this->jenis, function($query) {
        //                     if( $this->jenis != 'SEMUA') {
        //                         return $query->where('jenis_peserta', '=', $this->jenis);
        //                     }
        //                 })
        //                 ->when($this->level, function($qu```wwqJ                                                 ery) {
        //                     if( $this->level != 'SEMUA') {
        //                         return $query->where('level_peserta', '=', $this->level);
        //                     }
        //                 })
        //                 ->when($this->pengajar, function($query) {
        //                     if( $this->pengajar != 'SEMUA') {
        //                         return $query->where('level_peserta', '=', $this->pengajar);
        //                     }
        //                 })
        //                 ->when($this->status, function($query) {
        //                     if( $this->status != 'SEMUA') {
        //                         return $query->where('level_peserta', '=', $this->status);
        //                     }
        //                 })
        //                 ;
        return  !empty(request()->pengajar)
                ?
                Tahsin::query()->cari($this->cari)
                    ->cariLevel($this->level)
                    ->jenis($this->jenis)
                    ->angkatan($this->angkatan)
                    ->pengajar($this->pengajar)
                    // ->statusPeserta($this->status)
                    // ->statusKeaktifan($this->statuskeaktifan)
                    ->statusDaftar($this->statusdaftar, $this->angkatan)
                    ->tanggal($this->start, $this->end)
                    // ->when($this->kenaikanlevel, function($query){
                    //     if ($this->kenaikanlevel != 'SEMUA') {
                    //         $query->where('kenaikan_level_peserta', $this->kenaikanlevel);
                    //     }
                    // })
                :
                Tahsin::angkatan('null')->paginate(0)
                ;
    }

    public function map($tahsin) : array {
        return [
            $tahsin->no_tahsin,
            $tahsin->nama_peserta,
            $tahsin->nohp_peserta,
            $tahsin->level_peserta,
            $tahsin->jenis_peserta,
            $tahsin->angkatan_peserta,
            $tahsin->waktu_lahir_peserta,
            $tahsin->kode_unik,
            // Carbon::createFromFormat('d-m-Y', $tahsin->waktu_lahir_peserta ?? '01-01-1901')->format('md'),
            $tahsin->pembayarandaftar->nominal_pembayaran,
            "https://atthala.arrahmahbalikpapan.or.id/app/public/bukti-transfer/".$tahsin->pembayarandaftar->bukti_transfer_pembayaran,
            $tahsin->created_at,
        ] ;
    }

    public function headings() : array {
        return [
           'No. Tahsin',
           'Nama Lengkap',
           'No. Telp',
           'Level',
           'Gender',
           'Angkatan',
           'BBTT',
           'Kode Unik',
           'Nominal',
           'Bukti tf',
           'Waktu',
        ] ;
    }
}
