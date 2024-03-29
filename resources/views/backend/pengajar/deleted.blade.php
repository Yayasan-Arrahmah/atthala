@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_pengajars.labels.management'))

@section('breadcrumb-links')
    @include('backend.pengajar.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_pengajars.labels.management') }} <small class="text-muted">{{ __('backend_pengajars.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.pengajar.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_pengajars.table.nama_pengajar')</th>
                            <th>@lang('backend_pengajars.table.created')</th>
                            <th>@lang('backend_pengajars.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pengajars as $pengajar)
                            <tr>
                                <td class="align-middle"><a href="/admin/pengajars/{{ $pengajar->id }}">{{ $pengajar->nama_pengajar }}</a></td>
                                <td class="align-middle">{!! $pengajar->created_at !!}</td>
                                <td class="align-middle">{{ $pengajar->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $pengajar->trashed_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $pengajars->count() !!} {{ trans_choice('backend_pengajars.table.total', $pengajars->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $pengajars->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
