<?php

namespace App\Http\Controllers\Backend\Tahsin;

use App\Http\Controllers\Controller;
use App\Models\Tahsin;
use DB;
use App\Models\PesertaUjian;
use App\Models\StatusPesertaTahsin;
use App\Models\LevelTahsin;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Builder;

class PembayaranController extends Controller
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
        $this->angkatan      = request()->angkatan ?? 21;
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

    public function pembayaran($statusdaftar, $statuskeaktifan)
    {
        $this->statusdaftar    = $statusdaftar;
        $this->statuskeaktifan = $statuskeaktifan;
        return Pembayaran::whereHas('tahsin', function (Builder $query){
                            $query->cari($this->cari)
                            ->cariLevel($this->level)
                            ->jenis($this->jenis)
                            ->angkatan($this->angkatan)
                            ->pengajar($this->pengajar)
                            ->statusPeserta($this->status)
                            ->statusKeaktifan($this->statuskeaktifan)
                            ->statusDaftar($this->statusdaftar, $this->angkatan);
                        })
                        ->paginate(10);
    }

    public function pembayaranbase($statusA, $statusB, $titleA)
    {
        $status_       = $statusA;
        $tahsins       = $this->tahsin($statusA, $statusB);
        $pembayarans   = $this->pembayaran($statusA, $statusB);
        $dataangkatan  = $this->listangkatan;
        $datalevel     = $this->listlevel;
        $datapengajars = $this->listpengajar;
        $liststatus    = $this->liststatuspeserta;
        $title         = $titleA;

        return view('backend.pendidikan.tahsin.pembayaran',
            compact('tahsins', 'title', 'datalevel', 'datapengajars', 'status_', 'dataangkatan', 'liststatus', 'pembayarans'));
    }

    public function getDaftarUlang()
    {
        return $this->pembayaranbase('daftar-ulang', null, 'Peserta Daftar Ulang');
    }

    public function getDaftarBaru()
    {
        return $this->pembayaranbase('daftar-baru', null, 'Peserta Pendaftar Baru');
    }

    public function getDaftarUjian()
    {
        return $this->pembayaranbase('daftar-ujian', null, 'Peserta Pendaftar Ujian');
    }

    public function getSpp()
    {
        $statusA = NULL;
        $statusB = 'AKTIF';
        $titleA  = 'Peserta Aktif';

        $status_       = $statusA;
        $tahsins       = $this->tahsin($statusA, $statusB);
        $pembayarans   = $this->pembayaran($statusA, $statusB);
        $dataangkatan  = $this->listangkatan;
        $datalevel     = $this->listlevel;
        $datapengajars = $this->listpengajar;
        $liststatus    = $this->liststatuspeserta;
        $title         = $titleA;

        return view('backend.pendidikan.tahsin.pembayaran-tahsin',
            compact('tahsins', 'title', 'datalevel', 'datapengajars', 'status_', 'dataangkatan', 'liststatus', 'pembayarans'));
        // return $this->pembayaranbase(null, 'AKTIF', 'Peserta Aktif');
    }

    public function postUpdatePembayaran()
    {
        $data = Tahsin::find($this->id);
        $data->save();
    }
}
