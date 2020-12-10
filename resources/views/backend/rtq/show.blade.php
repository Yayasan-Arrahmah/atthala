@extends('backend.layouts.app')

@section('title', __('backend_rtqs.labels.management') . ' | ' . __('backend_rtqs.labels.view'))

@section('breadcrumb-links')
    @include('backend.rtq.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Santri RTQ
                    <small class="text-muted">Lihat Data</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('backend_rtqs.tabs.title')</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">

                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th>NIS Santri</th>
                                        <td>{{ $rtq->nis_santri }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Santri</th>
                                        <td>{{ $rtq->nama_santri }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon Santri</th>
                                        <td>{{ $rtq->notelp_santri }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Santri</th>
                                        <td>{{ $rtq->jenis_santri }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Santri</th>
                                        <td>{{ $rtq->status_santri }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td>{{ $rtq->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>{{ $rtq->tanggal_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Santri</th>
                                        <td>{{ $rtq->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ayah</th>
                                        <td>{{ $rtq->nama_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan Ayah</th>
                                        <td>{{ $rtq->pekerjaan_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penghasilan Ayah Perbulan</th>
                                        <td>{{ $rtq->penghasilan_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ibu</th>
                                        <td>{{ $rtq->nama_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan Ibu</th>
                                        <td>{{ $rtq->pekerjaan_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penghasilan Ibu Perbulan</th>
                                        <td>{{ $rtq->penghasilan_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alaman Orang Tua</th>
                                        <td>{{ $rtq->alamat_orangtua }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Masuk</th>
                                        <td>{{ $rtq->tanggal_masuk }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Hafalan Ketika Masuk</th>
                                        <td>{{ $rtq->jumlah_hafalan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pengalaman Pesantren</th>
                                        <td>{{ $rtq->pengalaman_pesantren }}</td>
                                    </tr>
                                    <tr>
                                        <th>Riwayat Pendidikan</th>
                                        <td>{{ $rtq->riwayat_pendidikan }}</td>
                                    </tr>
                                    <tr>
                                        <th>SPP Yang Disanggupi Perbulan</th>
                                        <td>{{ $rtq->spp_disanggupi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kota Domisili</th>
                                        <td>{{ $rtq->domisili }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kriteria</th>
                                        <td>{{ $rtq->kriteria }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan Informasi Tambahan</th>
                                        <td>{{ $rtq->keterangan }}</td>
                                    </tr>

                                </table>
                            </div><!--table-responsive-->
                        </div><!--col-->

                    </div><!--tab-->
                </div><!--tab-content-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_rtqs.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($rtq->created_at) }} ({{ $rtq->created_at->diffForHumans() }}),
                    <strong>@lang('backend_rtqs.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($rtq->updated_at) }} ({{ $rtq->updated_at->diffForHumans() }})
                    @if($rtq->trashed())
                        <strong>@lang('backend_rtqs.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($rtq->deleted_at) }} ({{ $rtq->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
