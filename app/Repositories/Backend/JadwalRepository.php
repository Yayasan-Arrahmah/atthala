<?php

namespace App\Repositories\Backend;

use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

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
                'no_jadwal'  => $data['no_jadwal'],
                'nama_peserta'  => $data['nama_peserta'],
                'nohp_peserta'  => $data['nohp_peserta'],
                'level_peserta'  => $data['level_peserta'],
                'nama_pengajar'  => $data['nama_pengajar'],
                'jadwal_tahsin'  => $data['jadwal_tahsin'],
                'sudah_daftar_jadwal'  => $data['sudah_daftar_jadwal'],
                'belum_daftar_jadwal'  => $data['belum_daftar_jadwal'],
                'keterangan_jadwal'  => $data['keterangan_jadwal'],
                'pindahan_jadwal'  => $data['pindahan_jadwal'],
                'pindahan_jadwal_2'  => $data['pindahan_jadwal_2'],
                'jenis_peserta' => $data['jenis_peserta'],
                'angkatan_peserta' => $data['angkatan_peserta']
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
                'nama_peserta'  => $data['nama_peserta'],
                'nohp_peserta'  => $data['nohp_peserta'],
                'level_peserta'  => $data['level_peserta'],
                'nama_pengajar'  => $data['nama_pengajar'],
                'jadwal_tahsin'  => $data['jadwal_tahsin'],
                'sudah_daftar_jadwal'  => $data['sudah_daftar_jadwal'],
                'belum_daftar_jadwal'  => $data['belum_daftar_jadwal'],
                'keterangan_jadwal'  => $data['keterangan_jadwal'],
                'pindahan_jadwal'  => $data['pindahan_jadwal'],
                'pindahan_jadwal_2'  => $data['pindahan_jadwal_2'],
                'jenis_peserta' => $data['jenis_peserta'],
                'angkatan_peserta' => $data['angkatan_peserta']
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
        if (is_null($jadwal->deleted_at)) {
            throw new GeneralException(__('backend_jadwals.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($jadwal) {
            if ($jadwal->forceDelete()) {
                return $jadwal;
            }

            throw new GeneralException(__('backend_jadwals.exceptions.delete_error'));
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
