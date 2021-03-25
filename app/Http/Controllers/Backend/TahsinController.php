<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Imports\TahsinsImport;
use App\Imports\TahsinUpdateLevel;
use App\Imports\PembayaransImport;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

// use Maatwebsite\Excel\Excel;
use App\Models\Auth\User;
use App\Models\Absen;
use App\Models\Tahsin;
use App\Models\PesertaUjian;
use App\Repositories\Backend\TahsinRepository;
use App\Http\Requests\Backend\Tahsin\ManageTahsinRequest;
use App\Http\Requests\Backend\Tahsin\StoreTahsinRequest;
use App\Http\Requests\Backend\Tahsin\UpdateTahsinRequest;

use App\Events\Backend\Tahsin\TahsinCreated;
use App\Events\Backend\Tahsin\TahsinUpdated;
use App\Events\Backend\Tahsin\TahsinDeleted;
use App\Models\PengaturanTahsin;
use Illuminate\Support\Arr;


class TahsinController extends Controller
{
    /**
     * @var TahsinRepository
     */
    protected $tahsinRepository;

    protected $nama          ;
    protected $kenaikanlevel ;
    protected $idtahsin      ;
    protected $level         ;
    protected $angkatan      ;
    /**
     * TahsinController constructor.
     *
     * @param TahsinRepository $tahsinRepository
     */
    public function __construct(TahsinRepository $request)
    {
        $this->tahsinRepository = $request;

        $this->nama          = request()->nama ?? null;
        $this->kenaikanlevel = request()->kenaikanlevel ?? null;
        $this->idtahsin      = request()->idtahsin ?? null;
        $this->level         = request()->level ?? null;
        $this->nohp          = request()->nohp ?? null;
        $this->jenis         = request()->jenis ?? null;
        $this->pengajar      = request()->pengajar ?? null;
        $this->angkatan      = request()->angkatan ?? session('angkatan_tahsin');
        $this->angkatanbaru  = request()->angkatan ?? session('daftar_ulang_angkatan_tahsin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageTahsinRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public function index(ManageTahsinRequest $request)
    {
        $datapengajars = DB::table('tahsins')
            ->select('nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->get();

        if(isset($this->kenaikanlevel)){
            $updatelevel = DB::table('tahsins')
              ->where('no_tahsin', $this->idtahsin)
              ->where('angkatan_peserta', session('angkatan_tahsin'))
              ->update(['kenaikan_level_peserta' => $this->kenaikanlevel]);

            $tahsins = \App\Models\Tahsin::search($this->nama)
              ->paginate(10);

            return view('backend.tahsin.index', compact('tahsins', 'datapengajars'))->withFlashSuccess($this->idtahsin.'Berhasil Diperbaruhi');
        }

        // if(isset($level)){
        //     $tahsins = \App\Models\Tahsin::search($nama)
        //         ->where('angkatan_peserta', $angkatan)
        //         ->where('level_peserta', $level)
        //         ->paginate(10);
        // } else {
        //     $tahsins = \App\Models\Tahsin::search($nama)
        //         ->where('angkatan_peserta', $angkatan)
        //         ->paginate(10);
        // }

        // if( $this->level === 'SEMUA') {
        //     $tahsins = \App\Models\Tahsin::
        //         when($this->nama, function ($query) {
        //             return $query->search($this->nama);
        //         })
        //         ->when($this->angkatan, function ($query) {
        //             return $query->where('angkatan_peserta', '=', $this->angkatan);
        //         })
        //         ->paginate(10);
        // } else {
            $tahsins = \App\Models\Tahsin::
                when($this->nama, function ($query) {
                    return $query->where('nama_peserta', 'like', '%'.$this->nama.'%');
                })
                ->when($this->level, function ($query) {
                    if( $this->level != 'SEMUA') {
                        return $query->where('level_peserta', '=', $this->level);
                    }
                })
                ->when($this->jenis, function ($query) {
                    if( $this->jenis != 'SEMUA') {
                        return $query->where('jenis_peserta', '=', $this->jenis);
                    }
                })
                ->when($this->angkatan, function ($query) {
                    return $query->where('angkatan_peserta', '=', $this->angkatan);
                })
                ->when($this->pengajar, function ($query) {
                    if( $this->jenis != 'SEMUA') {
                        return $query->where('nama_pengajar', '=', $this->pengajar);
                    }
                })
                // ->withCount('no_tahsin')
                // ->has('no_tahsin', '<', 2)
                // ->havingRaw('COUNT(no_tahsin) < 2')
                // ->groupBy('no_tahsin')
                // ->having(DB::Raw('COUNT(no_tahsin) = 1'))
                // ->having('no_tahsin', '<', 2)
                ->paginate(10);
                // dd($tahsins);
        // }

        return view('backend.tahsin.index', compact('tahsins', 'datapengajars'));
    }

    public function daftarulang(ManageTahsinRequest $request)
    {
        $tahsins = Tahsin::
            when($this->nama, function ($query) {
                return $query->where('nama_peserta', 'like', '%'.$this->nama.'%');
            })
            ->when($this->level, function ($query) {
                if( $this->level != 'SEMUA') {
                    return $query->where('level_peserta', '=', $this->level);
                }
            })
            ->when($this->jenis, function ($query) {
                if( $this->jenis != 'SEMUA') {
                    return $query->where('jenis_peserta', '=', $this->jenis);
                }
            })
            ->where('no_tahsin', 'like', '%-'.$this->angkatan.'-%')
            ->where('angkatan_peserta', '=', $this->angkatanbaru)
            ->paginate(10);

        if( auth()->user()->last_name === 'Ekonomi') {
            return view('backend.tahsin.ekonomi-daftar-ulang', compact('tahsins'));
        } else {
            return view('backend.tahsin.daftar-ulang', compact('tahsins'));
        }
    }

    public function daftarbaru(ManageTahsinRequest $request)
    {

        if(isset($this->level)){
            $updatelevel = DB::table('tahsins')
              ->where('no_tahsin', $this->idtahsin)
              ->where('angkatan_peserta', $this->angkatanbaru)
              ->update(['level_peserta' => $this->level]);

            $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone = '62' . $this->nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih Kepada Calon Peserta Tahsin Angkatan ".session('daftar_ulang_angkatan_tahsin')." LTTQ Ar Rahmah Balikpapan, tim penguji kami telah selesai memeriksa bacaan anda.

Alhamdulillah, Level belajar anda adalah di level *".$this->level."*.
Silakan klik link berikut untuk memilih kelas belajar yang tersedia. Link : https://atthala.arrahmahbalikpapan.or.id/tahsin/pendaftaran/peserta?id=".$this->idtahsin."

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
                        ->where('angkatan_peserta', '=', $this->angkatanbaru)
                        ->paginate(10);

            return redirect()->to('/admin/tahsin/daftar-baru')->withFlashSuccess($this->idtahsin.' Berhasil Diperbaruhi dengan Level '.$this->level);
        }

        if(isset($this->idtahsin)){
            $updatelevel = DB::table('tahsins')
            ->where('no_tahsin', $this->idtahsin)
            ->where('angkatan_peserta', $this->angkatanbaru)
            ->update(['status_peserta' => auth()->user()->first_name]);
        }

        if(isset(request()->notifikasi)){
            $updatestatus = DB::table('tahsins')
              ->where('no_tahsin', request()->notifikasi)
              ->where('angkatan_peserta', $this->angkatanbaru)
              ->update(['status_peserta' => 'NOTIF']);

            $data = Tahsin::where('no_tahsin', request()->notifikasi)
              ->where('angkatan_peserta', $this->angkatanbaru)
              ->first();

            if($data->jenis_peserta === 'IKHWAN'){
                $penguji = "Ustadz Arief wa.me/+6281350532338";
            } elseif ($data->jenis_peserta === 'AKHWAT'){
                $penguji = "Ustadzah Ninin wa.me/+6282358271295";
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
                        ->where('angkatan_peserta', '=', $this->angkatanbaru)
                        ->paginate(10);

            return redirect()->to('/admin/tahsin/daftar-baru')->withFlashSuccess(request()->notifikasi.' Notifikasi WhatsApp Berhasil Dikirim '.$this->level);
        }


        $tahsins = \App\Models\Tahsin::where('no_tahsin', 'like', '%-'.session('daftar_ulang_angkatan_tahsin').'-%')
                ->when($this->nama, function ($query) {
                    return $query->where('nama_peserta', 'like', '%'.$this->nama.'%');
                })
                ->when($this->idtahsin, function ($query) {
                        return $query->where('no_tahsin', '=', $this->idtahsin);
                })
                ->where('angkatan_peserta', '=', $this->angkatanbaru)
            ->paginate(10);

        return view('backend.tahsin.daftar-baru', compact('tahsins'));
    }

    public function upload(ManageTahsinRequest $request)
    {
        return view('backend.tahsin.upload')
            ->withtahsins($this->tahsinRepository->getActivePaginated(50, 'id', 'desc'));
    }

    public function jadwal(ManageTahsinRequest $request)
    {
        $angkatanbaru  = request()->angkatan ?? session('daftar_ulang_angkatan_tahsin');

        $datajadwals = DB::table('tahsins')
            ->select('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY level_peserta ASC'))
            ->where('angkatan_peserta', $angkatanbaru)
            ->paginate(5000);

        return view('backend.tahsin.jadwal', compact('datajadwals', 'angkatanbaru'));
    }

    public function pengajar(ManageTahsinRequest $request)
    {
        $datapengajars = DB::table('tahsins')
            ->select('nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->paginate(5000);

        return view('backend.tahsin.pengajar', compact('datapengajars'));
    }

    public function pengaturan(ManageTahsinRequest $request)
    {
        return view('backend.tahsin.pengaturan');
    }

    public function absen(ManageTahsinRequest $request)
    {
        $dataabsen = new Absen;
        $datauser  = new User;
        $angkatan  = session('angkatan_tahsin');

        $datajadwals = DB::table('tahsins')
            ->select('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY jadwal_tahsin ASC'))
            ->paginate(5000);

        $datapengajars = DB::table('tahsins')
            ->select('nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->paginate(5000);

        return view('backend.tahsin.absen', compact('datajadwals', 'datapengajars', 'angkatan', 'datauser', 'dataabsen'));
    }

    public function absenkelas(ManageTahsinRequest $request)
    {
        $absen = new Absen;

        $waktu        = $request->input('waktu') ?? '!!ERROR!!';
        $level        = $request->input('level') ?? '!!ERROR!!';
        $jenis        = $request->input('jenis') ?? '!!ERROR!!';
        $userpengajar = $request->input('pengajar');
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
            'backend.tahsin.absen-kelas',
            compact('absen', 'pertemuanke', 'waktu', 'level', 'userpengajar', 'datapeserta', 'jenis', 'angkatan')
        );
    }

    public function import(Request $request)
    {

        //buat session untuk ngakalin ngirim data
        $jenispeserta     = request('jenispeserta');
        $angkatanpeserta  = request('angkatanpeserta');
        $request->session()->put('jenispeserta', $jenispeserta);
        $request->session()->put('angkatanpeserta', $angkatanpeserta);

        if ($request->hasFile('file')) {

            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $mytime = Carbon::now();
            $nama_file = $jenispeserta . '-' . $angkatanpeserta . '-' . $mytime->toDateTimeString() . '-' . rand() . '-' . $file->getClientOriginalName();

            // upload ke folder file_import di dalam folder public
            $file->move('file_import', $nama_file);

            // import data
            // $dataimport = Carbon::now();
            $dataimport = new TahsinsImport;

            Excel::import($dataimport, public_path('/file_import/' . $nama_file));

            $banyakdata = $dataimport->getRowCount();

            // alihkan halaman kembali
            return redirect()->route('admin.tahsins.upload')
                ->withFlashSuccess('Upload File Excel Peserta Berhasil. Total ' . $banyakdata . ' Data');
        } else {
            return redirect()->route('admin.tahsins.upload')->withFlashSuccess('Upload Gagal');
        }
    }

    public function importPembayaran(Request $request)
    {

        //buat session untuk ngakalin ngirim data
        $jenispeserta     = request('jenispeserta');
        $angkatanpeserta  = request('angkatanpeserta');
        $request->session()->put('jenispeserta', $jenispeserta);
        $request->session()->put('angkatanpeserta', $angkatanpeserta);

        if ($request->hasFile('file')) {

            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $mytime = Carbon::now();
            $nama_file = $mytime->toDateTimeString() . '-' . rand() . '-' . $file->getClientOriginalName();

            // upload ke folder file_import di dalam folder public
            $file->move('file_import', $nama_file);

            // import data
            // $dataimport = Carbon::now();
            $dataimport = new PembayaransImport;


            Excel::import($dataimport, public_path('/file_import/' . $nama_file));

            $banyakdata = $dataimport->getRowCount();

            // alihkan halaman kembali
            return redirect()->route('admin.tahsins.upload')
                ->withFlashSuccess('Upload File Excel Pembayaran Berhasil. Total ' . $banyakdata . ' Data');
        } else {
            return redirect()->route('admin.tahsins.upload')->withFlashSuccess('Upload Gagal');
        }
    }

    public function updatelevel(ManageTahsinRequest $request)
    {
        if ($request->hasFile('file')) {

            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            // // menangkap file excel
            // $file = $request->file('file');

            // // membuat nama file unik
            // $mytime = Carbon::now();
            // $nama_file = $mytime->toDateTimeString() . '-' . rand() . '-' . $file->getClientOriginalName();

            // // upload ke folder file_import di dalam folder public
            // $file->move('file_update_level', $nama_file);

            // // import data
            // // $dataimport = Carbon::now();
            $dataupdate = new TahsinUpdateLevel;

            // Excel::import($dataimport, public_path('/file_update_level/' . $nama_file));

            $data = Excel::toArray(new TahsinUpdateLevel, request()->file('file'));

            // collect(head($data))
            //     ->each(function ($row, $key) {
            //         DB::table('tahsins')
            //             ->where('no_tahsin', $row['id'])
            //             ->update(array_except($row, ['id']));
            //     });

            $updatelevel = [];
            $tahsin = new Tahsin;
            foreach ($data[0] as $key => $value) {
                // echo json_encode($value[0]);
                // echo json_encode($value[6]);
                $updatelevel[] = array('notahsin' => $value[0], 'level' => $value[6]);
                // DB::table('tahsins')->where('no_tahsin', json_encode($value[0]))->update(['kenaikan_level_peserta' => json_encode($value[6])]);
            }
            // return $updatelevel;
            foreach ($updatelevel as $data) {
                // echo Arr::get($data, 'notahsin');
                DB::table('tahsins')
                    ->where('no_tahsin', Arr::get($data, 'notahsin'))
                    ->update(['kenaikan_level_peserta' => Arr::get($data, 'level')]);
            }
            // $banyakdata = $dataupdate->getRowCount();

            // DB::table('tahsins')->whereIn('no_tahsin', $data[0])->update(['kenaikan_level_peserta' => $data[6]]);

            // // alihkan halaman kembali
            return redirect()->back()
                ->withFlashSuccess('Upload File Kenaikan Level Tahsin.');
        } else {
            return redirect()->back()->withFlashSuccess('Upload Gagal');
        }
    }

    public function pembayaran(ManageTahsinRequest $request)
    {
        $nominal0 = DB::table('pembayarans')->where('nominal_pembayaran', '=', '0')->count();
        $nominal1 = DB::table('pembayarans')->where('nominal_pembayaran', '=', '100000')->count();
        $nominal2 = DB::table('pembayarans')->where('nominal_pembayaran', '=', '200000')->count();
        $nominal3 = DB::table('pembayarans')->where('nominal_pembayaran', '=', '300000')->count();
        $nominal4 = DB::table('pembayarans')->where('nominal_pembayaran', '=', '400000')->count();

        $belumlunas = DB::table('tahsins')->where('status_pembayaran', '=', '1')->count();
        $lunas      = DB::table('tahsins')->where('status_pembayaran', '=', '2')->count();

        return view('backend.tahsin.pembayaran', compact('nominal0', 'nominal1', 'nominal2', 'nominal3', 'nominal4', 'belumlunas', 'lunas'));
    }

    public function createbayar(Request $request)
    {
        $nominal = preg_replace("/[^0-9]/", "", $request->nominalpembayaran);
        $id = $request->id;

        $pembayaran = new Pembayaran;

        $pembayaran->id_peserta         = $id;
        $pembayaran->nominal_pembayaran = (int) $nominal;
        $pembayaran->jenis_pembayaran   = $request->jenispembayaran;
        $pembayaran->admin_pembayaran   = Auth::user()->email;
        // dd($pembayaran);
        $pembayaran->save();

        $data = Tahsin::where('no_tahsin', $id)->first();
        $totalpembayaran = DB::table('pembayarans')
            ->select(DB::raw('SUM(nominal_pembayaran) as total'))
            ->where('id_peserta', $id)
            ->first();

        $subtotal = $totalpembayaran->total;
        $kekurangan = 400000 - $subtotal;

        $notelp = ltrim($data->nohp_peserta, '-');
        $notelp = ltrim($notelp, ' ');

        if (substr($notelp, 0, 1) === '0') {
            $notelp = substr($notelp, 1);
        } elseif (substr($notelp, 0, 2) === '62') {
            $notelp = substr($notelp, 2);
        } elseif (substr($notelp, 0, 3) === '+62') {
            $notelp = substr($notelp, 3);
        } else {
            $notelp = $notelp;
        }

        // dd($notelp);

        $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
        $phone = '62' . $notelp;

        if ($kekurangan > 0) {

            $message =
                'Assalamualaikum Warohmatullahi Wabarokaatuh,

Bapak/Ibu yang sama-sama mengharapkan ridho Allah Subhanahu Wataala,
Terima kasih telah melakukan pembayaran SPP kepada bagian keuangan kami sebesar *Rp. ' . number_format($nominal, 0, ',', '.') . '*-.
Kekurangan pembayaran anda hingga saat ini adalah sebesar *Rp. ' . number_format($kekurangan, 0, ',', '.') . '*,-
Semoga Allah Subhanahu Wa Taala memberikan kemudahan kepada Bapak/Ibu dalam proses pembelajaran Al Quran.

Kami membuka kesempatan untuk bapak/ibu dalam program pengembangan dakwah Rumah Tahfizh QUran Ar Rahmah dengan berinfak sebesar Rp 20.000,- melalui transfer ke rekening 2182182226 a.n. Rumah Tahfidz Quran Putra Ar Rahmah. Tambahkan angka 26 untuk kode transaksi pengembangan dakwah. contoh Transfer : Rp 20.026,-

Tetap jaga kesehatan dan ikuti protokol kesehatan selama masa pembatasan sosial skala besar.
Semoga Allah Subhanahu Wa Taala senantiasa melindungi kita semua. Aamiin Yaa Robbal Aalamiin

Salam,
*LTTQ Ar Rahmah Balikpapan*';
        } else {
            $message =
                'Assalamualaikum Warohmatullahi Wabarokaatuh,

Bapak/Ibu yang sama-sama mengharapkan ridho Allah Subhanahu Wataala,
Terima kasih telah melakukan pembayaran SPP kepada bagian keuangan kami sebesar *Rp. ' . number_format($nominal, 0, ',', '.') . '*-.
Alhamdulillah pembayaran bapak/ibu telah tercatat lunas pada sistem kami. Semoga Allah Subhanahu Wa Taala memberikan kemudahan kepada Bapak/Ibu dalam proses pembelajaran Al Quran.

Saat ini kami membuka kesempatan untuk bapak/ibu dalam program pengembangan dakwah Rumah Tahfizh QUran Ar Rahmah dengan berinfak sebesar Rp 20.000,- melalui transfer ke rekening 2182182226 (BNI Syariah) a.n. Rumah Tahfidz Quran Putra Ar Rahmah. Tambahkan angka 26 untuk kode transaksi pengembangan dakwah. contoh Transfer : Rp 20.026,-

Tetap jaga kesehatan dan ikuti protokol kesehatan selama masa pembatasan sosial skala besar.
Semoga Allah Subhanahu Wa Taala senantiasa melindungi kita semua. Aamiin Yaa Robbal Aalamiin

Salam,
*LTTQ Ar Rahmah Balikpapan*';
        }

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

        return redirect()->route('admin.tahsins.pembayaran')
            ->withFlashSuccess('Pembayaran Atas Nama : <br>' . $request->namapembayaran . '<br>Dengan Nominal ' . $request->nominalpembayaran . '<br><strong>Berhasil</strong>');
    }

    public function ujian(ManageTahsinRequest $request)
    {
        $datajadwals = DB::table('tahsins')
            ->select('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY jadwal_tahsin ASC'))
            ->where('jenis_peserta', 'IKHWAN')
            ->paginate(2000);

        return view('backend.tahsin.ujian', compact('datajadwals'));
    }

    public function pesertaujian(ManageTahsinRequest $request)
    {
        $paged         = $request->get('paged') ?? 10;
        $nama          = $request->get('nama') ?? null;

        $pesertaujians = PesertaUjian::where('angkatan_ujian', session('angkatan_tahsin'))->paginate($paged);
        return view('backend.tahsin.daftar-ujian', compact('pesertaujians', 'paged'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageTahsinRequest    $request
     *
     * @return mixed
     */
    public function create(ManageTahsinRequest $request)
    {
        return view('backend.tahsin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTahsinRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreTahsinRequest $request)
    {
        $this->tahsinRepository->create($request->only(
            'no_tahsin',
            'nama_peserta',
            'nohp_peserta',
            'level_peserta',
            'nama_pengajar',
            'jadwal_tahsin',
            'sudah_daftar_tahsin',
            'belum_daftar_tahsin',
            'keterangan_tahsin',
            'pindahan_tahsin',
            'pindahan_tahsin_2',
            'jenis_peserta',
            'angkatan_peserta'
        ));

        // Fire create event (TahsinCreated)
        event(new TahsinCreated($request));

        return redirect()->route('admin.tahsins.index')
            ->withFlashSuccess(__('backend_tahsins.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageTahsinRequest  $request
     * @param Tahsin               $tahsin
     *
     * @return mixed
     */
    public function show(ManageTahsinRequest $request, Tahsin $tahsin)
    {
        return view('backend.tahsin.show')->withTahsin($tahsin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageTahsinRequest $request
     * @param Tahsin              $tahsin
     *
     * @return mixed
     */
    public function edit(ManageTahsinRequest $request, Tahsin $tahsin)
    {
        return view('backend.tahsin.edit')->withTahsin($tahsin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTahsinRequest  $request
     * @param Tahsin               $tahsin
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateTahsinRequest $request, Tahsin $tahsin)
    {
        $this->tahsinRepository->update($tahsin, $request->only(
            'nama_peserta',
            'nohp_peserta',
            'level_peserta',
            'nama_pengajar',
            'jadwal_tahsin',
            'sudah_daftar_tahsin',
            'belum_daftar_tahsin',
            'keterangan_tahsin',
            'pindahan_tahsin',
            'pindahan_tahsin_2',
            'jenis_peserta',
            'angkatan_peserta'
        ));

        // Fire update event (TahsinUpdated)
        event(new TahsinUpdated($request));

        return redirect()->route('admin.tahsins.index')
            ->withFlashSuccess(__('backend_tahsins.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageTahsinRequest $request
     * @param Tahsin              $tahsin
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageTahsinRequest $request, Tahsin $tahsin)
    {
        $this->tahsinRepository->deleteById($tahsin->id);
        // $data  = Tahsin::where('id', $tahsin->id)->first();
        // $nama  = $data->nama_peserta;
        // $level = $data->level_peserta;
        // Fire delete event (TahsinDeleted)
        event(new TahsinDeleted($request));

        return redirect()->route('admin.tahsins.index')
            // ->withFlashSuccess($nama . ' - ' . $level . ' Berhasil Dihapus');
            ->withFlashSuccess(' Berhasil Dihapus');
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageTahsinRequest $request
     * @param Tahsin              $deletedTahsin
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageTahsinRequest $request, Tahsin $deletedTahsin)
    {
        $this->tahsinRepository->forceDelete($deletedTahsin);

        return redirect()->route('admin.tahsins.deleted')
            ->withFlashSuccess(__('backend_tahsins.alerts.deleted_permanently'));
    }

    /**
     * @param ManageTahsinRequest $request
     * @param Tahsin              $deletedTahsin
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageTahsinRequest $request, Tahsin $deletedTahsin)
    {
        $this->tahsinRepository->restore($deletedTahsin);

        return redirect()->route('admin.tahsins.index')
            ->withFlashSuccess(__('backend_tahsins.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageTahsinRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageTahsinRequest $request)
    {
        return view('backend.tahsin.deleted')
            ->withtahsins($this->tahsinRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
