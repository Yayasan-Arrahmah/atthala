@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_absens.labels.management'))

@section('breadcrumb-links')
    @include('backend.absen.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_absens.labels.management') }} <small class="text-muted">{{ __('backend_absens.labels.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.absen.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_absens.table.id_peserta')</th>
                            <th>@lang('backend_absens.table.created')</th>
                            <th>@lang('backend_absens.table.last_updated')</th>
                            <th>@lang('backend_absens.table.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($absens as $absen)
                            <tr>
                                <td class="align-middle"><a href="/admin/absens/{{ $absen->id }}">{{ $absen->id_peserta }}</a></td>
                                <td class="align-middle">{!! $absen->created_at !!}</td>
                                <td class="align-middle">{{ $absen->updated_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $absen->action_buttons !!}</td>
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
                    {!! $absens->count() !!} {{ trans_choice('backend_absens.table.total', $absens->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $absens->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
