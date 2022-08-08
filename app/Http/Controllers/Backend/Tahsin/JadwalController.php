<?php

namespace App\Http\Controllers\Backend\Tahsin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Tahsin\Peserta;
use App\Models\Tahsin;
use DB;
use App\Models\PesertaUjian;
use App\Models\StatusPesertaTahsin;
use App\Models\LevelTahsin;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->id            = request()->id ?? null;
        $this->nama          = request()->nama ?? null;
        $this->cari          = request()->cari ?? null;
        $this->kenaikanlevel = request()->kenaikanlevel ?? null;
        $this->idtahsin      = request()->idtahsin ?? null;
        $this->level         = request()->level ?? null;
        $this->nohp          = request()->nohp ?? null;
        $this->jenis         = request()->jenis ?? null;
        $this->pengajar      = request()->pengajar ?? null;
        $this->angkatan      = request()->angkatan ?? 19;
        $this->angkatanbaru  = request()->angkatan ?? 19;
        $this->angkatanujian = request()->angkatan ?? 18;
        $this->status        = request()->status ?? null;
        $this->listpengajar  = Tahsin::select('nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
                                ->groupBy('nama_pengajar', 'jenis_peserta')
                                ->where('nama_pengajar', '!=', NULL)
                                ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
                                ->angkatan($this->angkatan)
                                ->get();
        $this->listangkatan  = Tahsin::select('angkatan_peserta')
                                ->groupBy('angkatan_peserta')
                                ->orderBy('angkatan_peserta', 'desc')
                                ->get();
        $this->liststatuspeserta = StatusPesertaTahsin::get();
        $this->listlevel         = LevelTahsin::orderBy('sort', 'asc')->get();
    }

    public function tahsin($statusdaftar, $statuskeaktifan)
    {
        return Tahsin::cari($this->cari)
                    ->cariLevel($this->level)
                    ->jenis($this->jenis)
                    ->angkatan($this->angkatan)
                    ->pengajar($this->pengajar)
                    ->statusPeserta($this->status)
                    ->statusKeaktifan($statuskeaktifan)
                    ->statusDaftar($statusdaftar, $this->angkatan)
                    ->paginate(10);
    }

    public function tahsinbase($statusA, $statusB, $titleA)
    {
        $status_       = $statusA;
        $tahsins       = $this->tahsin($statusA, $statusB);
        $dataangkatan  = $this->listangkatan;
        $datalevel     = $this->listlevel;
        $datapengajars = $this->listpengajar;
        $liststatus    = $this->liststatuspeserta;
        $title         = $titleA;

        return view('backend.pendidikan.tahsin.peserta', compact('tahsins', 'title', 'datalevel', 'datapengajars', 'status_', 'dataangkatan', 'liststatus'));
    }

    public function index()
    {
        return $this->tahsinbase(null, null, 'Peserta');
    }

    public function getDaftarUlang()
    {
        return $this->tahsinbase('daftar-ulang', null, 'Peserta Daftar Ulang');
    }

    public function getBaru()
    {
        return $this->tahsinbase('daftar-baru', null, 'Peserta Pendaftar Baru');
    }

    public function getDaftarUjian()
    {
        return $this->tahsinbase('daftar-ujian', null, 'Peserta Pendaftar Ujian');
    }

    public function getAktif()
    {
        return $this->tahsinbase(null, 'AKTIF', 'Peserta Aktif');
    }

    public function getCuti()
    {
        return $this->tahsinbase(null, 'CUTI', 'Peserta Cuti');
    }

    public function getOff()
    {
        return $this->tahsinbase(null, 'OFF', 'Peserta Off');
    }

    public function postUpdatePeserta()
    {
        $data = Tahsin::find($this->id);
    }

    public function getDeletePeserta()
    {
        $data = Tahsin::find($this->id);
    }

    // FUNGSI UNTUK PERBAIKAN BUG PEMBUATAN AWAL YG TIDAK DISERTAI RELASI KE TABEL PESERTA UJIAN
    public function getUpdateIdTahsin()
    {
        $dataujian = PesertaUjian::where('id_tahsin', '=', NULL)->get();

        foreach($dataujian as $data){
            $datatahsin = Tahsin::where('no_tahsin', '=', $data->no_tahsin)
                                ->where('angkatan_peserta',  $data->angkatan_ujian)
                                ->first();
            if ($datatahsin) {
                $update = PesertaUjian::where('no_tahsin', '=', $datatahsin->no_tahsin)
                                ->where('angkatan_ujian',  $datatahsin->angkatan_peserta)
                                ->first();
                if ($update) {
                    $update->id_tahsin = $datatahsin->id;
                    $update->save();
                }
            }
        }
        return 'OK';
    }
}
