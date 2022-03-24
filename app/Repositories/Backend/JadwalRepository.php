<?php

namespace App\Repositories\Backend;

use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
/**
 * Class JadwalRepository.
 */
class JadwalRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Jadwal::class;
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
            ->when(request()->nama, function ($query) {
                return $query->where('pengajar_jadwal', 'like', '%'.request()->nama.'%');
            })
            ->when(request()->level, function ($query) {
                if( request()->level != 'SEMUA') {
                    return $query->where('level_jadwal', '=', request()->level);
                }
            })
            ->when(request()->jenis, function ($query) {
                if( request()->jenis != 'SEMUA') {
                    return $query->where('jenis_jadwal', '=', request()->jenis);
                }
            })
            ->where('angkatan_jadwal', '=', request()->angkatan ?? session('angkatan_tahsin'))
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
     * @return Jadwal
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Jadwal
    {
        return DB::transaction(function () use ($data) {
            $jadwal = parent::create([
                'uuid_jadwal'     => Str::uuid(),
                'pengajar_jadwal' => $data['pengajar_jadwal'],
                'level_jadwal'    => $data['level_jadwal'],
                'hari_jadwal'     => $data['hari_jadwal'],
                'waktu_jadwal'    => $data['waktu_jadwal'],
                'jumlah_peserta'  => $data['jumlah_peserta'],
                'jenis_jadwal'    => $data['jenis_jadwal'],
                'angkatan_jadwal' => $data['angkatan_jadwal'],
            ]);

            if ($jadwal) {
                return $jadwal;
            }

            throw new GeneralException(__('backend_jadwals.exceptions.create_error'));
        });
    }

    /**
     * @param Jadwal  $jadwal
     * @param array     $data
     *
     * @return Jadwal
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Jadwal $jadwal, array $data) : Jadwal
    {
        return DB::transaction(function () use ($jadwal, $data) {
            if ($jadwal->update([
                'pengajar_jadwal' => $data['pengajar_jadwal'],
                'level_jadwal'    => $data['level_jadwal'],
                'hari_jadwal'     => $data['hari_jadwal'],
                'waktu_jadwal'    => $data['waktu_jadwal'],
                'jumlah_peserta'  => $data['jumlah_peserta'],
                'jenis_jadwal'    => $data['jenis_jadwal'],
                'angkatan_jadwal' => $data['angkatan_jadwal'],
                'jumlah_peserta'  => $data['jumlah_peserta'],
            ])) {

                return $jadwal;
            }

            throw new GeneralException(__('backend_jadwals.exceptions.update_error'));
        });
    }

    /**
     * @param Jadwal $jadwal
     *
     * @return Jadwal
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Jadwal $jadwal) : Jadwal
    {
        // if (is_null($jadwal->deleted_at)) {
        //     throw new GeneralException(__('backend_jadwals.exceptions.delete_first'));
        // }

        return DB::transaction(function () use ($jadwal) {
            if ($jadwal->forceDelete()) {
                return $jadwal;
            }

            // throw new GeneralException(__('backend_jadwals.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Jadwal $jadwal
     *
     * @return Jadwal
     * @throws GeneralException
     */
    public function restore(Jadwal $jadwal) : Jadwal
    {
        if (is_null($jadwal->deleted_at)) {
            throw new GeneralException(__('backend_jadwals.exceptions.cant_restore'));
        }

        if ($jadwal->restore()) {
            return $jadwal;
        }

        throw new GeneralException(__('backend_jadwals.exceptions.restore_error'));
    }
}
