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
use Illuminate\Support\Facades\Http;
use Throwable;
// use Rimbaborne\Moota\Facades\Moota;

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
        $this->angkatan      = request()->input('daftar-ulang') == 2 ? request()->angkatan-1 : (request()->angkatan ?? 22);
        $this->angkatanbaru  = request()->angkatan ?? 22;
        $this->angkatanujian = request()->angkatan ?? 21;
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

    public function notifwa($nomorhp, $isipesan)
    {
        // $datawa = json_decode($isipesan);

        $apikey     = env('WAHA_API_KEY');
        $url        = env('WAHA_API_URL');
        $sessionApi = env('WAHA_API_SESSION');
        $requestApi = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'X-Api-Key'    => $apikey,
        ]);

        // SOP based on https://waha.devlike.pro/docs/overview/how-to-avoid-blocking/

        try {
            #1 Send Seen
            $requestApi->post($url.'/api/sendSeen', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            #2 Start Typing
            $requestApi->post($url.'/api/startTyping', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            sleep(1); // jeda seolah olah ngetik

            #3 Stop Typing
            $requestApi->post($url.'/api/stopTyping', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            #4 Send Message
            $requestApi->post($url.'/api/sendText', [
                "session" => $sessionApi,
                "chatId"  => $nomorhp.'@c.us',
                "text"    => $isipesan,
            ]);
        } catch (Throwable $th) {
            throw $th;
        }
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
        if (request()->metode == 'update') {

            $data = Pembayaran::find(request()->id);
            $data->admin_pembayaran = 'BERHASIL';
            $data->save();

            $pesan =
                'Assalamualaikum Warohmatullahi Wabarokaatuh,

Telah dikirimkan pembayaran SPP dengan detail sebagai berikut :

Nama Peserta : '.$data->tahsin->nama_peserta.'
NIS : '.$data->tahsin->no_tahsin.'
Level/Kelas : '.$data->tahsin->level_peserta.' / '.$data->tahsin->jadwal_tahsin.'
Pengajar : '.$data->tahsin->nama_pengajar.'
Nominal SPP : '.$data->nominal_pembayaran.'
Keterangan : Pembayaran SPP Bulan Ke '.$data->keterangan_pembayaran.'

Klik link berikut untuk memeriksa riwayat pembayaran
https://atthala.arrahmahbalikpapan.or.id/tahsin/pembayaran/cari?namapeserta='.str_replace(" ","+",$data->tahsin->nama_peserta).'&level='.str_replace(" ","+",$data->tahsin->level_peserta).'&pengajar='.str_replace(" ","+",$data->tahsin->nama_pengajar).'

Tim Tahsin
LTTQ Arrahmah Balikpapan
';

            $this->notifwa('62'.$data->tahsin->nohp_peserta, $pesan);

            return redirect()->back()
                ->withFlashSuccess(request()->notahsin.' Konfirmasi Pembayaran Berhasil');

        }

        if (request()->metode == 'nominal') {

            $data = Pembayaran::find(request()->id);
            $nominal_lama = $data->nominal_pembayaran;
            $data->nominal_pembayaran = request()->nominalupdate;
            $data->save();

            return redirect()->back()
                ->withFlashSuccess($data->tahsinspp->nama_peserta.', Nominal '.$nominal_lama.' menjadi '.$data->nominal_pembayaran.' Berhasil Diupdate');

        }

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

    public function getPembayaransppbase($statusdaftar, $statuskeaktifan)
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

    public function getRekapitulasi()
    {
        $statusA = NULL;
        $statusB = 'AKTIF';
        $titleA  = 'Peserta Aktif';

        $status_       = $statusA;
        $tahsins       = $this->tahsin($statusA, $statusB);
        $dataangkatan  = $this->listangkatan;
        $datalevel     = $this->listlevel;
        $datapengajars = $this->listpengajar;
        $liststatus    = $this->liststatuspeserta;
        $title         = $titleA;
        // return $this->tahsinbase(null, 'AKTIF', 'Peserta Aktif');


        // $pembayaran_daftar_baru              = Pembayaran::jumlahdaftarbaru(null, $this->angkatan)->sum('nominal_pembayaran');
        // $pembayaran_daftar_ulang             = Pembayaran::jumlahdaftarulang(null, $this->angkatan)->sum('nominal_pembayaran');
        // $pembayaran_daftar_ujian             = 0;
        // $pembayaran_spp                      = Pembayaran::jumlahspp(null, $this->angkatan)->sum('nominal_pembayaran');
        // $pembayaran_total                    = $pembayaran_daftar_baru + $pembayaran_daftar_ulang + $pembayaran_daftar_ujian + $pembayaran_spp;
        // $total_peserta_baru                  = Tahsin::whereNotNull('nama_pengajar')->where('no_tahsin', 'like', '%-'.$this->angkatan.'-%')->where('angkatan_peserta', $this->angkatan)->count();
        // $total_peserta_lama                  = Tahsin::whereNotNull('nama_pengajar')->where('no_tahsin', 'not like', '%-'.$this->angkatan.'-%')->where('angkatan_peserta', $this->angkatan)->count();
        // $total_pemasukan_peserta_baru        = $total_peserta_baru * 500000;
        // $total_pemasukan_peserta_lama        = $total_peserta_lama * 450000;
        // $total_pemasukan_peserta             = $total_pemasukan_peserta_baru + $total_pemasukan_peserta_lama;
        // $total_piutang                       = $total_pemasukan_peserta - $pembayaran_total;
        // $pembayaran_daftar_baru_ikhwan       = Pembayaran::jumlahdaftarbaru('IKHWAN', $this->angkatan)->sum('nominal_pembayaran');
        // $pembayaran_daftar_ulang_ikhwan      = Pembayaran::jumlahdaftarulang('IKHWAN', $this->angkatan)->sum('nominal_pembayaran');
        // $pembayaran_daftar_ujian_ikhwan      = 0;
        // $pembayaran_spp_ikhwan               = Pembayaran::jumlahspp('IKHWAN', $this->angkatan)->sum('nominal_pembayaran');
        // $pembayaran_total_ikhwan             = $pembayaran_daftar_baru_ikhwan + $pembayaran_daftar_ulang_ikhwan + $pembayaran_daftar_ujian_ikhwan + $pembayaran_spp_ikhwan;
        // $total_peserta_baru_ikhwan           = Tahsin::where('jenis_peserta', 'IKHWAN')->whereNotNull('nama_pengajar')->where('no_tahsin', 'like', '%-'.$this->angkatan.'-%')->where('angkatan_peserta', $this->angkatan)->count();
        // $total_peserta_lama_ikhwan           = Tahsin::where('jenis_peserta', 'IKHWAN')->whereNotNull('nama_pengajar')->where('no_tahsin', 'not like', '%-'.$this->angkatan.'-%')->where('angkatan_peserta', $this->angkatan)->count();
        // $total_pemasukan_peserta_baru_ikhwan = $total_peserta_baru_ikhwan * 500000;
        // $total_pemasukan_peserta_lama_ikhwan = $total_peserta_lama_ikhwan * 450000;
        // $total_pemasukan_peserta_ikhwan      = $total_pemasukan_peserta_baru_ikhwan + $total_pemasukan_peserta_lama_ikhwan;
        // $total_piutang_ikhwan                = $total_pemasukan_peserta_ikhwan - $pembayaran_total_ikhwan;
        // $pembayaran_daftar_baru_akhwat       = Pembayaran::jumlahdaftarbaru('AKHWAT', $this->angkatan)->sum('nominal_pembayaran');
        // $pembayaran_daftar_ulang_akhwat      = Pembayaran::jumlahdaftarulang('AKHWAT', $this->angkatan)->sum('nominal_pembayaran');
        // $pembayaran_daftar_ujian_akhwat      = 0;
        // $pembayaran_spp_akhwat               = Pembayaran::jumlahspp('AKHWAT', $this->angkatan)->sum('nominal_pembayaran');
        // $pembayaran_total_akhwat             = $pembayaran_daftar_baru_akhwat + $pembayaran_daftar_ulang_akhwat + $pembayaran_daftar_ujian_akhwat + $pembayaran_spp_akhwat;
        // $total_peserta_baru_akhwat           = Tahsin::where('jenis_peserta', 'AKHWAT')->whereNotNull('nama_pengajar')->where('no_tahsin', 'like', '%-'.$this->angkatan.'-%')->where('angkatan_peserta', $this->angkatan)->count();
        // $total_peserta_lama_akhwat           = Tahsin::where('jenis_peserta', 'AKHWAT')->whereNotNull('nama_pengajar')->where('no_tahsin', 'not like', '%-'.$this->angkatan.'-%')->where('angkatan_peserta', $this->angkatan)->count();
        // $total_pemasukan_peserta_baru_akhwat = $total_peserta_baru_akhwat * 500000;
        // $total_pemasukan_peserta_lama_akhwat = $total_peserta_lama_akhwat * 450000;
        // $total_pemasukan_peserta_akhwat      = $total_pemasukan_peserta_baru_akhwat + $total_pemasukan_peserta_lama_akhwat;
        // $total_piutang_akhwat                = $total_pemasukan_peserta_akhwat - $pembayaran_total_akhwat;

        $data_pembayaran=[
            // 'daftar_baru'          => $pembayaran_daftar_baru ?? 0,
            // 'daftar_ulang'         => $pembayaran_daftar_ulang ?? 0,
            // 'daftar_ujian'         => $pembayaran_daftar_ujian ?? 0,
            // 'spp'                  => $pembayaran_spp ?? 0,
            // 'total'                => $pembayaran_total ?? 0,
            // 'total_potensi'        => $total_pemasukan_peserta ?? 0,
            // 'total_piutang'        => $total_piutang ?? 0,
            // 'daftar_baru_ikhwan'   => $pembayaran_daftar_baru_ikhwan ?? 0,
            // 'daftar_ulang_ikhwan'  => $pembayaran_daftar_ulang_ikhwan ?? 0,
            // 'daftar_ujian_ikhwan'  => $pembayaran_daftar_ujian_ikhwan ?? 0,
            // 'spp_ikhwan'           => $pembayaran_spp_ikhwan ?? 0,
            // 'total_ikhwan'         => $pembayaran_total_ikhwan ?? 0,
            // 'total_potensi_ikhwan' => $total_pemasukan_peserta_ikhwan ?? 0,
            // 'total_piutang_ikhwan' => $total_piutang_ikhwan ?? 0,
            // 'daftar_baru_akhwat'   => $pembayaran_daftar_baru_akhwat ?? 0,
            // 'daftar_ulang_akhwat'  => $pembayaran_daftar_ulang_akhwat ?? 0,
            // 'daftar_ujian_akhwat'  => $pembayaran_daftar_ujian_akhwat ?? 0,
            // 'spp_akhwat'           => $pembayaran_spp_akhwat ?? 0,
            // 'total_akhwat'         => $pembayaran_total_akhwat ?? 0,
            // 'total_potensi_akhwat' => $total_pemasukan_peserta_akhwat ?? 0,
            // 'total_piutang_akhwat' => $total_piutang_akhwat ?? 0,
        ];

        // $varr = Pembayaran::jumlahdaftarulang(null, $this->angkatan)->get();
        // foreach ($varr as $key => $value) {
        //     $oke_[] = $value->jenis_pembayaran;
        // }
        // dd($oke_);
        // dd($data_pembayaran);

        return view('backend.pendidikan.tahsin.pembayaran-tahsin',
        compact('tahsins', 'title', 'datalevel', 'datapengajars', 'status_', 'dataangkatan', 'liststatus', 'data_pembayaran'));
    }

    public function postUpdatePembayaran()
    {
        $data = Tahsin::find($this->id);
        $data->save();
    }

    public function getDashboard()
    {
        # code...
    }

    // public function getMoota()
    // {
    //     // return Moota::mutation($bankId = env('MOOTA_BANK_ID'))->latest();
    //     $data = Moota::mutation($bankId = env('MOOTA_BANK_ID'))->amount(200317);
    //     $data_trans = $data['data'][0] ?? null;
    //     if ($data_trans != null) {
    //         $mutation_id    = data_get($data_trans, 'mutation_id') ?? null;
    //         $amount         = data_get($data_trans, 'amount') ?? null;
    //         $description    = data_get($data_trans, 'description') ?? null;
    //         $created_at     = data_get($data_trans, 'created_at') ?? null;

    //         return $created_at;
    //     } else {
    //         return 'Tidak Ada Data';
    //     }
    // }
}
