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

    public function pembayaranujianbase($statusdaftar, $statuskeaktifan)
    {
        $this->statusdaftar    = $statusdaftar;
        $this->statuskeaktifan = $statuskeaktifan;
        return PesertaUjian::whereHas('tahsin', function (Builder $query){
                            $query->cari($this->cari)
                            ->cariLevel($this->level)
                            ->jenis($this->jenis)
                            ->pengajar($this->pengajar)
                            ->statusPeserta($this->status)
                            ->statusKeaktifan($this->statuskeaktifan)
                            ->when(request()->input('kenaikan-level'), function($query){
                                if (request()->input('kenaikan-level') != 'SEMUA') {
                                    $query->where('kenaikan_level_peserta', request()->input('kenaikan-level'));
                                }
                            })
                            ->when(request()->input('proses-ujian'), function($query){
                                if (request()->input('proses-ujian') != 'SEMUA') {
                                    if (request()->input('proses-ujian') == 1) {
                                        $query->whereNotNull('kenaikan_level_peserta');
                                    } elseif (request()->input('proses-ujian') == 2) {
                                        $query->whereNull('kenaikan_level_peserta');
                                    }
                                }
                            });
                        })
                        ->where('angkatan_ujian', $this->angkatan)
                        ->orderBy('created_at', 'ASC')
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

        if ($status_ == null) {
            return view('backend.pendidikan.tahsin.pembayaran-tahsin',
                compact('tahsins', 'title', 'datalevel', 'datapengajars', 'status_', 'dataangkatan', 'liststatus'));
        } else {
            return view('backend.pendidikan.tahsin.pembayaran',
                compact('tahsins', 'title', 'datalevel', 'datapengajars', 'status_', 'dataangkatan', 'liststatus'));
        }

    }

    public function getDaftarUlang()
    {
        return $this->tahsinbase('daftar-ulang-pembayaran', null, 'Peserta Daftar Ulang');
    }

    public function getDaftarBaru()
    {
        return $this->tahsinbase('daftar-baru-pembayaran', null, 'Peserta Pendaftar Baru');
    }

    public function getDaftarUjian()
    {
        $statusA    = 'daftar-ujian-pembayaran';
        $statusB    = null;
        $titleA     = 'Peserta Pendaftar Ujian';

        $status_          = $statusA;
        $pesertaujians    = $this->pembayaranujianbase($statusA, $statusB);
        $dataangkatan     = $this->listangkatan;
        $datalevel        = $this->listlevel;
        $datapengajars    = $this->listpengajar;
        $liststatus       = $this->liststatuspeserta;
        $title            = $titleA;

        return view('backend.pendidikan.tahsin.pembayaran-ujian',
            compact('title', 'datalevel', 'datapengajars', 'status_', 'dataangkatan', 'liststatus', 'pesertaujians'));

        // return $this->pembayaranbase('daftar-ujian', null, 'Peserta Pendaftar Ujian');
    }

    public function pembayaransppbase($statusdaftar, $statuskeaktifan)
    {
        $this->statusdaftar    = $statusdaftar;
        $this->statuskeaktifan = $statuskeaktifan;
        return Pembayaran::whereHas('tahsinspp', function (Builder $query){
                            $query->cari($this->cari)
                            ->cariLevel($this->level)
                            ->jenis($this->jenis)
                            ->pengajar($this->pengajar)
                            ->where('angkatan_peserta', $this->angkatan)
                            ->statusPeserta($this->status)
                            ->statusKeaktifan($this->statuskeaktifan)
                            ;
                        })
                        ->where('jenis_pembayaran', 'SPP TAHSIN')
                        ->orderBy('created_at', 'ASC')
                        ->paginate(10);
    }

    public function getSpp()
    {
        $statusA    = 'spp-pembayaran';
        $statusB    = null;
        $titleA     = 'Peserta Pembayaran Form SPP';

        $status_          = $statusA;
        $pembayaranspp    = $this->pembayaransppbase($statusA, $statusB);
        $dataangkatan     = $this->listangkatan;
        $datalevel        = $this->listlevel;
        $datapengajars    = $this->listpengajar;
        $liststatus       = $this->liststatuspeserta;
        $title            = $titleA;

        return view('backend.pendidikan.tahsin.pembayaran-spp',
            compact('title', 'datalevel', 'datapengajars', 'status_', 'dataangkatan', 'liststatus', 'pembayaranspp'));
        // return $this->pembayaransppbase(null, 'AKTIF', 'Peserta Aktif');
    }

    public function getRekapitulasi()
    {
        return $this->tahsinbase(null, 'AKTIF', 'Peserta Aktif');
    }

    public function postUpdatePembayaran()
    {
        $data = Tahsin::find($this->id);
        $data->save();
    }
}
