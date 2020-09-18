@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_amalans.labels.management'))

@section('breadcrumb-links')
    @include('backend.amalan.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_amalans.labels.management') }} <small class="text-muted">{{ __('backend_amalans.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.amalan.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_amalans.table.title')</th>
                            <th>@lang('backend_amalans.table.created')</th>
                            <th>@lang('backend_amalans.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($amalans as $amalan)
                            <tr>
                                <td class="align-middle"><a href="/admin/amalans/{{ $amalan->id }}">{{ $amalan->title }}</a></td>
                                <td class="align-middle">{!! $amalan->created_at !!}</td>
                                <td class="align-middle">{{ $amalan->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $amalan->trashed_buttons !!}</td>
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
                    {!! $amalans->count() !!} {{ trans_choice('backend_amalans.table.total', $amalans->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $amalans->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
