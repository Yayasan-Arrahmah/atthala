<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;

use App\Models\Amalan;
use App\Repositories\Backend\AmalanRepository;
use App\Http\Requests\Backend\Amalan\ManageAmalanRequest;
use App\Http\Requests\Backend\Amalan\StoreAmalanRequest;
use App\Http\Requests\Backend\Amalan\UpdateAmalanRequest;

use App\Events\Backend\Amalan\AmalanCreated;
use App\Events\Backend\Amalan\AmalanUpdated;
use App\Events\Backend\Amalan\AmalanDeleted;

class AmalanController extends Controller
{
    /**
     * @var AmalanRepository
     */
    protected $amalanRepository;

    /**
     * AmalanController constructor.
     *
     * @param AmalanRepository $amalanRepository
     */
    public function __construct(AmalanRepository $amalanRepository)
    {
        $this->amalanRepository = $amalanRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageAmalanRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageAmalanRequest $request)
    {
        return view('backend.amalan.index')
            ->withamalans($this->amalanRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageAmalanRequest    $request
     *
     * @return mixed
     */
    public function create(ManageAmalanRequest $request)
    {
        return view('backend.amalan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAmalanRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreAmalanRequest $request)
    {
        $this->amalanRepository->create($request->only(
            'nama_amalan',
        'deskripsi_amalan',
        'waktu_amalan',
        'user_create_amalan',
        ));

        // Fire create event (AmalanCreated)
        event(new AmalanCreated($request));

        return redirect()->route('admin.amalans.index')
            ->withFlashSuccess(__('backend_amalans.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageAmalanRequest  $request
     * @param Amalan               $amalan
     *
     * @return mixed
     */
    public function show(ManageAmalanRequest $request, Amalan $amalan)
    {
        return view('backend.amalan.show')->withAmalan($amalan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageAmalanRequest $request
     * @param Amalan              $amalan
     *
     * @return mixed
     */
    public function edit(ManageAmalanRequest $request, Amalan $amalan)
    {
        return view('backend.amalan.edit')->withAmalan($amalan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAmalanRequest  $request
     * @param Amalan               $amalan
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateAmalanRequest $request, Amalan $amalan)
    {
        $this->amalanRepository->update($amalan, $request->only(
        'nama_amalan',
        'deskripsi_amalan',
        // 'waktu_amalan',
        // 'user_create_amalan',
        ));

        // Fire update event (AmalanUpdated)
        event(new AmalanUpdated($request));

        return redirect()->route('admin.amalans.index')
            ->withFlashSuccess(__('backend_amalans.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageAmalanRequest $request
     * @param Amalan              $amalan
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageAmalanRequest $request, Amalan $amalan)
    {
        $this->amalanRepository->deleteById($amalan->id);

        // Fire delete event (AmalanDeleted)
        event(new AmalanDeleted($request));

        return redirect()->route('admin.amalans.deleted')
            ->withFlashSuccess(__('backend_amalans.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageAmalanRequest $request
     * @param Amalan              $deletedAmalan
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageAmalanRequest $request, Amalan $deletedAmalan)
    {
        $this->amalanRepository->forceDelete($deletedAmalan);

        return redirect()->route('admin.amalans.deleted')
            ->withFlashSuccess(__('backend_amalans.alerts.deleted_permanently'));
    }

    /**
     * @param ManageAmalanRequest $request
     * @param Amalan              $deletedAmalan
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageAmalanRequest $request, Amalan $deletedAmalan)
    {
        $this->amalanRepository->restore($deletedAmalan);

        return redirect()->route('admin.amalans.index')
            ->withFlashSuccess(__('backend_amalans.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageAmalanRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageAmalanRequest $request)
    {
        return view('backend.amalan.deleted')
            ->withamalans($this->amalanRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
