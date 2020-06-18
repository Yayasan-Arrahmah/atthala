<?php

namespace App\Repositories\Backend;

use App\Models\Absen;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class AbsenRepository.
 */
class AbsenRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Absen::class;
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
     * @return Absen
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Absen
    {
        return DB::transaction(function () use ($data) {
            $absen = parent::create([
                'id_peserta' => $data['id_peserta'],
            ]);

            if ($absen) {
                return $absen;
            }

            throw new GeneralException(__('backend_absens.exceptions.create_error'));
        });
    }

    /**
     * @param Absen  $absen
     * @param array     $data
     *
     * @return Absen
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Absen $absen, array $data) : Absen
    {
        return DB::transaction(function () use ($absen, $data) {
            if ($absen->update([
                'id_peserta' => $data['id_peserta'],
            ])) {

                return $absen;
            }

            throw new GeneralException(__('backend_absens.exceptions.update_error'));
        });
    }

    /**
     * @param Absen $absen
     *
     * @return Absen
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Absen $absen) : Absen
    {
        if (is_null($absen->deleted_at)) {
            throw new GeneralException(__('backend_absens.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($absen) {
            if ($absen->forceDelete()) {
                return $absen;
            }

            throw new GeneralException(__('backend_absens.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Absen $absen
     *
     * @return Absen
     * @throws GeneralException
     */
    public function restore(Absen $absen) : Absen
    {
        if (is_null($absen->deleted_at)) {
            throw new GeneralException(__('backend_absens.exceptions.cant_restore'));
        }

        if ($absen->restore()) {
            return $absen;
        }

        throw new GeneralException(__('backend_absens.exceptions.restore_error'));
    }
}
