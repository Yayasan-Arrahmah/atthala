<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;
use Throwable;

use App\Models\Amalan;
use App\Models\AmalansListsAbsens;
use App\Repositories\Frontend\Amalan\AmalanRepository;
use App\Http\Requests\Frontend\Amalan\ManageAmalanRequest;
use App\Http\Requests\Frontend\Amalan\StoreAmalanRequest;
use App\Http\Requests\Frontend\Amalan\UpdateAmalanRequest;

use App\Events\Frontend\Amalan\AmalanCreated;
use App\Events\Frontend\Amalan\AmalanUpdated;
use App\Events\Frontend\Amalan\AmalanDeleted;

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
        return view('frontend.amalan.index')
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
        return view('frontend.amalan.create');
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
            'title'
        ));

        // Fire create event (AmalanCreated)
        event(new AmalanCreated($request));

        return redirect()->route('frontend.amalans.index')
            ->withFlashSuccess(__('frontend_amalans.alerts.created'));
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
        return view('frontend.amalan.show')->withAmalan($amalan);
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
        return view('frontend.amalan.edit')->withAmalan($amalan);
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
            'title'
        ));

        // Fire update event (AmalanUpdated)
        event(new AmalanUpdated($request));

        return redirect()->route('frontend.amalans.index')
            ->withFlashSuccess(__('frontend_amalans.alerts.updated'));
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

        return redirect()->route('frontend.amalans.deleted')
            ->withFlashSuccess(__('frontend_amalans.alerts.deleted'));
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

        return redirect()->route('frontend.amalans.deleted')
            ->withFlashSuccess(__('frontend_amalans.alerts.deleted_permanently'));
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

        return redirect()->route('frontend.amalans.index')
            ->withFlashSuccess(__('frontend_amalans.alerts.restored'));
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
        return view('frontend.amalan.deleted')
            ->withamalans($this->amalanRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    public function tambahabsen(Request $request)
    {
        $absen = new AmalansListsAbsens;
        $hariini_ = \Carbon\Carbon::now();

        $cektanggal = \Carbon\Carbon::create($hariini_->year, $request->bulan_amalan_list, $request->tanggal_amalan_list);

        // dd($hariini_->timestamp, $cektanggal->timestamp);

        if ($cektanggal > $hariini_) {
            return redirect()->route('frontend.user.amal-yaumiah', ['tanggal' => $request->tanggal_amalan_list])
                ->withFlashDanger('Maaf, Pilihan Tanggal Melampaui Tanggal Hari Ini. Input Gagal !');
        } else {
            $absen->id_amalan_list      = $request->id_amalan_list;
            $absen->user_amalan_list    = $request->user_amalan_list;
            $absen->waktu_amalan_list   = $request->waktu_amalan_list;
            $absen->tanggal_amalan_list = $request->tanggal_amalan_list;
            $absen->ket_amalan_list     = $request->ket_amalan_list;

            if ($absen->save()) {
                return redirect()->route('frontend.user.amal-yaumiah', ['tanggal' => $request->tanggal_amalan_list])
                    ->withFlashSuccess('Amalan Berhasil Diperbaruhi. Syukron !');
            } else {
                return redirect()->route('frontend.user.amal-yaumiah', ['tanggal' => $request->tanggal_amalan_list])
                    ->withFlashDanger('Amalan Tidak Berhasil Diperbaruhi. Afwan !. Mohon Ulangi.');
            }
        }
    }

    public function hapusabsen(Request $request)
    {
        $absen = AmalansListsAbsens::find($request->id);

        if ($absen->delete()) {
            return redirect()->route('frontend.user.amal-yaumiah', ['tanggal' => $request->tanggal_amalan_list])
                ->withFlashSuccess('Amalan Berhasil Dihapus. Syukron !');
        } else {
            return redirect()->route('frontend.user.amal-yaumiah', ['tanggal' => $request->tanggal_amalan_list])
                ->withFlashDanger('Amalan Tidak Berhasil Dihapus. Afwan !. Mohon Ulangi.');
        }
    }
}
