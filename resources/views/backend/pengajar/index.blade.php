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
                    {{ __('backend_pengajars.labels.management') }} <small class="text-muted">Tahsin</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.pengajar.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table table-responsive-sm table-hover mb-0 table-sm">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID Pengajar</th>
                            <th>Nama</th>
                            <th>No. HP</th>
                            <th>Jenis</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $first  = 0;
                        $end    = 0;
                        $number = 1;
                        @endphp
                        @foreach($pengajars as $pengajar)
                            <tr>
                                <td class="text-center" >
                                    {{ $key + $pengajar->firstItem() }}
                                </td>
                                <td class="align-middle">{!! $pengajar->id_pengajar   !!}</td>
                                <td class="align-middle"><a href="/admin/pengajar/{{ $pengajar->id }}">{{ $pengajar->nama_pengajar }}</a></td>
                                <td class="align-middle">{{ $pengajar->nohp_pengajar }}</td>
                                <td class="align-middle">{{ $pengajar->jenis_pengajar }}</td>
                                <td class="align-middle text-muted">
                                    {!! $pengajar->action_buttons !!}
                                    {{ $pengajar->updated_at->diffForHumans() }}
                                </td>
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
                    {{-- {!! $pengajars->count() !!} {{ trans_choice('backend_pengajars.table.total', $pengajars->count()) }} --}}
                    {!! $first !!} - {!! $end !!} Dari {!! $pengajars->total() !!} Data
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $pengajars->appends(request()->query())->links()!!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
