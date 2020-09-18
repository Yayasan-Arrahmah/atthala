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
                    {{ __('backend_amalans.labels.management') }} <small class="text-muted">{{ __('backend_amalans.labels.active') }}</small>
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
                            <th>No.</th>
                            <th>Nama Amalan</th>
                            <th>Deskripsi Amalan</th>
                            <th>Pembuat Amalan</th>
                            <th>@lang('backend_amalans.table.created')</th>
                            {{-- <th>@lang('backend_amalans.table.last_updated')</th> --}}
                            <th>@lang('backend_amalans.table.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $first  = 0;
                        $end    = 0;
                        $number = 1;
                        @endphp
                        @foreach($amalans as $key=> $amalan)
                            <tr>
                                <td class="align-middle">{{  $key+ $amalans->firstItem() }}</a></td>
                                <td class="align-middle"><a href="/admin/amalans/{{ $amalan->id }}">{{ $amalan->nama_amalan }}</a></td>
                                <td class="align-middle">{{ $amalan->deskripsi_amalan }}</td>
                                <td class="align-middle">{{ $amalan->user_create_amalan }}</td>
                                <td class="align-middle">{!! $amalan->created_at->diffForHumans() !!}</td>
                                {{-- <td class="align-middle">{{ $amalan->updated_at->diffForHumans() }}</td> --}}
                                <td class="align-middle">{!! $amalan->action_buttons !!}</td>
                            </tr>
                            @php
                            $first  = $amalans->firstItem();
                            $end    = $key + $amalans->firstItem();
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{-- {!! $amalans->count() !!} {{ trans_choice('backend_amalans.table.total', $amalans->count()) }} --}}
                    {!! $first !!} - {!! $end !!} From {!! $amalans->total() !!} Data
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $amalans->links() !!} --}}
                    {!! $amalans->appends(request()->query())->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
