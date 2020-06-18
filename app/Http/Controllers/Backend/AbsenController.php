<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;

use App\Models\Absen;
use App\Repositories\Backend\AbsenRepository;
use App\Http\Requests\Backend\Absen\ManageAbsenRequest;
use App\Http\Requests\Backend\Absen\StoreAbsenRequest;
use App\Http\Requests\Backend\Absen\UpdateAbsenRequest;

use App\Events\Backend\Absen\AbsenCreated;
use App\Events\Backend\Absen\AbsenUpdated;
use App\Events\Backend\Absen\AbsenDeleted;

class AbsenController extends Controller
{
    /**
     * @var AbsenRepository
     */
    protected $absenRepository;

    /**
     * AbsenController constructor.
     *
     * @param AbsenRepository $absenRepository
     */
    public function __construct(AbsenRepository $absenRepository)
    {
        $this->absenRepository = $absenRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageAbsenRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageAbsenRequest $request)
    {
        return view('backend.absen.index')
            ->withabsens($this->absenRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageAbsenRequest    $request
     *
     * @return mixed
     */
    public function create(ManageAbsenRequest $request)
    {
        return view('backend.absen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAbsenRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreAbsenRequest $request)
    {
        $this->absenRepository->create($request->only(
            'id_peserta'
        ));

        // Fire create event (AbsenCreated)
        event(new AbsenCreated($request));

        return redirect()->route('admin.absens.index')
            ->withFlashSuccess(__('backend_absens.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageAbsenRequest  $request
     * @param Absen               $absen
     *
     * @return mixed
     */
    public function show(ManageAbsenRequest $request, Absen $absen)
    {
        return view('backend.absen.show')->withAbsen($absen);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageAbsenRequest $request
     * @param Absen              $absen
     *
     * @return mixed
     */
    public function edit(ManageAbsenRequest $request, Absen $absen)
    {
        return view('backend.absen.edit')->withAbsen($absen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAbsenRequest  $request
     * @param Absen               $absen
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateAbsenRequest $request, Absen $absen)
    {
        $this->absenRepository->update($absen, $request->only(
            'id_peserta'
        ));

        // Fire update event (AbsenUpdated)
        event(new AbsenUpdated($request));

        return redirect()->route('admin.absens.index')
            ->withFlashSuccess(__('backend_absens.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageAbsenRequest $request
     * @param Absen              $absen
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageAbsenRequest $request, Absen $absen)
    {
        $this->absenRepository->deleteById($absen->id);

        // Fire delete event (AbsenDeleted)
        event(new AbsenDeleted($request));

        return redirect()->route('admin.absens.deleted')
            ->withFlashSuccess(__('backend_absens.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageAbsenRequest $request
     * @param Absen              $deletedAbsen
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageAbsenRequest $request, Absen $deletedAbsen)
    {
        $this->absenRepository->forceDelete($deletedAbsen);

        return redirect()->route('admin.absens.deleted')
            ->withFlashSuccess(__('backend_absens.alerts.deleted_permanently'));
    }

    /**
     * @param ManageAbsenRequest $request
     * @param Absen              $deletedAbsen
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageAbsenRequest $request, Absen $deletedAbsen)
    {
        $this->absenRepository->restore($deletedAbsen);

        return redirect()->route('admin.absens.index')
            ->withFlashSuccess(__('backend_absens.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageAbsenRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageAbsenRequest $request)
    {
        return view('backend.absen.deleted')
            ->withabsens($this->absenRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
