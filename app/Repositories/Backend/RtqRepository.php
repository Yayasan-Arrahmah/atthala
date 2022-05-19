<?php

namespace App\Repositories\Backend;

use App\Models\Rtq;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Request;
use App\Models\RtqPeriodeRapor;

/**
 * Class RtqRepository.
 */
class RtqRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Rtq::class;
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
        $cek = 'CEK ADMIN';
        $perioderapor = RtqPeriodeRapor::latest('created_at')->first();
        return $this->model
            ->when($cek, function ($query) {
                if( auth()->user()->last_name != 'Admin') {
                    return $query->where('jenis_santri', '=', auth()->user()->jenis);
                }
            })
            ->when(request()->nama, function ($query) {
                return $query->where('nama_santri', 'LIKE', '%'.request()->nama.'%');
            })
            ->when(request()->status, function ($query) {
                if( request()->status != 'SEMUA') {
                    return $query->where('status_santri', '=', request()->status);
                }
            })
            ->when(request()->halaqoh, function ($query) {
                if( request()->halaqoh != 'SEMUA') {
                    return $query->where('pengajar_santri', '=', request()->halaqoh);
                }
            })
            ->when(request()->angkatan, function ($query) {
                if( request()->angkatan != 'SEMUA') {
                    return $query->where('angkatan_santri', '=', request()->angkatan);
                }

            })
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
     * @return Rtq
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Rtq
    {
        return DB::transaction(function () use ($data) {
            $rtq = parent::create([
                'nis_santri'           => $data['nis_santri'],
                'nama_santri'          => $data['nama_santri'],
                'notelp_santri'        => $data['notelp_santri'],
                'jenis_santri'         => $data['jenis_santri'],
                'status_santri'        => $data['status_santri'],
                'tempat_lahir'         => $data['tempat_lahir'],
                'tanggal_lahir'        => $data['tanggal_lahir'],
                'alamat'               => $data['alamat'],
                'nama_ayah'            => $data['nama_ayah'],
                'pekerjaan_ayah'       => $data['pekerjaan_ayah'],
                'penghasilan_ayah'     => $data['penghasilan_ayah'],
                'nama_ibu'             => $data['nama_ibu'],
                'pekerjaan_ibu'        => $data['pekerjaan_ibu'],
                'penghasilan_ibu'      => $data['penghasilan_ibu'],
                'alamat_orangtua'      => $data['alamat_orangtua'],
                'tanggal_masuk'        => $data['tanggal_masuk'],
                'jumlah_hafalan'       => $data['jumlah_hafalan'],
                'pengalaman_pesantren' => $data['pengalaman_pesantren'],
                'riwayat_pendidikan'   => $data['riwayat_pendidikan'],
                'spp_disanggupi'       => $data['spp_disanggupi'],
                'angkatan_santri'      => $data['angkatan_santri'],
                'pengajar_santri'      => $data['pengajar_santri'],
                'domisili'             => $data['domisili'],
                'kriteria'             => $data['kriteria'],
                'keterangan'           => $data['keterangan'],
            ]);

            if ($rtq) {
                return $rtq;
            }

            throw new GeneralException(__('backend_rtqs.exceptions.create_error'));
        });
    }

    /**
     * @param Rtq  $rtq
     * @param array     $data
     *
     * @return Rtq
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Rtq $rtq, array $data) : Rtq
    {
        return DB::transaction(function () use ($rtq, $data) {
            if ($rtq->update([
                'nis_santri'           => $data['nis_santri'],
                'nama_santri'          => $data['nama_santri'],
                'notelp_santri'        => $data['notelp_santri'],
                'jenis_santri'         => $data['jenis_santri'],
                'status_santri'        => $data['status_santri'],
                'tempat_lahir'         => $data['tempat_lahir'],
                'tanggal_lahir'        => $data['tanggal_lahir'],
                'alamat'               => $data['alamat'],
                'nama_ayah'            => $data['nama_ayah'],
                'pekerjaan_ayah'       => $data['pekerjaan_ayah'],
                'penghasilan_ayah'     => $data['penghasilan_ayah'],
                'nama_ibu'             => $data['nama_ibu'],
                'pekerjaan_ibu'        => $data['pekerjaan_ibu'],
                'penghasilan_ibu'      => $data['penghasilan_ibu'],
                'alamat_orangtua'      => $data['alamat_orangtua'],
                'tanggal_masuk'        => $data['tanggal_masuk'],
                'jumlah_hafalan'       => $data['jumlah_hafalan'],
                'pengalaman_pesantren' => $data['pengalaman_pesantren'],
                'riwayat_pendidikan'   => $data['riwayat_pendidikan'],
                'spp_disanggupi'       => $data['spp_disanggupi'],
                'angkatan_santri'      => $data['angkatan_santri'],
                'pengajar_santri'      => $data['pengajar_santri'],
                'domisili'             => $data['domisili'],
                'kriteria'             => $data['kriteria'],
                'keterangan'           => $data['keterangan'],
            ])) {

                return $rtq;
            }

            throw new GeneralException(__('backend_rtqs.exceptions.update_error'));
        });
    }

    /**
     * @param Rtq $rtq
     *
     * @return Rtq
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Rtq $rtq) : Rtq
    {
        if (is_null($rtq->deleted_at)) {
            throw new GeneralException(__('backend_rtqs.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($rtq) {
            if ($rtq->forceDelete()) {
                return $rtq;
            }

            throw new GeneralException(__('backend_rtqs.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Rtq $rtq
     *
     * @return Rtq
     * @throws GeneralException
     */
    public function restore(Rtq $rtq) : Rtq
    {
        if (is_null($rtq->deleted_at)) {
            throw new GeneralException(__('backend_rtqs.exceptions.cant_restore'));
        }

        if ($rtq->restore()) {
            return $rtq;
        }

        throw new GeneralException(__('backend_rtqs.exceptions.restore_error'));
    }
}
