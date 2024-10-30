<?php

namespace App\Http\Controllers\Backend\Tahsin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Tahsin\Peserta;
use App\Models\Tahsin;
use DB;
use App\Models\PesertaUjian;
use App\Models\StatusPesertaTahsin;
use App\Models\LevelTahsin;
use App\Models\Jadwal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use App\DataTables\AbsenDataTable;
use App\Models\Absen;
use App\Models\Auth\User;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->id            = request()->id ?? null;
        $this->nama          = request()->nama ?? null;
        $this->level         = request()->level ?? null;
        $this->jenis         = request()->jenis ?? null;
        $this->pengajar      = request()->pengajar ?? null;
        $this->hari          = request()->hari ?? null;
        $this->waktu         = request()->waktu ?? null;
        $this->angkatan      = request()->angkatan ?? 25;
        $this->status        = request()->status ?? null;
        $this->listpengajar  = Tahsin::select('nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
                                ->groupBy('nama_pengajar', 'jenis_peserta')
                                ->where('nama_pengajar', '!=', NULL)
                                ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
                                // ->angkatan($this->angkatan)
                                ->get();
        $this->listangkatan  = Jadwal::select('angkatan_jadwal')
                                ->groupBy('angkatan_jadwal')
                                ->orderBy('angkatan_jadwal', 'desc')
                                ->get();
        $this->liststatuspeserta = StatusPesertaTahsin::get();
        $this->listlevel         = LevelTahsin::get();

    }

    public function jadwalbase()
    {
        return Jadwal::pengajar($this->pengajar)
                    ->level($this->level)
                    ->hari($this->hari)
                    ->waktu($this->waktu)
                    ->jenis($this->jenis)
                    ->status($this->status)
                    ->angkatan($this->angkatan)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
    }
    
    public function jadwalbaseabsen()
    {
        return Jadwal::pengajar($this->pengajar)
                    ->level($this->level)
                    ->hari($this->hari)
                    ->waktu($this->waktu)
                    ->jenis($this->jenis)
                    ->status($this->status)
                    ->angkatan($this->angkatan)
                    ->orderBy('created_at', 'desc')
                    ->paginate(100);
    }

    public function jadwal($titleA)
    {
        $jadwals       = $this->jadwalbase();
        $dataangkatan  = $this->listangkatan;
        $datalevel     = $this->listlevel;
        $datapengajars = $this->listpengajar;
        $liststatus    = $this->liststatuspeserta;
        $title         = $titleA;
        $datawaktu     = Jadwal::select('hari_jadwal', 'waktu_jadwal')
                            ->pengajar($this->pengajar)
                            ->level($this->level)
                            ->jenis($this->jenis)
                            ->status($this->status)
                            ->angkatan($this->angkatan)
                            ->groupBy('hari_jadwal', 'waktu_jadwal')
                            ->get();
        return view('backend.pendidikan.tahsin.jadwal.data', compact('jadwals', 'title', 'datalevel', 'datapengajars', 'dataangkatan', 'datawaktu', 'liststatus'));
    }
    
    public function absen($titleA)
    {
        $jadwals       = $this->jadwalbaseabsen();
        $dataangkatan  = $this->listangkatan;
        $datalevel     = $this->listlevel;
        $datapengajars = $this->listpengajar;
        $liststatus    = $this->liststatuspeserta;
        $title         = $titleA;
        $datawaktu     = Jadwal::select('hari_jadwal', 'waktu_jadwal')
                            ->pengajar($this->pengajar)
                            ->level($this->level)
                            ->jenis($this->jenis)
                            ->status($this->status)
                            ->angkatan($this->angkatan)
                            ->groupBy('hari_jadwal', 'waktu_jadwal')
                            ->get();
        return view('backend.pendidikan.tahsin.jadwal.data-absen', compact('jadwals', 'title', 'datalevel', 'datapengajars', 'dataangkatan', 'datawaktu', 'liststatus'));
    }

    public function index()
    {
        return $this->jadwal(null, null, 'Peserta');
    }
    
    public function getAbsen()
    {
        return $this->absen(null, null, 'Peserta');
    }

    public function postCreateJadwal(Request $request)
    {
        $request->validate([
            'pengajar'      => 'required',
            'level'         => 'required',
            'hari'          => 'required',
            'jam'           => 'required',
            'jenis'         => 'required',
            'jumlahpeserta' => 'required',
            'statusbelajar' => 'required',
            'angkatan'      => 'required',
        ]);

        $data = new Jadwal;
        $data->uuid_jadwal     = Str::uuid();
        $data->pengajar_jadwal = $request->pengajar;
        $data->level_jadwal    = $request->level;
        $data->hari_jadwal     = $request->hari;
        $data->waktu_jadwal    = $request->jam;
        $data->jenis_jadwal    = $request->jenis;
        $data->jumlah_peserta  = $request->jumlahpeserta;
        $data->status_belajar  = $request->statusbelajar;
        $data->angkatan_jadwal = $request->angkatan;
        $data->save();

        return redirect()->back()->withFlashSuccess('Jadwal Berhasil Ditambahkan !');
    }
    public function postUpdateJadwal(Request $request)
    {
        $request->validate([
            'pengajar'      => 'required',
            'level'         => 'required',
            'hari'          => 'required',
            'jam'           => 'required',
            'jenis'         => 'required',
            'jumlahpeserta' => 'required',
            'statusbelajar' => 'required',
        ]);

        $data = Jadwal::find($this->id);
        $data->pengajar_jadwal = $request->pengajar;
        $data->level_jadwal    = $request->level;
        $data->hari_jadwal     = $request->hari;
        $data->waktu_jadwal    = $request->jam;
        $data->jenis_jadwal    = $request->jenis;
        $data->jumlah_peserta  = $request->jumlahpeserta;
        $data->status_belajar  = $request->statusbelajar;
        $data->save();

        return redirect()->back()->withFlashSuccess('Jadwal Berhasil Diperbaruhi !');
    }

    public function getDeleteJadwal()
    {
        $data = Jadwal::find($this->id);
        $data->delete();

        return redirect()->back()->withFlashSuccess('Jadwal Berhasil Dihapus !');
    }

    public function getAbsensi()
    {
        // dd($dataTable);

        // return $dataTable->render('backend.pendidikan.tahsin.jadwal.absensi');

        $dataabsen = new Absen;
        $datauser  = new User;
        $angkatan  = session('angkatan_tahsin');



        $datajadwals = DB::table('tahsins')
            ->select('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY jadwal_tahsin ASC'))
            ->paginate(1);

        $datapengajars = DB::table('tahsins')
            ->select('nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->paginate(200);

        // dd($datapengajars);

        return view('backend.pendidikan.tahsin.jadwal.absensi', compact('datajadwals', 'datapengajars', 'angkatan', 'datauser', 'dataabsen'));

    }

}
