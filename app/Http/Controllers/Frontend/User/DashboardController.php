<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tahsin;
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
        $angkatan     = '16';

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
                'angkatan_absen'         => '16',
                'level_kelas_absen'      => $request->input('level'),
                'waktu_kelas_absen'      => $request->input('waktu'),
                'jenis_kelas_absen'      => $request->input('jenis'),
                'keterangan_absen'       => $request->input('keteranganabsen'),
            ]);
        }

        return back()->withFlashSuccess('Absen Berhasil Diperbaruhi !');
    }
}
