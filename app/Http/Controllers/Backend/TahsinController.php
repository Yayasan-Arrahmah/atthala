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

use App\Models\Tahsin;
use App\Repositories\Backend\TahsinRepository;
use App\Http\Requests\Backend\Tahsin\ManageTahsinRequest;
use App\Http\Requests\Backend\Tahsin\StoreTahsinRequest;
use App\Http\Requests\Backend\Tahsin\UpdateTahsinRequest;

use App\Events\Backend\Tahsin\TahsinCreated;
use App\Events\Backend\Tahsin\TahsinUpdated;
use App\Events\Backend\Tahsin\TahsinDeleted;

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

        return view('backend.tahsin.index')
            ->withtahsins($this->tahsinRepository->getActivePaginated(50, 'id', 'desc'));
    }

    public function upload(ManageTahsinRequest $request)
    {
        return view('backend.tahsin.upload')
            ->withtahsins($this->tahsinRepository->getActivePaginated(50, 'id', 'desc'));
    }

    public function jadwal(ManageTahsinRequest $request)
    {
        $datajadwals = DB::table('tahsins')
                        ->select('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta',(DB::raw('COUNT(*) as jumlah ')))
                        ->groupBy('jadwal_tahsin', 'level_peserta', 'nama_pengajar', 'jenis_peserta')
                        ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY jadwal_tahsin ASC'))
                        ->paginate(5000);

        return view('backend.tahsin.jadwal', compact('datajadwals'));
    }

    public function pengajar(ManageTahsinRequest $request)
    {
        $datapengajars = DB::table('tahsins')
                        ->select('nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
                        ->groupBy('nama_pengajar', 'jenis_peserta' )
                        ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
                        ->paginate(5000);

        return view('backend.tahsin.pengajar', compact('datapengajars'));
    }

    public function import(Request $request)
    {

        //buat session untuk ngakalin ngirim data
        $jenispeserta     = request('jenispeserta');
        $angkatanpeserta  = request('angkatanpeserta');
        $request->session()->put('jenispeserta', $jenispeserta );
        $request->session()->put('angkatanpeserta', $angkatanpeserta );

        if ($request->hasFile('file')) {

            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $mytime = Carbon::now();
            $nama_file = $mytime->toDateTimeString().'-'.rand().'-'.$file->getClientOriginalName();

            // upload ke folder file_import di dalam folder public
            $file->move('file_import',$nama_file);

            // import data
            // $dataimport = Carbon::now();
            $dataimport = new TahsinsImport;


            Excel::import($dataimport, public_path('/file_import/'.$nama_file));

            $banyakdata = $dataimport->getRowCount();

            // alihkan halaman kembali
            return redirect()->route('admin.tahsins.upload')
            ->withFlashSuccess('Upload File Excel Peserta Berhasil. Total '.$banyakdata.' Data');
        } else {
            return redirect()->route('admin.tahsins.upload')->withFlashSuccess('Upload Gagal');
        }
    }

    public function importPembayaran(Request $request)
    {

        //buat session untuk ngakalin ngirim data
        $jenispeserta     = request('jenispeserta');
        $angkatanpeserta  = request('angkatanpeserta');
        $request->session()->put('jenispeserta', $jenispeserta );
        $request->session()->put('angkatanpeserta', $angkatanpeserta );

        if ($request->hasFile('file')) {

            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $mytime = Carbon::now();
            $nama_file = $mytime->toDateTimeString().'-'.rand().'-'.$file->getClientOriginalName();

            // upload ke folder file_import di dalam folder public
            $file->move('file_import',$nama_file);

            // import data
            // $dataimport = Carbon::now();
            $dataimport = new PembayaransImport;


            Excel::import($dataimport, public_path('/file_import/'.$nama_file));

            $banyakdata = $dataimport->getRowCount();

            // alihkan halaman kembali
            return redirect()->route('admin.tahsins.upload')
            ->withFlashSuccess('Upload File Excel Pembayaran Berhasil. Total '.$banyakdata.' Data');
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

        return view('backend.tahsin.pembayaran', compact('nominal0','nominal1','nominal2','nominal3','nominal4', 'belumlunas', 'lunas'));
    }

    public function createbayar(Request $request)
    {
        $nominal = preg_replace("/[^0-9]/", "", $request->nominalpembayaran);

        $pembayaran = new Pembayaran;

        $pembayaran->id_peserta         = $request->id_peserta;
        $pembayaran->nominal_pembayaran = (int)$nominal;
        $pembayaran->jenis_pembayaran   = $request->jenispembayaran;
        $pembayaran->admin_pembayaran   = Auth::user()->email;

        $pembayaran->save();

        return redirect()->route('admin.tahsins.pembayaran')
        ->withFlashSuccess('Pembayaran Atas Nama : <br>'.$request->namapembayaran.'<br>Dengan Nominal '.$request->nominalpembayaran.'<br><strong>Berhasil</strong>');
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

        // Fire delete event (TahsinDeleted)
        event(new TahsinDeleted($request));

        return redirect()->route('admin.tahsins.deleted')
            ->withFlashSuccess(__('backend_tahsins.alerts.deleted'));
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