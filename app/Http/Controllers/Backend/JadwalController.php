<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;

use Session;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Webpatser\Uuid\Uuid;
use App\Imports\JadwalsImport;

use App\Models\Jadwal;
use App\Repositories\Backend\JadwalRepository;
use App\Http\Requests\Backend\Jadwal\ManageJadwalRequest;
use App\Http\Requests\Backend\Jadwal\StoreJadwalRequest;
use App\Http\Requests\Backend\Jadwal\UpdateJadwalRequest;

use App\Events\Backend\Jadwal\JadwalCreated;
use App\Events\Backend\Jadwal\JadwalUpdated;
use App\Events\Backend\Jadwal\JadwalDeleted;

class JadwalController extends Controller
{
    /**
     * @var JadwalRepository
     */
    protected $jadwalRepository;

    /**
     * JadwalController constructor.
     *
     * @param JadwalRepository $jadwalRepository
     */
    public function __construct(JadwalRepository $jadwalRepository)
    {
        $this->jadwalRepository = $jadwalRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageJadwalRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageJadwalRequest $request)
    {
        return view('backend.jadwal.index')
            ->withjadwals($this->jadwalRepository->getActivePaginated(25, 'id', 'asc'));
    }

    public function upload(ManageJadwalRequest $request)
    {
        return view('backend.jadwal.upload')
            ->withjadwals($this->jadwalRepository->getActivePaginated(25, 'id', 'asc'));
    }

    public function import(Request $request){

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
            $dataimport = new JadwalsImport;

            Excel::import($dataimport, public_path('/file_import/'.$nama_file));

            $banyakdata = $dataimport->getRowCount();

            // alihkan halaman kembali
            return redirect()->route('admin.jadwals.upload')
            ->withFlashSuccess('Upload File Excel Peserta Berhasil. Total '.$banyakdata.' Data');
        } else {
            return redirect()->route('admin.jadwals.upload')->withFlashSuccess('Upload Gagal');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageJadwalRequest    $request
     *
     * @return mixed
     */
    public function create(ManageJadwalRequest $request)
    {
        return view('backend.jadwal.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param StoreJadwalRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreJadwalRequest $request)
    {
        $this->jadwalRepository->create($request->only(
            'no_jadwal',
            'nama_peserta',
            'nohp_peserta',
            'level_peserta',
            'nama_pengajar',
            'jadwal_tahsin',
            'sudah_daftar_jadwal',
            'belum_daftar_jadwal',
            'keterangan_jadwal',
            'pindahan_jadwal',
            'pindahan_jadwal_2',
            'jenis_peserta',
            'angkatan_peserta'
        ));

        // Fire create event (JadwalCreated)
        event(new JadwalCreated($request));

        return redirect()->route('admin.jadwals.index')
            ->withFlashSuccess(__('backend_jadwals.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageJadwalRequest  $request
     * @param Jadwal               $jadwal
     *
     * @return mixed
     */
    public function show(ManageJadwalRequest $request, Jadwal $jadwal)
    {
        return view('backend.jadwal.show')->withJadwal($jadwal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageJadwalRequest $request
     * @param Jadwal              $jadwal
     *
     * @return mixed
     */
    public function edit(ManageJadwalRequest $request, Jadwal $jadwal)
    {
        return view('backend.jadwal.edit')->withJadwal($jadwal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJadwalRequest  $request
     * @param Jadwal               $jadwal
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateJadwalRequest $request, Jadwal $jadwal)
    {
        $this->jadwalRepository->update($jadwal, $request->only(
            'nama_peserta',
            'nohp_peserta',
            'level_peserta',
            'nama_pengajar',
            'jadwal_tahsin',
            'sudah_daftar_jadwal',
            'belum_daftar_jadwal',
            'keterangan_jadwal',
            'pindahan_jadwal',
            'pindahan_jadwal_2',
            'jenis_peserta',
            'angkatan_peserta'
        ));

        // Fire update event (JadwalUpdated)
        event(new JadwalUpdated($request));

        return redirect()->route('admin.jadwals.index')
            ->withFlashSuccess(__('backend_jadwals.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageJadwalRequest $request
     * @param Jadwal              $jadwal
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageJadwalRequest $request, Jadwal $jadwal)
    {
        $this->jadwalRepository->deleteById($jadwal->id);

        // Fire delete event (JadwalDeleted)
        event(new JadwalDeleted($request));

        return redirect()->route('admin.jadwals.index')
            ->withFlashSuccess(__('backend_jadwals.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageJadwalRequest $request
     * @param Jadwal              $deletedJadwal
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageJadwalRequest $request, Jadwal $deletedJadwal)
    {
        $this->jadwalRepository->forceDelete($deletedJadwal);

        return redirect()->route('admin.jadwals.deleted')
            ->withFlashSuccess(__('backend_jadwals.alerts.deleted_permanently'));
    }

    /**
     * @param ManageJadwalRequest $request
     * @param Jadwal              $deletedJadwal
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageJadwalRequest $request, Jadwal $deletedJadwal)
    {
        $this->jadwalRepository->restore($deletedJadwal);

        return redirect()->route('admin.jadwals.index')
            ->withFlashSuccess(__('backend_jadwals.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageJadwalRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageJadwalRequest $request)
    {
        return view('backend.jadwal.deleted')
            ->withjadwals($this->jadwalRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
