<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Imports\TahsinsImport;
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


class TahsinController extends Controller
{
    /**
     * @var TahsinRepository
     */
    protected $tahsinRepository;

    /**
     * TahsinController constructor.
     *
     * @param TahsinRepository $tahsinRepository
     */
    public function __construct(TahsinRepository $tahsinRepository)
    {
        $this->tahsinRepository = $tahsinRepository;
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

        $nama          = $request->input('nama') ?? null;
        $kenaikanlevel = $request->get('kenaikanlevel') ?? null;
        $idtahsin      = $request->get('idtahsin') ?? null;

        if(isset($kenaikanlevel)){
            $updatelevel = DB::table('tahsins')
              ->where('no_tahsin', $idtahsin)
              ->update(['kenaikan_level_peserta' => $kenaikanlevel]);

            $tahsins = \App\Models\Tahsin::search($nama)
              ->paginate(10);

            return view('backend.tahsin.index', compact('tahsins'))->withFlashSuccess($idtahsin.'Berhasil Diperbaruhi');
        }

        $tahsins = \App\Models\Tahsin::search($nama)
            ->paginate(10);

        return view('backend.tahsin.index', compact('tahsins'));
    }

    public function upload(ManageTahsinRequest $request)
    {
        return view('backend.tahsin.upload')
            ->withtahsins($this->tahsinRepository->getActivePaginated(50, 'id', 'desc'));
    }

    public function jadwal(ManageTahsinRequest $request)
    {
        $datajadwals = DB::table('tahsins')
            ->select('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
            ->groupBy('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY jadwal_tahsin ASC'))
            ->paginate(5000);

        return view('backend.tahsin.jadwal', compact('datajadwals'));
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
        $angkatan  = '16';

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

    public function daftarpesertaujian(ManageTahsinRequest $request)
    {
        $paged         = $request->get('paged') ?? 10;
        $nama          = $request->get('nama') ?? null;
        $pesertaujians = PesertaUjian::paginate($paged);
        return view('backend.tahsin.ujian-daftarulang', compact('pesertaujians', 'paged'));
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
