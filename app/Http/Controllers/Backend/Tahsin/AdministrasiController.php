<?php

namespace App\Http\Controllers\Backend\Tahsin;

use App\Http\Controllers\Controller;
use App\Models\Tahsin;
use DB;
use App\Models\PesertaUjian;
use App\Models\StatusPesertaTahsin;
use App\Models\LevelTahsin;

class AdministrasiController extends Controller
{
    public function __construct()
    {
        $this->id            = request()->id ?? null;
        $this->nama          = request()->nama ?? null;
        $this->cari          = request()->cari ?? null;
        $this->kenaikanlevel = request()->kenaikanlevel ?? null;
        $this->idtahsin      = request()->idtahsin ?? null;
        $this->level         = request()->level ?? null;
        $this->kenaikanlevel = request()->input('kenaikan-level') ?? null;
        $this->nohp          = request()->nohp ?? null;
        $this->jenis         = request()->jenis ?? null;
        $this->pengajar      = request()->pengajar ?? null;
        $this->angkatan      = request()->input('daftar-ulang') == 2 ? request()->angkatan-1 : (request()->angkatan ?? 21);
        $this->angkatanbaru  = request()->angkatan ?? 21;
        $this->angkatanujian = request()->angkatan ?? 20;
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
        $this->listlevel         = LevelTahsin::orderBy('id', 'asc')->get();
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
                    ->when($this->kenaikanlevel, function($query){
                        if ($this->kenaikanlevel != 'SEMUA') {
                            $query->where('kenaikan_level_peserta', $this->kenaikanlevel);
                        }
                    })
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
        if (request()->input('daftar-ulang') == 2) {
            return $this->tahsinbase('belum-daftar-ulang', null, 'Peserta Daftar Ulang');
        } else {
            return $this->tahsinbase('daftar-ulang', null, 'Peserta Daftar Ulang');
        }
    }

    public function getBaru()
    {
        if (request()->input('daftar-baru') == 1) {
            return $this->tahsinbase('belum-selesai-diperiksa', null, 'Peserta Pendaftar Baru');
        }  elseif (request()->input('daftar-baru') == 2) {
            return $this->tahsinbase('belum-pilih-jadwal', null, 'Peserta Pendaftar Baru');
        } elseif (request()->input('daftar-baru') == 3) {
            return $this->tahsinbase('selesai-daftar-baru', null, 'Peserta Daftar Ulang');
        } else {
            return $this->tahsinbase('daftar-baru', null, 'Peserta Pendaftar Baru');
        }
    }

    public function getDaftarUjian()
    {
        if (request()->input('daftar-ujian') == 2) {
            return $this->tahsinbase('belum-daftar-ujian', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 3) {
            return $this->tahsinbase('pendaftar-belum-dinilai', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 4) {
            return $this->tahsinbase('belum-dinilai-semua-peserta', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 5) {
            return $this->tahsinbase('pendaftar-ujian-selesai', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 6) {
            return $this->tahsinbase('ujian-selesai-semua-peserta', null, 'Peserta Pendaftar Ujian');
        } else {
            return $this->tahsinbase('daftar-ujian', null, 'Peserta Pendaftar Ujian');
        }
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
        $data->nama_peserta           = request()->nama;
        $data->nohp_peserta           = request()->nohp;
        $data->level_peserta          = request()->level;
        $data->nama_pengajar          = request()->pengajar;
        $data->jadwal_tahsin          = request()->hari.' '.request()->jam;
        $data->jenis_peserta          = request()->jenis;
        $data->waktu_lahir_peserta    = request()->tgllahir;
        $data->status_peserta         = request()->status;
        $data->jenis_pembelajaran     = request()->pembelajaran;
        $data->save();

        return redirect()->back()->withFlashSuccess($data->no_tahsin.' - '.$data->nama_peserta.' Berhasil Diperbaruhi !');
    }

    public function getDeletePeserta()
    {
        $data = Tahsin::find($this->id);
        $data->delete();

        return redirect()->back()->withFlashSuccess($data->no_tahsin.' - '.$data->nama_peserta.' Berhasil Dihapus !');
    }

    public function getAktifPeserta()
    {
        $data = Tahsin::find($this->id);
        $data->status_keaktifan = 'AKTIF';
        $data->save();

        return redirect()->back()->withFlashSuccess($data->no_tahsin.' - '.$data->nama_peserta.' Berhasil Diperbaruhi !');
    }

    public function getCutiPeserta()
    {
        $data = Tahsin::find($this->id);
        $data->status_keaktifan = 'CUTI';
        $data->save();

        return redirect()->back()->withFlashSuccess($data->no_tahsin.' - '.$data->nama_peserta.' Berhasil Diperbaruhi dengan status Cuti !');
    }

    public function getOffPeserta()
    {
        $data = Tahsin::find($this->id);
        $data->status_keaktifan = 'OFF';
        $data->save();

        return redirect()->back()->withFlashSuccess($data->no_tahsin.' - '.$data->nama_peserta.' Berhasil Diperbaruhi dengan status Off !');
    }

    // FUNGSI UNTUK PERBAIKAN BUG PEMBUATAN AWAL YG TIDAK DISERTAI RELASI KE TABEL PESERTA UJIAN - SATU KALI SAJA
    // public function getUpdateIdTahsin()
    // {
    //     $dataujian = PesertaUjian::where('id_tahsin', '=', NULL)->get();

    //     foreach($dataujian as $data){
    //         $datatahsin = Tahsin::where('no_tahsin', '=', $data->no_tahsin)
    //                             ->where('angkatan_peserta',  $data->angkatan_ujian)
    //                             ->first();
    //         if ($datatahsin) {
    //             $update = PesertaUjian::where('no_tahsin', '=', $datatahsin->no_tahsin)
    //                             ->where('angkatan_ujian',  $datatahsin->angkatan_peserta)
    //                             ->first();
    //             if ($update) {
    //                 $update->id_tahsin = $datatahsin->id;
    //                 $update->save();
    //             }
    //         }
    //     }
    //     return 'OK';
    // }

    // TAMBAH KOLOM status_keaktifan
    // ALTER TABLE `tahsins` ADD `status_keaktifan` VARCHAR(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'AKTIF' AFTER `status_kelulusan`;
}
