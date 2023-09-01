<?php

namespace App\Http\Controllers\Frontend\Tahsin;

use App\Http\Controllers\Controller;
use App\Models\Tahsin;
use DB;
use App\Models\PesertaUjian;
use App\Models\StatusPesertaTahsin;
use App\Models\LevelTahsin;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Builder;
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
        $this->filterpengajar= Tahsin::select('nama_pengajar')
                                ->groupBy('nama_pengajar')
                                ->whereNotNull('nama_pengajar')
                                ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
                                ->get();
        $this->listangkatan  = Tahsin::select('angkatan_peserta')
                                ->groupBy('angkatan_peserta')
                                ->orderBy('angkatan_peserta', 'desc')
                                ->get();
        $this->liststatuspeserta = StatusPesertaTahsin::get();
        $this->listlevel         = LevelTahsin::get();
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

    // public function convertnotif($isi)
    // {
    //     $notifikasi = str_replace('{Nama}', $this->nama, $isi);
    //     $notifikasi = str_replace('{E-mail}', $this->email, $notifikasi);
    //     $notifikasi = str_replace('{Panggilan}', $this->panggilan, $notifikasi);
    //     $notifikasi = str_replace('{Gender}', $this->gender, $notifikasi);
    //     $notifikasi = str_replace('{No. Telepon}', $this->nohp, $notifikasi);
    //     $notifikasi = str_replace('{Kota}', $this->kota, $notifikasi);
    //     $notifikasi = str_replace('{Nominal Transfer}', $this->total, $notifikasi);
    //     $notifikasi = str_replace('{Ekspedisi}', $this->ekspedisi, $notifikasi);
    //     $notifikasi = str_replace('{Jumlah Buku}', $this->jmlh_buku, $notifikasi);
    //     $notifikasi = str_replace('{Alamat}', $this->alamat, $notifikasi);

    //     return $notifikasi;
    // }

    public function notifwa($nomorhp, $isipesan)
    {
        $datawa = json_decode($isipesan);

        $data = array(
            "phone_no"  => '62'.$nomorhp,
            "key"		=> env('WA_KEY'),
            "message"	=> $isipesan,
            // "message"	=> $this->convertnotif($datawa->isi),
            "skip_link"	=> True // This optional for skip snapshot of link in message
        );
        $data_string = json_encode($data);

        $ch = curl_init(env('WA_URL'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        echo $res=curl_exec($ch);
        curl_close($ch);
    }

    public function moota()
    {
        $data = Moota::mutation($bankId = env('MOOTA_BANK_ID'))->amount(200317);
        $data_trans = $data['data'][0] ?? null;
        if ($data_trans != null) {
            $mutation_id    = data_get($data_trans, 'mutation_id') ?? null;
            $amount         = data_get($data_trans, 'amount') ?? null;
            $description    = data_get($data_trans, 'description') ?? null;
            $created_at     = data_get($data_trans, 'created_at') ?? null;

            return $created_at;
        } else {
            return 'Tidak Ada Data';
        }
    }

    public function sppcari()
    {
        if (!empty(request()->input('namapeserta'))) {
            $pencarian = Tahsin::where('nama_peserta', 'like', '%' . request()->input('namapeserta') . '%')
                ->where('level_peserta', '=', request()->input('level'))
                ->where('nama_pengajar', '=', request()->input('pengajar'))
                ->where('angkatan_peserta', '=', request()->input('angkatan') ?? session('angkatan_tahsin'))
                ->get();
        } else {
            $pencarian = null;
        }
        $datapengajars = $this->filterpengajar;
        $datalevel     = $this->listlevel;

        return view('frontend.pendidikan.tahsin.spp-cari', compact('datapengajars', 'datalevel', 'pencarian'));
    }

    public function spp($uuid)
    {
        $peserta = Tahsin::where('uuid', $uuid)->first();
        return view('frontend.pendidikan.tahsin.spp', compact('peserta'));
    }
}
