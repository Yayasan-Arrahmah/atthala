@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_pembayarans.labels.management'))

@section('breadcrumb-links')
    @include('backend.pembayaran.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_pembayarans.labels.management') }} <small class="text-muted">{{ __('backend_pembayarans.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.pembayaran.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_pembayarans.table.uuid_pembayaran')</th>
                            <th>@lang('backend_pembayarans.table.created')</th>
                            <th>@lang('backend_pembayarans.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pembayarans as $pembayaran)
                            <tr>
                                <td class="align-middle"><a href="/admin/pembayarans/{{ $pembayaran->id }}">{{ $pembayaran->uuid_pembayaran }}</a></td>
                                <td class="align-middle">{!! $pembayaran->created_at !!}</td>
                                <td class="align-middle">{{ $pembayaran->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $pembayaran->trashed_buttons !!}</td>
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
                    {!! $pembayarans->count() !!} {{ trans_choice('backend_pembayarans.table.total', $pembayarans->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $pembayarans->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
