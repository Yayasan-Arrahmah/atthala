<?php

namespace App\Http\Controllers\Backend\Tahsin;

use App\Http\Controllers\Controller;
use App\Models\Tahsin;
use DB;
use App\Models\PesertaUjian;
use App\Models\StatusPesertaTahsin;
use App\Models\LevelTahsin;
use App\Models\Jadwal;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Throwable;

class AdministrasiController extends Controller
{
    /**
     * @suppress PHP0418
     */
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
        $this->angkatan      = request()->input('daftar-ulang') == 2 ? request()->angkatan-1 : (request()->angkatan ?? 22);
        $this->angkatanbaru  = request()->angkatan ?? 22;
        $this->angkatanujian = request()->angkatan ?? 21;
        $this->status        = request()->status ?? null;
        $this->listpengajar  = Tahsin::select('nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
                                ->groupBy('nama_pengajar', 'jenis_peserta')
                                ->where('nama_pengajar', '!=', NULL)
                                ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
                                // ->angkatan($this->angkatan)
                                ->get();
        $this->listangkatan  = Tahsin::select('angkatan_peserta')
                                ->groupBy('angkatan_peserta')
                                ->orderBy('angkatan_peserta', 'desc')
                                ->get();
        $this->liststatuspeserta = StatusPesertaTahsin::get();
        $this->listlevel         = LevelTahsin::orderBy('id', 'asc')->get();
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
                    ->when($this->kenaikanlevel, function($query){
                        if ($this->kenaikanlevel != 'SEMUA') {
                            $query->where('kenaikan_level_peserta', $this->kenaikanlevel);
                        }
                    })
                    ->paginate(request()->perPage ?? 10);
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
        if (request()->input('notif-daftar-ulang') == 1) {
            # code...
        $notif = 'Assalamualaikum Warohmatullahi Wabarokaatuh,

Bismillah,
Bapak/Ibu yang sama-sama mengharapkan ridho Allah Subhanahu Wataala,
Sebentar lagi kita akan memasuki pembelajaran Tahsin Angkatan 22,
Mari tetap jaga semangat untuk belajar Al Qur`an dengan mendaftarkan ulang di kelas tahsin bersama LTTQ Ar Rahmah Balikpapan.

Ayo Bapak/Ibu silakan klik link dibawah ini ya untuk mendapatkan Jadwal Tahsinnya.
https://atthala.arrahmahbalikpapan.or.id/tahsin/daftar-ulang-peserta/daftar?id='.request()->notahsin.'&idt='.request()->id.'&nama='.str_replace(' ', '+', request()->nama).'

Terima Kasih, Semoga Allah Subhanahu Wa Taala memberikan sifat keistiqomahan kepada kita semua untuk selalu belajar Al Qur`an.

Salam,
Dari kami yang menyayangimu
*Pengurus LTTQ Ar Rahmah Balikpapan*';

        try {
            $datapeserta = Tahsin::find(request()->id);
            $datapeserta->notif_daftar_ulang = $datapeserta->notif_daftar_ulang+1;
            $datapeserta->save();

            $this->notifwa(request()->notelp, $notif);

        } catch (\Throwable $th) {
            return redirect()->back()->withFlashDanger(request()->notahsin.' - '.request()->nama.' Terjadi Kesalahan. Notifikasi tidak terkirim !. Mohon Ulangi');
        }

        return redirect()->back()->withFlashSuccess(request()->notahsin.' - '.request()->nama.' Notifikasi Daftar Ulang berhasil dikirim !');

        }

        if (request()->input('daftar-ulang') == 2) {
            return $this->tahsinbase('belum-daftar-ulang', null, 'Peserta Daftar Ulang');
        } else {
            return $this->tahsinbase('daftar-ulang', null, 'Peserta Daftar Ulang');
        }
    }

    public function getBaru()
    {
        if (request()->input('notif-pilih-jadwal') == 1) {
            # code...
        $notif = 'Assalamualaikum Warohmatullahi Wabarokaatuh,

Bismillah,
Bapak/Ibu Peserta Tahsin Angkatan 22,
Mengingatkan kembali bahwa Bapak/Ibu belum memilih jadwal belajar tahsin.

Silakan klik tautan di bawah ini untuk mendapatkan tempat di jadwal belajar tersebut.
https://atthala.arrahmahbalikpapan.or.id/tahsin/pendaftaran/peserta?id='.request()->notahsin.'

Terima Kasih, Semoga Allah Subhanahu Wa Taala memberikan sifat keistiqomahan kepada kita semua untuk selalu belajar Al Qur`an.

Salam,
Panitia Pendaftaran Tahsin
*LTTQ Ar Rahmah Balikpapan*';

        try {
            $datapeserta = Tahsin::find(request()->id);
            $datapeserta->notif_pilih_jadwal = $datapeserta->notif_pilih_jadwal+1;
            $datapeserta->save();

            $this->notifwa(request()->notelp, $notif);

        } catch (\Throwable $th) {
            return redirect()->back()->withFlashDanger(request()->notahsin.' - '.request()->nama.' Terjadi Kesalahan. Notifikasi tidak terkirim !. Mohon Ulangi');
        }

        return redirect()->back()->withFlashSuccess(request()->notahsin.' - '.request()->nama.' Notifikasi Daftar Ulang berhasil dikirim !');

        }

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
        if (request()->input('daftar-ujian') == 1 && request()->input('proses-ujian') == 'SEMUA') {
            return $this->tahsinbase('ujian-1-semua', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 1 && request()->input('proses-ujian') == 1) {
            return $this->tahsinbase('ujian-1-1', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 1 && request()->input('proses-ujian') == 2) {
            return $this->tahsinbase('ujian-1-2', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 2 && request()->input('proses-ujian') == 'SEMUA') {
            return $this->tahsinbase('ujian-2-semua', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 2 && request()->input('proses-ujian') == 1) {
            return $this->tahsinbase('ujian-2-1', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 2 && request()->input('proses-ujian') == 2) {
            return $this->tahsinbase('ujian-2-2', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 'SEMUA' && request()->input('proses-ujian') == 1) {
            return $this->tahsinbase('ujian-semua-1', null, 'Peserta Pendaftar Ujian');
        } elseif (request()->input('daftar-ujian') == 'SEMUA' && request()->input('proses-ujian') == 2) {
            return $this->tahsinbase('ujian-semua-2', null, 'Peserta Pendaftar Ujian');
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

    public function postUjianUpdateLevel()
    {
        $data = Tahsin::find($this->id);
        $data->kenaikan_level_peserta = request()->kenaikanlevel;
        $data->save();

        return redirect()->back()->withFlashSuccess($data->no_tahsin.' - '.$data->nama_peserta.' Berhasil Diperbaruhi, Level Kenaikan Ujian !');
    }

    public function getDashboard()
    {
        $dataangkatan  = $this->listangkatan;
        $d_angkatan    = Tahsin::select('angkatan_peserta')
                            ->groupBy('angkatan_peserta')
                            ->orderBy('angkatan_peserta', 'asc')
                            ->get();
        $datalevel     = $this->listlevel;

        foreach ($d_angkatan as $data_total) {
            $total_angkatan[]                     = (int)$data_total->angkatan_peserta;
            $total_peserta[]                      = Tahsin::whereNotNull('level_peserta')->angkatan($data_total->angkatan_peserta)->count();
            $total_peserta_daftar_baru[]          = Tahsin::daftarBaru($data_total->angkatan_peserta)->angkatan($data_total->angkatan_peserta)->count();
            $total_peserta_daftar_ulang[]         = Tahsin::whereNotNull('level_peserta')->daftarUlang($data_total->angkatan_peserta)->angkatan($data_total->angkatan_peserta)->count();
            $total_peserta_tidak_daftar_ulang[]   = Tahsin::whereNotNull('level_peserta')->tidakDaftarUlang($data_total->angkatan_peserta-1)->angkatan($data_total->angkatan_peserta-1)->count();
            $total_peserta_tidak_ujian[]          = Tahsin::whereNotNull('level_peserta')->whereNull('kenaikan_level_peserta')->angkatan($data_total->angkatan_peserta)->count();
            $total_peserta_tidak_naik_level[]     = Tahsin::whereNotNull('level_peserta')->whereRaw('tahsins.level_peserta != tahsins.kenaikan_level_peserta')->whereNotNull('kenaikan_level_peserta')->angkatan($data_total->angkatan_peserta)->count();
            $total_peserta_ikhwan[]               = Tahsin::whereNotNull('level_peserta')->ikhwan()->angkatan($data_total->angkatan_peserta)->count();
            $total_peserta_akhwat[]               = Tahsin::whereNotNull('level_peserta')->akhwat()->angkatan($data_total->angkatan_peserta)->count();
            $total_peserta_alhaq[]                = Tahsin::whereNotNull('level_peserta')->where('kenaikan_level_peserta', 'TAJWIDI 1')->angkatan($data_total->angkatan_peserta)->count();
        }

        $statistik_utama = [
            'total_angkatan'                   => $total_angkatan ?? 0,
            'total_peserta'                    => $total_peserta ?? 0,
            'total_peserta_daftar_baru'        => $total_peserta_daftar_baru ?? 0,
            'total_peserta_daftar_ulang'       => $total_peserta_daftar_ulang ?? 0,
            'total_peserta_tidak_daftar_ulang' => $total_peserta_tidak_daftar_ulang ?? 0,
            'total_peserta_tidak_ujian'        => $total_peserta_tidak_ujian ?? 0,
            'total_peserta_tidak_naik_level'   => $total_peserta_tidak_naik_level ?? 0,
            'total_peserta_ikhwan'             => $total_peserta_ikhwan ?? 0,
            'total_peserta_akhwat'             => $total_peserta_akhwat ?? 0,
            'total_peserta_alhaq'              => $total_peserta_alhaq ?? 0,
        ];

        // DETAIL CHART
        $peserta_daftar_baru          = Tahsin::daftarBaru($this->angkatan)->angkatan($this->angkatan)->count();
        $peserta_daftar_ulang         = Tahsin::whereNotNull('level_peserta')->daftarUlang($this->angkatan)->angkatan($this->angkatan)->count();
        $peserta_tidak_daftar_ulang   = Tahsin::whereNotNull('level_peserta')->tidakDaftarUlang($this->angkatan-1)->angkatan($this->angkatan-1)->count();
        $peserta_ikhwan               = Tahsin::whereNotNull('level_peserta')->ikhwan()->angkatan($this->angkatan)->count();
        $peserta_akhwat               = Tahsin::whereNotNull('level_peserta')->akhwat()->angkatan($this->angkatan)->count();
        $peserta_ikhwan_daftar_baru   = Tahsin::whereNotNull('level_peserta')->ikhwan()->angkatan($this->angkatan)->daftarBaru($this->angkatan)->count();
        $peserta_akhwat_daftar_baru   = Tahsin::whereNotNull('level_peserta')->akhwat()->angkatan($this->angkatan)->daftarBaru($this->angkatan)->count();
        $peserta_naik_level           = Tahsin::whereRaw('tahsins.level_peserta = tahsins.kenaikan_level_peserta')
                                        ->whereNotNull('level_peserta')
                                        ->whereNotNull('kenaikan_level_peserta')
                                        ->angkatan($this->angkatan)->count();
        $peserta_tidak_naik_level     = Tahsin::whereRaw('tahsins.level_peserta != tahsins.kenaikan_level_peserta')
                                        ->whereNotNull('level_peserta')
                                        ->whereNotNull('kenaikan_level_peserta')
                                        ->angkatan($this->angkatan)->count();
        $peserta_ujian                = Tahsin::whereNotNull('kenaikan_level_peserta')
                                        ->angkatan($this->angkatan)->count();
        $peserta_tidak_ujian          = Tahsin::whereNotNull('level_peserta')
                                        ->whereNull('kenaikan_level_peserta')
                                        ->angkatan($this->angkatan)->count();
        $peserta_aktif                = Tahsin::whereNotNull('level_peserta')->angkatan($this->angkatan)->get();


        foreach ($datalevel as $d_level) {
            $statistik_level[] = [
                strval($d_level->nama) => Tahsin::where('level_peserta', $d_level->nama)->angkatan($this->angkatan)->count(),
            ];
        }

        foreach ($datalevel as $d_level_daftar_baru) {
            $statistik_level_daftar_baru[] = [
                strval($d_level_daftar_baru->nama) => Tahsin::daftarBaru($this->angkatan)->where('level_peserta', $d_level_daftar_baru->nama)->angkatan($this->angkatan)->count(),
            ];
        }

        foreach ($datalevel as $d_level_daftar_ulang) {
            $statistik_level_daftar_ulang[] = [
                strval($d_level_daftar_ulang->nama) => Tahsin::daftarUlang($this->angkatan)->where('level_peserta', $d_level_daftar_ulang->nama)->angkatan($this->angkatan)->count(),
            ];
        }

        foreach ($datalevel as $d_level_ikhwan) {
            $statistik_level_ikhwan[] = [
                strval($d_level_ikhwan->nama) => Tahsin::ikhwan()->where('level_peserta', $d_level_ikhwan->nama)->angkatan($this->angkatan)->count(),
            ];
        }

        foreach ($datalevel as $d_level_akhwat) {
            $statistik_level_akhwat[] = [
                strval($d_level_akhwat->nama) => Tahsin::akhwat()->where('level_peserta', $d_level_akhwat->nama)->angkatan($this->angkatan)->count(),
            ];
        }

        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $e = 0;
        $f = 0;
        foreach ($peserta_aktif as $data_k){
            if ($data_k->waktu_lahir_peserta) {
                $kategori_umur = Carbon::createFromFormat('d-m-Y', $data_k->waktu_lahir_peserta)->age;
                $tes[] =  $kategori_umur;
                if ($kategori_umur < 17) {
                    $a++;
                } elseif ($kategori_umur >= 17 && $kategori_umur <= 25) {
                    $b++;
                } elseif ($kategori_umur >= 26 && $kategori_umur <= 35) {
                    $c++;
                } elseif ($kategori_umur >= 36 && $kategori_umur <= 45) {
                    $d++;
                } elseif ($kategori_umur >= 46 && $kategori_umur <= 55) {
                    $e++;
                } elseif ($kategori_umur > 55) {
                    $f++;
                }
            }
        }

        $statistik = [
            'peserta_daftar_baru'        => $peserta_daftar_baru ?? 0,
            'peserta_daftar_ulang'       => $peserta_daftar_ulang ?? 0,
            'peserta_tidak_daftar_ulang' => $peserta_tidak_daftar_ulang ?? 0,
            'peserta_ikhwan'             => $peserta_ikhwan ?? 0,
            'peserta_akhwat'             => $peserta_akhwat ?? 0,
            'peserta_ikhwan_daftar_baru' => $peserta_ikhwan_daftar_baru ?? 0,
            'peserta_akhwat_daftar_baru' => $peserta_akhwat_daftar_baru ?? 0,
            'peserta_naik_level'         => $peserta_naik_level ?? 0,
            'peserta_tidak_naik_level'   => $peserta_tidak_naik_level ?? 0,
            'peserta_ujian'              => $peserta_ujian ?? 0,
            'peserta_tidak_ujian'        => $peserta_tidak_ujian ?? 0,
            'peserta_umur_1'             => $a,
            'peserta_umur_2'             => $b,
            'peserta_umur_3'             => $c,
            'peserta_umur_4'             => $d,
            'peserta_umur_5'             => $e,
            'peserta_umur_6'             => $f,
        ];

        return view('backend.pendidikan.tahsin.dashboard',
            compact('dataangkatan', 'statistik_utama', 'statistik', 'statistik_level', 'statistik_level_daftar_baru', 'statistik_level_daftar_ulang', 'statistik_level_ikhwan', 'statistik_level_akhwat', 'datalevel'));
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

    public function getPerbaikanUuid()
    {
        $data = Tahsin::whereNull('uuid')->get();

        foreach ($data as $d) {
            try {
                $d->uuid = Str::uuid();
                $d->save();
            } catch (\Throwable $th) {
                return $th;
            }
        }

        return 'oke';
    }

    /**
     * @suppress PHP0418
     */
    public function getKodeunik()
    {
        $data = Tahsin::where('angkatan_peserta', '22')
                        ->orWhere('angkatan_peserta', 22)
                        ->get();
        $no_ = 1;
        foreach ($data as $d) {
            try {
                $d->kode_unik = str_pad( $no_, 4, '0', STR_PAD_LEFT);
                $d->save();

                $no_++;
            } catch (\Throwable $th) {
                return $th;
            }
        }

        return 'perbaruhi kode unik berhasil';
    }

    public function getCariJadwal()
    {
        $data     = explode(" ",request()->q);
        $jadwals  = Jadwal::query();

        $jadwals->select("id","pengajar_jadwal", "level_jadwal", "hari_jadwal", "waktu_jadwal", "status_belajar",  "jenis_jadwal", "angkatan_jadwal")
                ->where('angkatan_jadwal', 22);

        foreach($data as $d){
            $this->q_ = $d;
            $jadwals->where(function ($query) {
                $query->whereRaw('LOWER(pengajar_jadwal) LIKE ? ', '%' . strtolower($this->q_) . '%')
                ->orWhereRaw('LOWER(level_jadwal) LIKE ? ', '%' . strtolower($this->q_) . '%')
                ->orWhereRaw('LOWER(hari_jadwal) LIKE ? ', '%' . strtolower($this->q_) . '%')
                ->orWhereRaw('LOWER(waktu_jadwal) LIKE ? ', '%' . strtolower($this->q_) . '%')
                ->orWhereRaw('LOWER(status_belajar) LIKE ? ', '%' . strtolower($this->q_) . '%')
                ->orWhereRaw('LOWER(jenis_jadwal) LIKE ? ', '%' . strtolower($this->q_) . '%');
            });
        }
        return response()->json($jadwals->get());
    }

    public function getTeskirim()
    {
        $nohp='8125144744';
        $pesan='tes';
        $this->notifwa('62'.$nohp, $pesan);

        return 'tes wa';
    }

    public function getSeting()
    {
        settings()->set('foo', 'mantap');

        $tes = settings()->get('foo');

        return $tes;
    }

    public function getOke()
    {
        $tes = settings()->get('foo');

        return $tes;
    }
}
