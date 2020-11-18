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
use Illuminate\Support\Facades\DB;

use App\Models\Jadwal;
use App\Repositories\Backend\JadwalRepository;
use App\Http\Requests\Backend\Jadwal\ManageJadwalRequest;
use App\Http\Requests\Backend\Jadwal\StoreJadwalRequest;
use App\Http\Requests\Backend\Jadwal\UpdateJadwalRequest;

use App\Events\Backend\Jadwal\JadwalCreated;
use App\Events\Backend\Jadwal\JadwalUpdated;
use App\Events\Backend\Jadwal\JadwalDeleted;
use App\Imports\JadwalTambahData;

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
        // $duplicates = collect(DB::table('jadwals')->select('nohp_peserta')->get());
        $jadwals = DB::table('jadwals')
                            ->where('angkatan_jadwal', session('angkatan_tahsin'))
                            ->get();


        return view('backend.jadwal.index', compact('jadwals'))
            ->withjadwals($this->jadwalRepository->getActivePaginated(200, 'jumlah_peserta', 'asc'));
    }

    public function upload(ManageJadwalRequest $request)
    {
        return view('backend.jadwal.upload')
            ->withjadwals($this->jadwalRepository->getActivePaginated(25, 'id', 'asc'));
    }

    public function import(Request $request)
    {

        if ($request->hasFile('file')) {

            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            $dataimport = new JadwalTambahData;

            Excel::import($dataimport, request()->file('file'));

            $banyakdata = $dataimport->getRowCount();

            // alihkan halaman kembali
            return redirect()->back()
            ->withFlashSuccess('Upload File Excel Jadwal Berhasil. Total '.$banyakdata.' Data');
        } else {
            return redirect()->back()->withFlashSuccess('Upload Gagal');
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
            'pengajar_jadwal',
            'level_jadwal',
            'hari_jadwal',
            'waktu_jadwal',
            'jenis_jadwal',
            'angkatan_jadwal',
        ));

        // Fire create event (JadwalCreated)
        event(new JadwalCreated($request));

        return redirect()->route('admin.jadwals.index')
            ->withFlashSuccess('Berhasil Ditambahkan');
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
            'pengajar_jadwal',
            'level_jadwal',
            'hari_jadwal',
            'waktu_jadwal',
            'jenis_jadwal',
            'angkatan_jadwal',
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
        // $this->jadwalRepository->deleteById($jadwal->id);

        $data = Jadwal::find($jadwal->id);
        $data->delete();

        // Fire delete event (JadwalDeleted)
        // event(new JadwalDeleted($request));

        return redirect()->route('admin.jadwals.index')
            ->withFlashSuccess('Data Jadwal Berhasil Dihapus');
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

        return redirect()->route('admin.jadwals.index')
            ->withFlashSuccess('Data Jadwal Berhasil Dihapus');
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
