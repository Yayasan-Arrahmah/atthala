<?php

namespace App\Repositories\Backend;

use App\Models\Tahsin;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class TahsinRepository.
 */
class TahsinRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Tahsin::class;
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
     * @return Tahsin
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Tahsin
    {
        return DB::transaction(function () use ($data) {

            // Generate No. Tahsin
            $banyakid   = Tahsin::where('angkatan_peserta', $data['angkatan_peserta'])
                        ->where('no_tahsin', 'like', '%-'.$data['angkatan_peserta'].'-%')
                        ->count();
            $generateid = $banyakid + 1;
            if ($data['jenis_peserta'] == "IKHWAN") {
                $jenisid                         = "TI";
            } elseif ($data['jenis_peserta'] == "AKHWAT") {
                $jenisid                         = "TA";
            }
            $no_tahsin = $jenisid . '-'.$data['angkatan_peserta'].'-' . str_pad($generateid, 4, '0', STR_PAD_LEFT);

            $tahsin = parent::create([
                'no_tahsin'  => $no_tahsin,
                'nama_peserta'  => $data['nama_peserta'],
                'nohp_peserta'  => $data['nohp_peserta'],
                'level_peserta'  => $data['level_peserta'],
                'nama_pengajar'  => $data['nama_pengajar'],
                'jadwal_tahsin'  => $data['jadwal_tahsin'],
                'sudah_daftar_tahsin'  => $data['sudah_daftar_tahsin'],
                'belum_daftar_tahsin'  => $data['belum_daftar_tahsin'],
                'keterangan_tahsin'  => $data['keterangan_tahsin'],
                'pindahan_tahsin'  => $data['pindahan_tahsin'],
                'pindahan_tahsin_2'  => $data['pindahan_tahsin_2'],
                'jenis_peserta' => $data['jenis_peserta'],
                'angkatan_peserta' => $data['angkatan_peserta']
            ]);

            if ($tahsin) {
                return $tahsin;
            }

            throw new GeneralException(__('backend_tahsins.exceptions.create_error'));
        });
    }

    /**
     * @param Tahsin  $tahsin
     * @param array     $data
     *
     * @return Tahsin
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Tahsin $tahsin, array $data) : Tahsin
    {
        return DB::transaction(function () use ($tahsin, $data) {
            if ($tahsin->update([
                'nama_peserta'  => $data['nama_peserta'],
                'nohp_peserta'  => $data['nohp_peserta'],
                'level_peserta'  => $data['level_peserta'],
                'nama_pengajar'  => $data['nama_pengajar'],
                'jadwal_tahsin'  => $data['jadwal_tahsin'],
                'sudah_daftar_tahsin'  => $data['sudah_daftar_tahsin'],
                'belum_daftar_tahsin'  => $data['belum_daftar_tahsin'],
                'keterangan_tahsin'  => $data['keterangan_tahsin'],
                'pindahan_tahsin'  => $data['pindahan_tahsin'],
                'pindahan_tahsin_2'  => $data['pindahan_tahsin_2'],
                'jenis_peserta' => $data['jenis_peserta'],
                'angkatan_peserta' => $data['angkatan_peserta']
            ])) {

                return $tahsin;
            }

            throw new GeneralException(__('backend_tahsins.exceptions.update_error'));
        });
    }

    /**
     * @param Tahsin $tahsin
     *
     * @return Tahsin
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Tahsin $tahsin) : Tahsin
    {
        if (is_null($tahsin->deleted_at)) {
            throw new GeneralException(__('backend_tahsins.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($tahsin) {
            if ($tahsin->forceDelete()) {
                return $tahsin;
            }

            throw new GeneralException(__('backend_tahsins.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Tahsin $tahsin
     *
     * @return Tahsin
     * @throws GeneralException
     */
    public function restore(Tahsin $tahsin) : Tahsin
    {
        if (is_null($tahsin->deleted_at)) {
            throw new GeneralException(__('backend_tahsins.exceptions.cant_restore'));
        }

        if ($tahsin->restore()) {
            return $tahsin;
        }

        throw new GeneralException(__('backend_tahsins.exceptions.restore_error'));
    }
}
