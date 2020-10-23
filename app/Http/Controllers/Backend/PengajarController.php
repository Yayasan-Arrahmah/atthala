<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;

use App\Models\Pengajar;
use App\Repositories\Backend\PengajarRepository;
use App\Http\Requests\Backend\Pengajar\ManagePengajarRequest;
use App\Http\Requests\Backend\Pengajar\StorePengajarRequest;
use App\Http\Requests\Backend\Pengajar\UpdatePengajarRequest;

use App\Events\Backend\Pengajar\PengajarCreated;
use App\Events\Backend\Pengajar\PengajarUpdated;
use App\Events\Backend\Pengajar\PengajarDeleted;

class PengajarController extends Controller
{
    /**
     * @var PengajarRepository
     */
    protected $pengajarRepository;

    /**
     * PengajarController constructor.
     *
     * @param PengajarRepository $pengajarRepository
     */
    public function __construct(PengajarRepository $pengajarRepository)
    {
        $this->pengajarRepository = $pengajarRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManagePengajarRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManagePengajarRequest $request)
    {
        return view('backend.pengajar.index')
            ->withpengajars($this->pengajarRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManagePengajarRequest    $request
     *
     * @return mixed
     */
    public function create(ManagePengajarRequest $request)
    {
        return view('backend.pengajar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePengajarRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StorePengajarRequest $request)
    {
        $this->pengajarRepository->create($request->only(
            'nama_pengajar'
        ));

        // Fire create event (PengajarCreated)
        event(new PengajarCreated($request));

        return redirect()->route('admin.pengajars.index')
            ->withFlashSuccess(__('backend_pengajars.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManagePengajarRequest  $request
     * @param Pengajar               $pengajar
     *
     * @return mixed
     */
    public function show(ManagePengajarRequest $request, Pengajar $pengajar)
    {
        return view('backend.pengajar.show')->withPengajar($pengajar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManagePengajarRequest $request
     * @param Pengajar              $pengajar
     *
     * @return mixed
     */
    public function edit(ManagePengajarRequest $request, Pengajar $pengajar)
    {
        return view('backend.pengajar.edit')->withPengajar($pengajar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePengajarRequest  $request
     * @param Pengajar               $pengajar
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdatePengajarRequest $request, Pengajar $pengajar)
    {
        $this->pengajarRepository->update($pengajar, $request->only(
            'nama_pengajar'
        ));

        // Fire update event (PengajarUpdated)
        event(new PengajarUpdated($request));

        return redirect()->route('admin.pengajars.index')
            ->withFlashSuccess(__('backend_pengajars.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManagePengajarRequest $request
     * @param Pengajar              $pengajar
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManagePengajarRequest $request, Pengajar $pengajar)
    {
        $this->pengajarRepository->deleteById($pengajar->id);

        // Fire delete event (PengajarDeleted)
        event(new PengajarDeleted($request));

        return redirect()->route('admin.pengajars.deleted')
            ->withFlashSuccess(__('backend_pengajars.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManagePengajarRequest $request
     * @param Pengajar              $deletedPengajar
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManagePengajarRequest $request, Pengajar $deletedPengajar)
    {
        $this->pengajarRepository->forceDelete($deletedPengajar);

        return redirect()->route('admin.pengajars.deleted')
            ->withFlashSuccess(__('backend_pengajars.alerts.deleted_permanently'));
    }

    /**
     * @param ManagePengajarRequest $request
     * @param Pengajar              $deletedPengajar
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManagePengajarRequest $request, Pengajar $deletedPengajar)
    {
        $this->pengajarRepository->restore($deletedPengajar);

        return redirect()->route('admin.pengajars.index')
            ->withFlashSuccess(__('backend_pengajars.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManagePengajarRequest $request
     *
     * @return mixed
     */
    public function deleted(ManagePengajarRequest $request)
    {
        return view('backend.pengajar.deleted')
            ->withpengajars($this->pengajarRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
