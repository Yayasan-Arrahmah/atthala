<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Models\RtqPeriodeRapor;

use App\Models\Rtq;
use App\Repositories\Backend\RtqRepository;
use App\Http\Requests\Backend\Rtq\ManageRtqRequest;
use App\Http\Requests\Backend\Rtq\StoreRtqRequest;
use App\Http\Requests\Backend\Rtq\UpdateRtqRequest;

use App\Events\Backend\Rtq\RtqCreated;
use App\Events\Backend\Rtq\RtqUpdated;
use App\Events\Backend\Rtq\RtqDeleted;

class RtqController extends Controller
{
    /**
     * @var RtqRepository
     */
    protected $rtqRepository;

    /**
     * RtqController constructor.
     *
     * @param RtqRepository $rtqRepository
     */
    public function __construct(RtqRepository $rtqRepository)
    {
        $this->rtqRepository = $rtqRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageRtqRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageRtqRequest $request)
    {
        $perioderapor    = RtqPeriodeRapor::all()->sortByDesc('id');
        $setperioderapor = RtqPeriodeRapor::latest('created_at')->first();
        if (auth()->user()->last_name === 'Admin'){
            $halaqoh         = Rtq::select('pengajar_santri')
                                ->groupBy('pengajar_santri')
                                ->paginate(100);
        } else {
            $halaqoh         = Rtq::select('pengajar_santri')
                            ->groupBy('pengajar_santri')
                            ->where('jenis_santri', auth()->user()->jenis)
                            ->paginate(100);
        }


        return view('backend.rtq.index', compact('perioderapor', 'setperioderapor', 'halaqoh'))
            ->withrtqs($this->rtqRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageRtqRequest    $request
     *
     * @return mixed
     */
    public function create(ManageRtqRequest $request)
    {
        return view('backend.rtq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRtqRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreRtqRequest $request)
    {
        $this->rtqRepository->create($request->only(
            'nis_santri',
            'nama_santri',
            'notelp_santri',
            'jenis_santri',
            'status_santri',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'nama_ayah',
            'pekerjaan_ayah',
            'penghasilan_ayah',
            'nama_ibu',
            'pekerjaan_ibu',
            'penghasilan_ibu',
            'alamat_orangtua',
            'tanggal_masuk',
            'jumlah_hafalan',
            'pengalaman_pesantren',
            'riwayat_pendidikan',
            'spp_disanggupi',
            'angkatan_santri',
            'pengajar_santri',
            'domisili',
            'kriteria',
            'keterangan',
        ));

        // Fire create event (RtqCreated)
        event(new RtqCreated($request));

        return redirect()->route('admin.rtqs.index')
            ->withFlashSuccess('Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param ManageRtqRequest  $request
     * @param Rtq               $rtq
     *
     * @return mixed
     */
    public function show(ManageRtqRequest $request, Rtq $rtq)
    {
        return view('backend.rtq.show')->withRtq($rtq);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageRtqRequest $request
     * @param Rtq              $rtq
     *
     * @return mixed
     */
    public function edit(ManageRtqRequest $request, Rtq $rtq)
    {
        return view('backend.rtq.edit')->withRtq($rtq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRtqRequest  $request
     * @param Rtq               $rtq
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateRtqRequest $request, Rtq $rtq)
    {
        $this->rtqRepository->update($rtq, $request->only(
            'nis_santri',
            'nama_santri',
            'notelp_santri',
            'jenis_santri',
            'status_santri',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'nama_ayah',
            'pekerjaan_ayah',
            'penghasilan_ayah',
            'nama_ibu',
            'pekerjaan_ibu',
            'penghasilan_ibu',
            'alamat_orangtua',
            'tanggal_masuk',
            'jumlah_hafalan',
            'pengalaman_pesantren',
            'riwayat_pendidikan',
            'spp_disanggupi',
            'pengajar_santri',
            'angkatan_santri',
            'domisili',
            'kriteria',
            'keterangan',
        ));

        // Fire update event (RtqUpdated)
        event(new RtqUpdated($request));

        return redirect()->route('admin.rtqs.index')
            ->withFlashSuccess('Berhasil Diperbaruhi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageRtqRequest $request
     * @param Rtq              $rtq
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageRtqRequest $request, Rtq $rtq)
    {
        $this->rtqRepository->deleteById($rtq->id);

        // Fire delete event (RtqDeleted)
        event(new RtqDeleted($request));

        return redirect()->route('admin.rtqs.deleted')
            ->withFlashSuccess('Berhasil Di Non-Aktifkan');
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageRtqRequest $request
     * @param Rtq              $deletedRtq
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageRtqRequest $request, Rtq $deletedRtq)
    {
        $this->rtqRepository->forceDelete($deletedRtq);

        return redirect()->route('admin.rtqs.deleted')
            ->withFlashSuccess('Berhasil Dihapus');
    }

    /**
     * @param ManageRtqRequest $request
     * @param Rtq              $deletedRtq
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageRtqRequest $request, Rtq $deletedRtq)
    {
        $this->rtqRepository->restore($deletedRtq);

        return redirect()->route('admin.rtqs.index')
            ->withFlashSuccess('Berhasil Di Aktifkan Kembali');
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageRtqRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageRtqRequest $request)
    {
        return view('backend.rtq.deleted')
            ->withrtqs($this->rtqRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
