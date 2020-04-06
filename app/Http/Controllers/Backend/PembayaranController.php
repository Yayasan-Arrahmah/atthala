<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;

use App\Models\Pembayaran;
use App\Repositories\Backend\PembayaranRepository;
use App\Http\Requests\Backend\Pembayaran\ManagePembayaranRequest;
use App\Http\Requests\Backend\Pembayaran\StorePembayaranRequest;
use App\Http\Requests\Backend\Pembayaran\UpdatePembayaranRequest;

use App\Events\Backend\Pembayaran\PembayaranCreated;
use App\Events\Backend\Pembayaran\PembayaranUpdated;
use App\Events\Backend\Pembayaran\PembayaranDeleted;

class PembayaranController extends Controller
{
    /**
     * @var PembayaranRepository
     */
    protected $pembayaranRepository;

    /**
     * PembayaranController constructor.
     *
     * @param PembayaranRepository $pembayaranRepository
     */
    public function __construct(PembayaranRepository $pembayaranRepository)
    {
        $this->pembayaranRepository = $pembayaranRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManagePembayaranRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManagePembayaranRequest $request)
    {
        return view('backend.pembayaran.index')
            ->withpembayarans($this->pembayaranRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManagePembayaranRequest    $request
     *
     * @return mixed
     */
    public function create(ManagePembayaranRequest $request)
    {
        return view('backend.pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePembayaranRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StorePembayaranRequest $request)
    {
        $this->pembayaranRepository->create($request->only(
            'uuid_pembayaran'
        ));

        // Fire create event (PembayaranCreated)
        event(new PembayaranCreated($request));

        return redirect()->route('admin.pembayarans.index')
            ->withFlashSuccess(__('backend_pembayarans.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManagePembayaranRequest  $request
     * @param Pembayaran               $pembayaran
     *
     * @return mixed
     */
    public function show(ManagePembayaranRequest $request, Pembayaran $pembayaran)
    {
        return view('backend.pembayaran.show')->withPembayaran($pembayaran);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManagePembayaranRequest $request
     * @param Pembayaran              $pembayaran
     *
     * @return mixed
     */
    public function edit(ManagePembayaranRequest $request, Pembayaran $pembayaran)
    {
        return view('backend.pembayaran.edit')->withPembayaran($pembayaran);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePembayaranRequest  $request
     * @param Pembayaran               $pembayaran
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdatePembayaranRequest $request, Pembayaran $pembayaran)
    {
        $this->pembayaranRepository->update($pembayaran, $request->only(
            'uuid_pembayaran'
        ));

        // Fire update event (PembayaranUpdated)
        event(new PembayaranUpdated($request));

        return redirect()->route('admin.pembayarans.index')
            ->withFlashSuccess(__('backend_pembayarans.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManagePembayaranRequest $request
     * @param Pembayaran              $pembayaran
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManagePembayaranRequest $request, Pembayaran $pembayaran)
    {
        $this->pembayaranRepository->deleteById($pembayaran->id);

        // Fire delete event (PembayaranDeleted)
        event(new PembayaranDeleted($request));

        return redirect()->route('admin.pembayarans.deleted')
            ->withFlashSuccess(__('backend_pembayarans.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManagePembayaranRequest $request
     * @param Pembayaran              $deletedPembayaran
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManagePembayaranRequest $request, Pembayaran $deletedPembayaran)
    {
        $this->pembayaranRepository->forceDelete($deletedPembayaran);

        return redirect()->route('admin.pembayarans.deleted')
            ->withFlashSuccess(__('backend_pembayarans.alerts.deleted_permanently'));
    }

    /**
     * @param ManagePembayaranRequest $request
     * @param Pembayaran              $deletedPembayaran
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManagePembayaranRequest $request, Pembayaran $deletedPembayaran)
    {
        $this->pembayaranRepository->restore($deletedPembayaran);

        return redirect()->route('admin.pembayarans.index')
            ->withFlashSuccess(__('backend_pembayarans.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManagePembayaranRequest $request
     *
     * @return mixed
     */
    public function deleted(ManagePembayaranRequest $request)
    {
        return view('backend.pembayaran.deleted')
            ->withpembayarans($this->pembayaranRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
