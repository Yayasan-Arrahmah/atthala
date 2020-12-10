@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_rtqs.labels.management'))

@section('breadcrumb-links')
    @include('backend.rtq.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Santri RTQ <small class="text-muted">Non Aktif</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                {{-- @include('backend.rtq.includes.header-buttons') --}}
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Tanggal Non Aktif</th>
                                <th width="100" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $first  = 0;
                            $end    = 0;
                            $number = 1;
                            @endphp
                            @foreach($rtqs as $key=> $rtq)
                                <tr>
                                    <td class="text-center" >
                                        {{ $key + $rtqs->firstItem() }}
                                    </td>
                                    <td>
                                        <a href="/admin/rtq/{{ $rtq->id }}/edit" style="color: rgb(56, 56, 56);">
                                            <div style="text-transform: uppercase;">{{ $rtq->nama_santri }}</div>
                                            <div class="small text-muted">
                                                {{ $rtq->nis_santri }} | {{ $rtq->notelp_santri }}
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{ $rtq->status_santri }}
                                    </td>
                                    <td class="text-center">
                                        @if ($rtq->jenis_santri == 'IKHWAN')
                                            <div class="text-center">
                                                <strong  style="color: #20a8d8!important">{{ $rtq->jenis_santri }}</strong>
                                            </div>
                                        @elseif ($rtq->jenis_santri == 'AKHWAT')
                                            <div class="text-center">
                                                <strong  style="color: #e83e8c!important">{{ $rtq->jenis_santri }}</strong>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                -
                                            </div>
                                        @endif
                                        <div class="small text-muted">
                                           Angkatan {{ $rtq->angkatan_santri }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{ $rtq->deleted_at->diffForHumans() }}
                                        </div>
                                    </td>

                                    <td>
                                        {{-- <button class="btn btn-danger  btn-sm"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-success  btn-sm"><i class="fa fa-pen"></i></button> --}}
                                        <div class="text-center">
                                            {!! $rtq->trashed_buttons !!}
                                        </div>
                                    </td>
                                </tr>
                            @php
                            $first  = $rtqs->firstItem();
                            $end    = $key + $rtqs->firstItem();
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
                    {!! $rtqs->count() !!} {{ trans_choice('backend_rtqs.table.total', $rtqs->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $rtqs->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
