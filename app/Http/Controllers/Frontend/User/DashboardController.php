<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tahsin;
use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\Request;


/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.dashboard.index');
    }

    public function amalyaumiah()
    {
        return view('frontend.user.amal-yaumiah.index');
    }

    public function amalyaumiahpeserta()
    {
        $pesertayaumiah = DB::table('users')->where('last_name', 'SANTRI')->get();

        return view('frontend.user.amal-yaumiah.peserta', compact('pesertayaumiah'));
    }

    public function jadwaltahsin(Request $request)
    {
        $datajadwals = DB::table('tahsins')
            ->select('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY jadwal_tahsin ASC'))
            ->paginate(500);

        return view('frontend.user.jadwal.tahsin', compact('datajadwals'));
    }

    public function absentahsin(Request $request)
    {
        $datajadwals = DB::table('tahsins')
            ->select('jadwal_tahsin', 'level_peserta', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('jadwal_tahsin', 'level_peserta', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY jadwal_tahsin ASC'))
            ->where('nama_pengajar', auth()->user()->user_pengajar)
            ->paginate(50);

        return view('frontend.user.absen.tahsin', compact('datajadwals'));
    }

    public function absentahsinkelas(Request $request)
    {
        $absen = new Absen;

        $waktu        = $request->input('waktu') ?? '!!ERROR!!';
        $level        = $request->input('level') ?? '!!ERROR!!';
        $jenis        = $request->input('jenis') ?? '!!ERROR!!';
        $userpengajar = auth()->user()->user_pengajar;
        $pertemuanke  = $request->input('ke');
        $angkatan     = session('angkatan_tahsin');

        $datapeserta = DB::table('tahsins')
            ->where('nama_pengajar', $userpengajar)
            ->where('level_peserta', $level)
            ->where('jadwal_tahsin', $waktu)
            ->where('angkatan_peserta', $angkatan)
            ->where('jenis_peserta', $jenis)
            ->paginate(50);

        if (isset($pertemuanke)) {
            $pertemuanke = $request->input('ke');
        } else {
            $pertemuanke = 'semua';
        }

        return view(
            'frontend.user.absen.tahsin-kelas',
            compact('absen', 'pertemuanke', 'waktu', 'level', 'userpengajar', 'datapeserta', 'jenis', 'angkatan')
        );
    }

    public function absentahsininput(Request $request)
    {
        $absen = new Absen;
        $cekabsen = Absen::find($request->input('idabsen'));

        if (isset($cekabsen)) {
            if ($request->input('keteranganabsen') == '-') {
                $cekabsen->delete();
            } else {
                $cekabsen->update([
                    'keterangan_absen' => $request->input('keteranganabsen'),
                ]);
            }
        } else {
            $absen->create([
                'id_peserta'             => $request->input('peserta'),
                'user_create_absen'      => auth()->user()->id,
                'pertemuan_ke_absen'     => $request->input('pertemuan'),
                'jenis_absen'            => 'TAHSIN',
                'angkatan_absen'         => session('angkatan_tahsin'),
                'level_kelas_absen'      => $request->input('level'),
                'waktu_kelas_absen'      => $request->input('waktu'),
                'jenis_kelas_absen'      => $request->input('jenis'),
                'keterangan_absen'       => $request->input('keteranganabsen'),
            ]);
        }

        return back()->withFlashSuccess('Absen Berhasil Diperbaruhi !');
    }

    public function absentahsinkelasgantiabsen(Request $request)
    {
        $level       = $request->input('level');
        $waktu       = $request->input('waktu');
        $jenis       = $request->input('jenis');
        $angkatan    = $request->input('angkatan');
        $pertemuan   = $request->input('pertemuan');
        $tanggalbaru = Carbon::createFromFormat('d-m-Y', $request->input('tanggalbaru'))->toDateTimeString();

        $cekabsen  = Absen::where('level_kelas_absen', $level)
            ->where('waktu_kelas_absen', $waktu)
            ->where('angkatan_absen', $angkatan)
            ->where('pertemuan_ke_absen', $pertemuan)
            ->where('jenis_kelas_absen', $jenis);

        if (isset($cekabsen)) {
            $cekabsen->update(['created_at' => $tanggalbaru]);
            return back()->withFlashSuccess('Tanggal Absen Berhasil Diperbaruhi !');
        } else {
            return back()->withFlashSuccess('Tanggal Absen Gagal Diperbaruhi !');
        }
    }

    public function pesertatahsinbaru(Request $request)
    {
        if(isset(request()->level)){
            $updatelevel = DB::table('tahsins')
              ->where('no_tahsin', request()->idtahsin)
              ->where('angkatan_peserta', session('daftar_ulang_angkatan_tahsin'))
              ->update(['level_peserta' => request()->level]);

            $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone = '62' . request()->nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih Kepada Calon Peserta Tahsin Angkatan ".session('daftar_ulang_angkatan_tahsin')." LTTQ Ar Rahmah Balikpapan, tim penguji kami telah selesai memeriksa bacaan anda.

Alhamdulillah, Level belajar anda adalah di level *".request()->level."*.
Silakan klik link berikut untuk memilih kelas belajar yang tersedia. Link : https://atthala.arrahmahbalikpapan.or.id/tahsin/pendaftaran/peserta?id=".request()->idtahsin."

Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Pendaftaran Baru Tahsin Angkatan ".session('daftar_ulang_angkatan_tahsin')."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

            $url = 'https://api.wanotif.id/v1/send';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                'Apikey'    => $apikey,
                'Phone'     => $phone,
                'Message'   => $message,
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $info = "berhasil";

            $tahsins = \App\Models\Tahsin::where('no_tahsin', 'like', '%-'.session('daftar_ulang_angkatan_tahsin').'-%')
                        ->where('angkatan_peserta', '=', session('daftar_ulang_angkatan_tahsin'))
                        ->paginate(10);

            return redirect()->to('/admin/tahsin/daftar-baru')->withFlashSuccess(request()->idtahsin.' Berhasil Diperbaruhi dengan Level '.request()->level);
        }
        if(isset(request()->notifikasi)){
            $updatestatus = DB::table('tahsins')
              ->where('no_tahsin', request()->notifikasi)
              ->where('angkatan_peserta', session('daftar_ulang_angkatan_tahsin'))
              ->update(['status_peserta' => 'NOTIF']);

            $data = DB::table('tahsins')->where('no_tahsin', request()->notifikasi)
              ->where('angkatan_peserta', session('daftar_ulang_angkatan_tahsin'))
              ->first();

            if($data->jenis_peserta === 'IKHWAN'){
                $penguji = "Ustadz Arief wa.me/6281350532338";
            } elseif ($data->jenis_peserta === 'AKHWAT'){
                $penguji = "Ustadzah Ninin wa.me/6282358271295";
            }

            $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone = '62' . $data->nohp_peserta;
            $message =
                "Assalamu'alaikum warahmatullahi bapak/ibu calon peserta, mohon maaf rekaman anda tidak terbaca di sistem kami dikarenakan ketidakcocokan teknis.

Oleh karenanya mohon mengirimkan rekaman ulang ke penguji kami melalui fitur WhatsApp Voice Note.

Penguji :
".$penguji.
"

Silakan isi format berikut sebelum mengirimkan rekaman suara:

Nama Lengkap :
Tanggal Mengisi Formulir Online :";

            $url = 'https://api.wanotif.id/v1/send';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                'Apikey'    => $apikey,
                'Phone'     => $phone,
                'Message'   => $message,
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $info = "berhasil";

            $tahsins = \App\Models\Tahsin::where('no_tahsin', 'like', '%-'.session('daftar_ulang_angkatan_tahsin').'-%')
                        ->where('angkatan_peserta', '=', session('daftar_ulang_angkatan_tahsin'))
                        ->paginate(10);

            return redirect()->to('/admin/tahsin/daftar-baru');
        }

        if(isset(request()->idtahsin)){
            $updatelevel = DB::table('tahsins')
            ->where('no_tahsin', request()->idtahsin)
            ->where('angkatan_peserta', session('daftar_ulang_angkatan_tahsin'))
            ->update(['status_peserta' => auth()->user()->first_name]);
        }

        $tahsins = \App\Models\Tahsin::where('no_tahsin', 'like', '%-'.session('daftar_ulang_angkatan_tahsin').'-%')
                ->when(request()->nama, function ($query) {
                    return $query->where('nama_peserta', 'like', '%'.request()->nama.'%');
                })
                ->when(request()->idtahsin, function ($query) {
                        return $query->where('no_tahsin', '=', request()->idtahsin);
                })
                ->where('angkatan_peserta', '=', session('daftar_ulang_angkatan_tahsin'))
            ->paginate(10);
        // }

        return view('frontend.user.tahsin.peserta-baru', compact('tahsins'));
    }
}
