@extends('backend.layouts.app')

@section('title', app_name() . ' | Jadwal Peserta Tahsin')

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Jadwal Tahsin<small class="text-muted"> - Angkatan {{ $angkatanbaru }}</small>

                    {{-- {{ __('backend_tahsins.labels.management') }} <small class="text-muted">{{ __('backend_tahsins.labels.active') }}</small> --}}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                {{-- Total: <span id="jadwaltotal"></span> --}}
                <div class="table table-responsive-sm table-hover mb-0 table-sm">
                    <table class="table display compact nowarp" id="jadwaltahsin" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th class="text-center">No</th> --}}
                                <th class="text-center">Status Jadwal</th>
                                <th class="text-center">Jadwal</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Pengajar</th>
                                <th class="text-center">Jumlah Peserta</th>
                                <th class="text-center">Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $first  = 0;
                            $end    = 0;
                            $n      = 1;
                            $number = 1;
                            @endphp
                            @foreach($datajadwals as $key=> $tahsin)
                            @php
                            $kelas = DB::table('tahsins')
                                    ->where('nama_pengajar', $tahsin->nama_pengajar)
                                    ->where('level_peserta', $tahsin->level_peserta)
                                    ->where('jadwal_tahsin', $tahsin->jadwal_tahsin)
                                    ->where('jenis_peserta', $tahsin->jenis_peserta)
                                    ->where('angkatan_peserta', '19')
                                    ->get();
                            @endphp
                            <tr>
                                {{-- <td class="text-center" >
                                    {{ $key + $datajadwals->firstItem() }}
                                </td> --}}
                                <td class="text-center" style="font-weight: bold;">
                                    <a data-toggle="collapse" href="#detail{{ $number }}" aria-expanded="false" style="padding-left: 15px">
                                        @if ( is_null($tahsin->level_peserta) && is_null($tahsin->nama_pengajar))
                                            Belum Diperiksa
                                        @elseif ( is_null($tahsin->nama_pengajar) )
                                            Belum Pilih Jadwal
                                        @else
                                            Terverifikasi
                                        @endif
                                    </a>
                                    <div class="collapse" id="detail{{ $number }}" style="padding: 0px 0px; font-size: 10px">
                                        @foreach($kelas as $peserta)
                                        {{ $n++ }}.  {{ $peserta->nama_peserta }} - {{ $peserta->nohp_peserta }}<br>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <strong>{{ $tahsin->jadwal_tahsin }}</strong>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        if ($tahsin->level_peserta  == "ASAASI 1") {
                                            $warna = "#20a8d8";
                                        } elseif ($tahsin->level_peserta  == "ASAASI 2") {
                                            $warna = "#20c997";
                                        } elseif ($tahsin->level_peserta  == "TILAWAH ASAASI") {
                                            $warna = "#17a2b8";
                                        } elseif ($tahsin->level_peserta  == "TAMHIDI") {
                                            $warna = "#ffc107";
                                        } elseif ($tahsin->level_peserta  == "TAWASUTHI") {
                                            $warna = "#6610f2";
                                        } elseif ($tahsin->level_peserta  == "TILAWAH TAWASUTHI") {
                                            $warna = "#ffb700";
                                        } elseif ($tahsin->level_peserta  == "IDADI") {
                                            $warna = "#e83e8c";
                                        } elseif ($tahsin->level_peserta  == "TAKMILI") {
                                            $warna = "#4dbd74";
                                        } elseif ($tahsin->level_peserta  == "TAHSINI") {
                                            $warna = "#b81752";
                                        } elseif ($tahsin->level_peserta  == "ITQON") {
                                            $warna = "#1848f5";
                                        } else {
                                            $warna = "#2f353a";
                                        }
                                    @endphp

                                    @if ($tahsin->level_peserta == null)
                                    @else
                                        <button class="btn btn-sm" style="color: #fff; background-color: {{ $warna }}; border-color: {{ $warna }};">
                                            <i class="fa fa-time-circle-o"></i><strong>{{ $tahsin->level_peserta }}</strong>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-center">
                                        <div>{{ $tahsin->nama_pengajar }}</div>
                                    </div>
                                </td>
                                <td class="text-center" style="font-weight: bold;">
                                        {{ $tahsin->jumlah }}
                                </td>
                                <td>
                                    @if ($tahsin->jenis_peserta == 'IKHWAN')
                                        <div class="text-center">
                                            <strong  style="color: #20a8d8!important">{{ $tahsin->jenis_peserta }}</strong>
                                        </div>
                                    @elseif ($tahsin->jenis_peserta == 'AKHWAT')
                                        <div class="text-center">
                                            <strong  style="color: #e83e8c!important">{{ $tahsin->jenis_peserta }}</strong>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            -
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @php
                            $number++;
                            $n = 1;
                            $first  = $datajadwals->firstItem();
                            $end    = $key + $datajadwals->firstItem();
                            @endphp
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" style="text-align:right">Total:</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{-- {!! $first !!} - {!! $end !!} Dari {!! $datajadwals->total() !!} Data --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $datajadwals->appends(request()->query())->links() !!} --}}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
