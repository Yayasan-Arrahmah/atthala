@extends('backend.layouts.app')

@section('title', __('backend_pengajars.labels.management') . ' | ' . __('backend_pengajars.labels.view'))

@section('breadcrumb-links')
    @include('backend.pengajar.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_pengajars.labels.management')
                    <small class="text-muted">@lang('backend_pengajars.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('backend_pengajars.tabs.title')</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">

                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th>@lang('backend_pengajars.tabs.content.overview.nama_pengajar')</th>
                                        <td>{{ $pengajar->nama_pengajar }}</td>
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
                    <strong>@lang('backend_pengajars.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($pengajar->created_at) }} ({{ $pengajar->created_at->diffForHumans() }}),
                    <strong>@lang('backend_pengajars.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($pengajar->updated_at) }} ({{ $pengajar->updated_at->diffForHumans() }})
                    @if($pengajar->trashed())
                        <strong>@lang('backend_pengajars.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($pengajar->deleted_at) }} ({{ $pengajar->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
