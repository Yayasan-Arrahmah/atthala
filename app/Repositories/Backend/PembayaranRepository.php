<?php

namespace App\Repositories\Backend;

use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PembayaranRepository.
 */
class PembayaranRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Pembayaran::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Pembayaran
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Pembayaran
    {
        return DB::transaction(function () use ($data) {
            $pembayaran = parent::create([
                'uuid_pembayaran' => $data['uuid_pembayaran'],
            ]);

            if ($pembayaran) {
                return $pembayaran;
            }

            throw new GeneralException(__('backend_pembayarans.exceptions.create_error'));
        });
    }

    /**
     * @param Pembayaran  $pembayaran
     * @param array     $data
     *
     * @return Pembayaran
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Pembayaran $pembayaran, array $data) : Pembayaran
    {
        return DB::transaction(function () use ($pembayaran, $data) {
            if ($pembayaran->update([
                'uuid_pembayaran' => $data['uuid_pembayaran'],
            ])) {

                return $pembayaran;
            }

            throw new GeneralException(__('backend_pembayarans.exceptions.update_error'));
        });
    }

    /**
     * @param Pembayaran $pembayaran
     *
     * @return Pembayaran
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Pembayaran $pembayaran) : Pembayaran
    {
        if (is_null($pembayaran->deleted_at)) {
            throw new GeneralException(__('backend_pembayarans.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($pembayaran) {
            if ($pembayaran->forceDelete()) {
                return $pembayaran;
            }

            throw new GeneralException(__('backend_pembayarans.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Pembayaran $pembayaran
     *
     * @return Pembayaran
     * @throws GeneralException
     */
    public function restore(Pembayaran $pembayaran) : Pembayaran
    {
        if (is_null($pembayaran->deleted_at)) {
            throw new GeneralException(__('backend_pembayarans.exceptions.cant_restore'));
        }

        if ($pembayaran->restore()) {
            return $pembayaran;
        }

        throw new GeneralException(__('backend_pembayarans.exceptions.restore_error'));
    }
}
