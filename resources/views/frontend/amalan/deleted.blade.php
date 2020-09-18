@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('frontend_amalans.labels.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('frontend_amalans.labels.management') }} <small class="text-muted">{{ __('frontend_amalans.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('frontend.amalan.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('frontend_amalans.table.title')</th>
                            <th>@lang('frontend_amalans.table.created')</th>
                            <th>@lang('frontend_amalans.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($amalans as $amalan)
                            <tr>
                                <td class="align-middle"><a href="/frontend/amalans/{{ $amalan->id }}">{{ $amalan->title }}</a></td>
                                <td class="align-middle">{!! $amalan->created_at !!}</td>
                                <td class="align-middle">{{ $amalan->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $amalan->frontend_trashed_buttons !!}</td>
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
                    {!! $amalans->count() !!} {{ trans_choice('frontend_amalans.table.total', $amalans->count()) }}
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
