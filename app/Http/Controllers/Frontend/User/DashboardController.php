<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenPertemuan;
use App\Models\Jadwal;
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

     public function __construct()
    {
        $this->angkatan_tahsin  = 22;
    }

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
        $pesertayaumiah = DB::table('users')->where('last_name', 'SANTRI')
                                        // ->whereMonth('created_at', '3')
                                        // ->whereYear('created_at', '2021')
                                        ->get();

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
            ->where('angkatan_peserta', $this->angkatan_tahsin)
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
        $angkatan     = $this->angkatan_tahsin;

        $datapeserta = Tahsin::where('nama_pengajar', $userpengajar)
            ->where('level_peserta', $level)
            ->where('jadwal_tahsin', $waktu)
            ->where('angkatan_peserta', $angkatan)
            ->paginate(50);

        $w = explode(" ",$waktu);
        $jadwal = Jadwal::where('pengajar_jadwal', $userpengajar)
        ->where('level_jadwal', $level)
        ->where('hari_jadwal', $w[0])
        ->where('waktu_jadwal', $w[1])
        ->where('angkatan_jadwal', $angkatan)
        ->first();

        $ketpertemuan = AbsenPertemuan::where('id_jadwal', $jadwal->id)
                                        ->where('pertemuan', $pertemuanke)
                                        ->first();
        $datakp       = AbsenPertemuan::where('id_jadwal', $jadwal->id)->get();

        $kp = array();
        foreach ($datakp as $b) {
            $kp[] = ([
                    'pert'  => $b->pertemuan,
                    'tgl'   => $b->tanggal_pertemuan,
                    'surah' => $b->tilawah_pertemuan_surah,
                    'ayat'  => $b->tilawah_pertemuan_ayat
                ]);
        }

        if (isset($pertemuanke)) {
            $pertemuanke = $request->input('ke');
        } else {
            $pertemuanke = 'semua';
        }

        $ab = Absen::where('user_create_absen', auth()->user()->id)
        ->where('jenis_absen', 'TAHSIN')
        ->where('angkatan_absen', $angkatan)
        ->where('level_kelas_absen', $level)
        ->where('waktu_kelas_absen', $waktu)
        ->get();

        $yess = array();
        foreach ($ab as $a) {
            $yess[] = ([
                    'ke'   => $a->pertemuan_ke_absen,
                    'id_p' => $a->id_peserta,
                    'k_p'  => $a->keterangan_absen
                ]);
        }

        $dataabsen        = collect($yess);
        $dataketpertemuan = collect($kp);

        return view(
            'frontend.user.absen.tahsin-kelas',
            compact('absen', 'pertemuanke', 'waktu', 'level', 'userpengajar', 'datapeserta', 'jenis', 'angkatan', 'dataabsen', 'jadwal', 'ketpertemuan', 'dataketpertemuan')
        );
    }

    public function absentahsininput(Request $request)
    {

        $absen = new Absen;

        foreach ($request->input('peserta') as $key => $datapeserta) {
            // $tes[] = ([
            //     'idp' => $datapeserta,
            //     'idabsen' => $request->input('idabsen')[$key],
            //     'absen' => $request->input('keteranganabsen'.$datapeserta)
            // ]);

            $cekabsen = Absen::find($request->input('idabsen')[$key]);
            $ket_absen = $request->input('keteranganabsen'.$datapeserta);

            if (isset($cekabsen)) {
                $cekabsen->update([
                    'keterangan_absen' => $ket_absen,
                ]);
            } else {
                $absen->create([
                    'id_peserta'             => $datapeserta,
                    'user_create_absen'      => auth()->user()->id,
                    'pertemuan_ke_absen'     => $request->input('pertemuan'),
                    'jenis_absen'            => 'TAHSIN',
                    'angkatan_absen'         => $this->angkatan_tahsin,
                    'level_kelas_absen'      => $request->input('level'),
                    'waktu_kelas_absen'      => $request->input('waktu'),
                    'jenis_kelas_absen'      => $request->input('jenis'),
                    'keterangan_absen'       => $ket_absen,
                ]);
            }
        }

        $cekpertemuan = AbsenPertemuan::find($request->input('idketper'));
        $absenpertemuan = new AbsenPertemuan;
        if (isset($cekpertemuan)) {
            $cekpertemuan->update([
                'tilawah_pertemuan_surah' => $request->input('surah'),
                'tilawah_pertemuan_ayat'  => $request->input('ayat'),
                'tanggal_pertemuan'       => $request->input('tanggalpertemuan'),
            ]);
        } else {
            $absenpertemuan->create([
                'id_jadwal'               => $request->input('idjadwal'),
                'pertemuan'               => $request->input('pertemuan'),
                'tilawah_pertemuan_surah' => $request->input('surah'),
                'tilawah_pertemuan_ayat'  => $request->input('ayat'),
                'tanggal_pertemuan'       => $request->input('tanggalpertemuan'),
            ]);
        }


        return redirect()->to('/absen/tahsin/kelas?waktu='.$request->input('waktu').'&jenis='.$request->input('jenis').'&level='.$request->input('level').'&ke=semua')
                ->withFlashSuccess('Absen Ke '.$request->input('pertemuan').' Berhasil Diperbaruhi !');
    }

    public function absentahsininputlevel(Request $request)
    {

        foreach ($request->input('peserta') as $datapeserta) {

            $pesertatahsin                           = Tahsin::find($datapeserta);
            $pesertatahsin->kenaikan_level_peserta   = $request->input('keteranganhasil'.$datapeserta);
            $pesertatahsin->save();
        }

        return redirect()->to('/absen/tahsin/kelas?waktu='.$request->input('waktu').'&jenis='.$request->input('jenis').'&level='.$request->input('level').'&ke=semua')
                ->withFlashSuccess('Level Peserta Hasil Ujian Berhasil Diperbaruhi !');
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
              ->where('angkatan_peserta', $this->angkatan_tahsin)
              ->update(['level_peserta' => request()->level]);

            $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone = '+62'. request()->nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih Kepada Calon Peserta Tahsin Angkatan ".$this->angkatan_tahsin." LTTQ Ar Rahmah Balikpapan, tim penguji kami telah selesai memeriksa bacaan anda.

Alhamdulillah, Level belajar anda adalah di level *".request()->level."*.
Silakan klik link berikut untuk memilih kelas belajar yang tersedia. Link : https://atthala.arrahmahbalikpapan.or.id/tahsin/pendaftaran/peserta?id=".request()->idtahsin."

Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Pendaftaran Baru Tahsin Angkatan ".$this->angkatan_tahsin."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

            // $url = 'https://api.wanotif.id/v1/send';

            // $curl = curl_init();
            // curl_setopt($curl, CURLOPT_URL, $url);
            // curl_setopt($curl, CURLOPT_HEADER, 0);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            // curl_setopt($curl, CURLOPT_POST, 1);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            //     'Apikey'    => $apikey,
            //     'Phone'     => $phone,
            //     'Message'   => $message,
            // ));
            // $response = curl_exec($curl);
            // curl_close($curl);

            // woo-wa.com
            $apikey = env('WA_KEY');

            $url='http://116.203.191.58/api/send_message';
                $data = array(
                    "phone_no"  => $phone,
                    "key"		=> $apikey,
                    "message"	=> $message,
                    "skip_link"	=> True // This optional for skip snapshot of link in message
                );
                $data_string = json_encode($data);

                $ch = curl_init($url);
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

            $info = "berhasil";

            $tahsins = \App\Models\Tahsin::where('no_tahsin', 'like', '%-'.$this->angkatan_tahsin.'-%')
                        ->where('angkatan_peserta', '=', $this->angkatan_tahsin)
                        ->paginate(10);

            return redirect()->to('/admin/tahsin/daftar-baru')->withFlashSuccess(request()->idtahsin.' Berhasil Diperbaruhi dengan Level '.request()->level);
        }
        if(isset(request()->notifikasi)){
            $updatestatus = DB::table('tahsins')
              ->where('no_tahsin', request()->notifikasi)
              ->where('angkatan_peserta', $this->angkatan_tahsin)
              ->update(['status_peserta' => 'NOTIF']);

            $data = DB::table('tahsins')->where('no_tahsin', request()->notifikasi)
              ->where('angkatan_peserta', $this->angkatan_tahsin)
              ->first();

            if($data->jenis_peserta === 'IKHWAN'){
                $penguji = "Ustadz Arief wa.me/+6281350532338";
            } elseif ($data->jenis_peserta === 'AKHWAT'){
                if (auth()->user()->email === 'ilya.el.aditya@gmail.com'){
                    $penguji = "Ustadzah Arina wa.me/+6281347942937";
                } elseif (auth()->user()->email === 'bundaraira@gmail.com'){
                    $penguji = "Ustadzah Yunita wa.me/+6282148293709";
                } else {
                    $penguji = "Ustadzah Ninin wa.me/+6282358271295";
                }
            }

            $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone = '+62'. $data->nohp_peserta;
            $message =
                "Assalamu'alaikum warahmatullahi bapak/ibu calon peserta, mohon maaf rekaman anda tidak terbaca di sistem kami dikarenakan ketidakcocokan teknis.

Oleh karenanya mohon mengirimkan rekaman ulang ke penguji kami melalui fitur WhatsApp Voice Note.

Penguji :
".$penguji.
"

Silakan isi format berikut sebelum mengirimkan rekaman suara:

Nama Lengkap :
Tanggal Mengisi Formulir Online :";

            // $url = 'https://api.wanotif.id/v1/send';

            // $curl = curl_init();
            // curl_setopt($curl, CURLOPT_URL, $url);
            // curl_setopt($curl, CURLOPT_HEADER, 0);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            // curl_setopt($curl, CURLOPT_POST, 1);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            //     'Apikey'    => $apikey,
            //     'Phone'     => $phone,
            //     'Message'   => $message,
            // ));
            // $response = curl_exec($curl);
            // curl_close($curl);

            // woo-wa.com
            $apikey = env('WA_KEY');

            $url='http://116.203.191.58/api/send_message';
                $data = array(
                    "phone_no"  => $phone,
                    "key"		=> $apikey,
                    "message"	=> $message,
                    "skip_link"	=> True // This optional for skip snapshot of link in message
                );
                $data_string = json_encode($data);

                $ch = curl_init($url);
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

            $info = "berhasil";

            $tahsins = \App\Models\Tahsin::where('no_tahsin', 'like', '%-'.$this->angkatan_tahsin.'-%')
                        ->where('angkatan_peserta', '=', $this->angkatan_tahsin)
                        ->paginate(10);

            return redirect()->to('/admin/tahsin/daftar-baru');
        }

        if(isset(request()->idtahsin)){
            $updatelevel = DB::table('tahsins')
            ->where('no_tahsin', request()->idtahsin)
            ->where('angkatan_peserta', $this->angkatan_tahsin)
            ->update(['status_peserta' => auth()->user()->first_name]);
        }

        $tahsins = \App\Models\Tahsin::where('no_tahsin', 'like', '%-'.$this->angkatan_tahsin.'-%')
                ->when(request()->nama, function ($query) {
                    return $query->where('nama_peserta', 'like', '%'.request()->nama.'%');
                })
                ->when(request()->idtahsin, function ($query) {
                        return $query->where('no_tahsin', '=', request()->idtahsin);
                })
                ->where('angkatan_peserta', '=', $this->angkatan_tahsin)
            ->paginate(10);
        // }

        return view('frontend.user.tahsin.peserta-baru', compact('tahsins'));
    }

    public function tahsinpeserta(Request $request)
    {
        if (request()->pengajar == 'SEMUA') { $pengajar = ''; } else { $pengajar = request()->pengajar; }
        if (request()->level == 'SEMUA') { $level = ''; } else { $level = request()->level; }
        if (request()->waktu == 'SEMUA') { $waktu = ''; } else { $waktu = request()->waktu; }

        $datajadwals = DB::table('tahsins')
            ->select('jadwal_tahsin', 'level_peserta', 'jenis_peserta', 'nama_pengajar',  (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('jadwal_tahsin', 'level_peserta', 'jenis_peserta', 'nama_pengajar')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY jadwal_tahsin ASC'))
            ->whereNotNull('jadwal_tahsin')
            ->where('jenis_peserta', auth()->user()->jenis)
            ->where('nama_pengajar', 'like', '%'.$pengajar.'%')
            ->where('level_peserta', 'like', '%'.$level.'%')
            ->where('jadwal_tahsin', 'like', '%'.$waktu.'%')
            ->where('angkatan_peserta', $this->angkatan_tahsin)
            ->paginate(10);

        $datapengajar = DB::table('tahsins')
            ->select('nama_pengajar',  (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('nama_pengajar')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->whereNotNull('jadwal_tahsin')
            ->where('jenis_peserta', auth()->user()->jenis)
            ->where('angkatan_peserta', $this->angkatan_tahsin)
            ->get();

        $datajadwaltahsin = DB::table('tahsins')
            ->select('jadwal_tahsin',  (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('jadwal_tahsin')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY jadwal_tahsin ASC'))
            ->whereNotNull('jadwal_tahsin')
            ->where('jenis_peserta', auth()->user()->jenis)
            ->where('angkatan_peserta', $this->angkatan_tahsin)
            ->get();

        return view('frontend.user.tahsin.peserta', compact('datajadwals', 'datapengajar', 'datajadwaltahsin'));
    }

    public function tahsinpesertakelas(Request $request)
    {
        $absen = new Absen;

        $waktu        = $request->input('waktu') ?? '!!ERROR!!';
        $level        = $request->input('level') ?? '!!ERROR!!';
        $jenis        = $request->input('jenis') ?? '!!ERROR!!';
        $userpengajar = $request->input('pengajar') ?? '!!ERROR!!';
        $pertemuanke  = $request->input('ke');
        // $angkatan     = session('daftar_ulang_angkatan_tahsin');
        $angkatan     = $this->angkatan_tahsin;

        $datapeserta = DB::table('tahsins')
            ->where('nama_pengajar', $userpengajar)
            ->where('level_peserta', $level)
            ->where('jadwal_tahsin', $waktu)
            ->where('angkatan_peserta', $angkatan)
            // ->where('jenis_peserta', $jenis)
            ->paginate(30);

        if (isset($pertemuanke)) {
            $pertemuanke = $request->input('ke');
        } else {
            $pertemuanke = 'semua';
        }

        return view(
            'frontend.user.tahsin.peserta-kelas',
            compact('absen', 'pertemuanke', 'waktu', 'level', 'userpengajar', 'datapeserta', 'jenis', 'angkatan')
        );
    }
}
