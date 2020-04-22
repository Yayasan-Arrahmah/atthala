<?php

namespace App\Repositories\Frontend\Amalan;

use App\Models\Amalan;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class AmalanRepository.
 */
class AmalanRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Amalan::class;
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
     * @return Amalan
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Amalan
    {
        return DB::transaction(function () use ($data) {
            $amalan = parent::create([
                'title' => $data['title'],
            ]);

            if ($amalan) {
                return $amalan;
            }

            throw new GeneralException(__('frontend_amalans.exceptions.create_error'));
        });
    }

    /**
     * @param Amalan  $amalan
     * @param array     $data
     *
     * @return Amalan
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Amalan $amalan, array $data) : Amalan
    {
        return DB::transaction(function () use ($amalan, $data) {
            if ($amalan->update([
                'title' => $data['title'],
            ])) {

                return $amalan;
            }

            throw new GeneralException(__('frontend_amalans.exceptions.update_error'));
        });
    }

    /**
     * @param Amalan $amalan
     *
     * @return Amalan
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Amalan $amalan) : Amalan
    {
        if (is_null($amalan->deleted_at)) {
            throw new GeneralException(__('frontend_amalans.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($amalan) {
            if ($amalan->forceDelete()) {
                return $amalan;
            }

            throw new GeneralException(__('frontend_amalans.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Amalan $amalan
     *
     * @return Amalan
     * @throws GeneralException
     */
    public function restore(Amalan $amalan) : Amalan
    {
        if (is_null($amalan->deleted_at)) {
            throw new GeneralException(__('frontend_amalans.exceptions.cant_restore'));
        }

        if ($amalan->restore()) {
            return $amalan;
        }

        throw new GeneralException(__('frontend_amalans.exceptions.restore_error'));
    }
}
