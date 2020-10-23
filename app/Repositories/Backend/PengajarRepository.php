<?php

namespace App\Repositories\Backend;

use App\Models\Pengajar;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PengajarRepository.
 */
class PengajarRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Pengajar::class;
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
     * @return Pengajar
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Pengajar
    {
        return DB::transaction(function () use ($data) {
            $pengajar = parent::create([
                'nama_pengajar' => $data['nama_pengajar'],
            ]);

            if ($pengajar) {
                return $pengajar;
            }

            throw new GeneralException(__('backend_pengajars.exceptions.create_error'));
        });
    }

    /**
     * @param Pengajar  $pengajar
     * @param array     $data
     *
     * @return Pengajar
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Pengajar $pengajar, array $data) : Pengajar
    {
        return DB::transaction(function () use ($pengajar, $data) {
            if ($pengajar->update([
                'nama_pengajar' => $data['nama_pengajar'],
            ])) {

                return $pengajar;
            }

            throw new GeneralException(__('backend_pengajars.exceptions.update_error'));
        });
    }

    /**
     * @param Pengajar $pengajar
     *
     * @return Pengajar
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Pengajar $pengajar) : Pengajar
    {
        if (is_null($pengajar->deleted_at)) {
            throw new GeneralException(__('backend_pengajars.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($pengajar) {
            if ($pengajar->forceDelete()) {
                return $pengajar;
            }

            throw new GeneralException(__('backend_pengajars.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Pengajar $pengajar
     *
     * @return Pengajar
     * @throws GeneralException
     */
    public function restore(Pengajar $pengajar) : Pengajar
    {
        if (is_null($pengajar->deleted_at)) {
            throw new GeneralException(__('backend_pengajars.exceptions.cant_restore'));
        }

        if ($pengajar->restore()) {
            return $pengajar;
        }

        throw new GeneralException(__('backend_pengajars.exceptions.restore_error'));
    }
}
