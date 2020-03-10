@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_jadwals.labels.management'))

@section('breadcrumb-links')
@include('backend.jadwal.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
        @include('backend.jadwal.includes.cari')
</div>

<div class="card">
    {{-- <div class="card-header">
        Tahsin Angkatan 15 Tahun 2020
    </div> --}}
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Jadwal Peserta <small class="text-muted">Tahsin Angkatan 15</small>
                    {{-- {{ __('backend_jadwals.labels.management') }} <small class="text-muted">{{ __('backend_jadwals.labels.active') }}</small> --}}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">

                @include('backend.jadwal.includes.header-buttons')
                <a href=" {{ url()->current() }}/upload" >
                    <button class="float-right btn btn-info">
                        <i class="fa fa-upload"></i> Upload Excel
                    </button>
                </a>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table table-responsive-sm table-hover mb-0 table-sm">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Jadwal</th>
                                <th class="text-center">Pengajar</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Daftar Ulang</th>
                                <th class="text-center">Angkatan</th>
                                <th width="100" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                $first  = 0;
                                $end    = 0;
                                $number = 1;
                                @endphp
                                @foreach($jadwals as $key=> $jadwal)
                                <tr>
                                    <td class="text-center" >
                                        {{ $key + $jadwals->firstItem() }}
                                    </td>
                                    <td>
                                        <a href="/admin/jadwals/{{ $jadwal->id }}/edit" style="color: rgb(56, 56, 56);">
                                            <div style="text-transform: uppercase;">{{ $jadwal->nama_peserta }}</div>
                                            <div class="small text-muted">
                                                {{ $jadwal->nohp_peserta }}
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            if ($jadwal->level_peserta  == "ASAASI 1") {
                                                $warna = "#20a8d8";
                                            } elseif ($jadwal->level_peserta  == "ASAASI 2") {
                                                $warna = "#20c997";
                                            } elseif ($jadwal->level_peserta  == "TILAWAH ASAASI") {
                                                $warna = "#17a2b8";
                                            } elseif ($jadwal->level_peserta  == "TAMHIDI") {
                                                $warna = "#f86c6b";
                                            } elseif ($jadwal->level_peserta  == "TAWATSUTHI") {
                                                $warna = "#6610f2";
                                            } elseif ($jadwal->level_peserta  == "TILAWAH TAWATSUTHI") {
                                                $warna = "#ffc107";
                                            } elseif ($jadwal->level_peserta  == "I'DADI") {
                                                $warna = "#e83e8c";
                                            } elseif ($jadwal->level_peserta  == "TAKMILI") {
                                                $warna = "#4dbd74";
                                            } elseif ($jadwal->level_peserta  == "TAHSINI") {
                                                $warna = "#b81752";
                                            } elseif ($jadwal->level_peserta  == "ITQON") {
                                                $warna = "#1848f5";
                                            } else {
                                                $warna = "#2f353a";
                                            }
                                        @endphp

                                        @if ($jadwal->level_peserta == null)
                                        @else
                                            <button class="btn btn-sm" style="color: #fff; background-color: {{ $warna }}; border-color: {{ $warna }};">
                                                <i class="fa fa-time-circle-o"></i><strong>{{ $jadwal->level_peserta }}</strong>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <div>SABTU 07.00</div> --}}
                                        <div class="text-center">
                                            <strong>{{ $jadwal->jadwal_tahsin }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div>{{ $jadwal->nama_pengajar }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($jadwal->jenis_peserta == 'IKHWAN')
                                            <div class="text-center">
                                                <strong  style="color: #20a8d8!important">{{ $jadwal->jenis_peserta }}</strong>
                                            </div>
                                        @elseif ($jadwal->jenis_peserta == 'AKHWAT')
                                            <div class="text-center">
                                                <strong  style="color: #e83e8c!important">{{ $jadwal->jenis_peserta }}</strong>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                -
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div lass="text-center" style="color: #73818f!important;">
                                            {{ $jadwal->keterangan_jadwal }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{ $jadwal->sudah_daftar_jadwal }}
                                            {{ $jadwal->belum_daftar_jadwal }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{ $jadwal->angkatan_peserta }}
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <button class="btn btn-danger  btn-sm"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-success  btn-sm"><i class="fa fa-pen"></i></button> --}}
                                        <div class="text-center">
                                            {!! $jadwal->action_buttons !!}
                                        </div>
                                    </td>
                                </tr>
                                @php
                                $first  = $jadwals->firstItem();
                                $end    = $key + $jadwals->firstItem();
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
                        {{-- {!! $jadwals->count() !!} {{ trans_choice('backend_jadwals.table.total', $jadwals->count()) }} --}}

                        {!! $first !!} - {!! $end !!} Dari {!! $jadwals->total() !!} Data
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {{-- {!! $jadwals->links() !!} --}}
                        {!! $jadwals->appends(request()->query())->links() !!}

                        {{-- {!! $jadwals->links() !!} --}}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
    @endsection
