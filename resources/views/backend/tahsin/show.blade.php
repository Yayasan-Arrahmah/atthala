@extends('backend.layouts.app')

@section('title', __('backend_tahsins.labels.management') . ' | ' . __('backend_tahsins.labels.view'))

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_tahsins.labels.management')
                    <small class="text-muted"> Peserta </small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> Biodata Peserta</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">

                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th width="200">No. Tahsin</th>
                                        <td>{{ $tahsin->no_tahsin }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $tahsin->nama_peserta }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Hp.</th>
                                        <td>{{ $tahsin->nohp_peserta }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis</th>
                                        <td>{{ $tahsin->jenis_peserta }}</td>
                                    </tr>
                                    <tr>
                                        <th>Level</th>
                                        <td>{{ $tahsin->level_peserta }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pengajar</th>
                                        <td>{{ $tahsin->nama_pengajar }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jadwal Tahsin</th>
                                        <td>{{ $tahsin->jadwal_tahsin }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>{{ $tahsin->keterangan_tahsin }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pindahan</th>
                                        <td>{{ $tahsin->pindahan_tahsin }}</td>
                                    </tr>
                                    <tr>
                                        <th>Angkatan</th>
                                        <td>{{ $tahsin->angkatan_peserta }}</td>
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
                    <strong>@lang('backend_tahsins.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($tahsin->created_at) }} ({{ $tahsin->created_at->diffForHumans() }}),
                    <strong>@lang('backend_tahsins.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($tahsin->updated_at) }} ({{ $tahsin->updated_at->diffForHumans() }})
                    @if($tahsin->trashed())
                        <strong>@lang('backend_tahsins.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($tahsin->deleted_at) }} ({{ $tahsin->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
