<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tahsin;
use Illuminate\Support\Carbon;
use App\Models\LevelTahsin;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // session()->forget('angkatan_tahsin');

        // return view('backend.dashboard');

        $this->angkatan = request()->angkatan ?? 21;
        $dataangkatan  = Tahsin::select('angkatan_peserta')
                        ->groupBy('angkatan_peserta')
                        ->orderBy('angkatan_peserta', 'desc')
                        ->get();
        $d_angkatan    = Tahsin::select('angkatan_peserta')
                            ->groupBy('angkatan_peserta')
                            ->orderBy('angkatan_peserta', 'asc')
                            ->get();
        $datalevel     = LevelTahsin::orderBy('id', 'asc')->get();

        // foreach ($d_angkatan as $data_total) {
        //     $total_angkatan[]                     = (int)$data_total->angkatan_peserta;
        //     $total_peserta[]                      = Tahsin::whereNotNull('level_peserta')->angkatan($data_total->angkatan_peserta)->count();
        //     $total_peserta_daftar_baru[]          = Tahsin::daftarBaru($data_total->angkatan_peserta)->angkatan($data_total->angkatan_peserta)->count();
        //     $total_peserta_daftar_ulang[]         = Tahsin::whereNotNull('level_peserta')->daftarUlang($data_total->angkatan_peserta)->angkatan($data_total->angkatan_peserta)->count();
        //     $total_peserta_tidak_daftar_ulang[]   = Tahsin::whereNotNull('level_peserta')->tidakDaftarUlang($data_total->angkatan_peserta-1)->angkatan($data_total->angkatan_peserta-1)->count();
        //     $total_peserta_tidak_ujian[]          = Tahsin::whereNotNull('level_peserta')->whereNull('kenaikan_level_peserta')->angkatan($data_total->angkatan_peserta)->count();
        //     $total_peserta_tidak_naik_level[]     = Tahsin::whereNotNull('level_peserta')->whereRaw('tahsins.level_peserta != tahsins.kenaikan_level_peserta')->whereNotNull('kenaikan_level_peserta')->angkatan($data_total->angkatan_peserta)->count();
        //     $total_peserta_ikhwan[]               = Tahsin::whereNotNull('level_peserta')->ikhwan()->angkatan($data_total->angkatan_peserta)->count();
        //     $total_peserta_akhwat[]               = Tahsin::whereNotNull('level_peserta')->akhwat()->angkatan($data_total->angkatan_peserta)->count();
        //     $total_peserta_alhaq[]                = Tahsin::whereNotNull('level_peserta')->where('kenaikan_level_peserta', 'TAJWIDI 1')->angkatan($data_total->angkatan_peserta)->count();
        // }

        $statistik_utama = [
            // 'total_angkatan'                   => $total_angkatan ?? 0,
            // 'total_peserta'                    => $total_peserta ?? 0,
            // 'total_peserta_daftar_baru'        => $total_peserta_daftar_baru ?? 0,
            // 'total_peserta_daftar_ulang'       => $total_peserta_daftar_ulang ?? 0,
            // 'total_peserta_tidak_daftar_ulang' => $total_peserta_tidak_daftar_ulang ?? 0,
            // 'total_peserta_tidak_ujian'        => $total_peserta_tidak_ujian ?? 0,
            // 'total_peserta_tidak_naik_level'   => $total_peserta_tidak_naik_level ?? 0,
            // 'total_peserta_ikhwan'             => $total_peserta_ikhwan ?? 0,
            // 'total_peserta_akhwat'             => $total_peserta_akhwat ?? 0,
            // 'total_peserta_alhaq'              => $total_peserta_alhaq ?? 0,
        ];

        // DETAIL CHART
        $peserta_daftar_baru          = Tahsin::daftarBaru($this->angkatan)->angkatan($this->angkatan)->count();
        $peserta_daftar_ulang         = Tahsin::whereNotNull('level_peserta')->daftarUlang($this->angkatan)->angkatan($this->angkatan)->count();
        $peserta_tidak_daftar_ulang   = Tahsin::whereNotNull('level_peserta')->tidakDaftarUlang($this->angkatan-1)->angkatan($this->angkatan-1)->count();
        $peserta_ikhwan               = Tahsin::whereNotNull('level_peserta')->ikhwan()->angkatan($this->angkatan)->count();
        $peserta_akhwat               = Tahsin::whereNotNull('level_peserta')->akhwat()->angkatan($this->angkatan)->count();
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
            compact('dataangkatan', 'statistik_utama', 'statistik', 'statistik_level', 'statistik_level_daftar_baru', 'statistik_level_daftar_ulang', 'datalevel'));
    }
}
