@extends('frontend.user.layout')

@section('user')
@stack('before-styles')
    {{ style('//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}
@stack('after-styles')

@stack('before-scripts')
    {!! script('//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#jadwal').DataTable();
        });
    </script>
@stack('after-scripts')

<div class="row" >
    <div class="col-md-12">
        <ol class="breadcrumb" style="padding: .3rem .3rem;">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard">Jadwal</a></li>
            <li class="breadcrumb-item active">Tahsin</li>
        </ol>
    </div>
</div>
@if (auth()->user()->last_name == 'PENGAJAR')

<div class="row">
    <div class="col">
        <div class="text-center" style="font-size: 14px; font-weight: 600">
            Jadwal Tahsin
        </div>
        <div class="text-muted text-center">
            Angkatan 16
        </div>
    </div><!--col-md-6-->
</div><!--row-->
<div class="row">
    <div class="col-md-12">
        <div class="row mt-4">
            <div class="col">
                <div class="table table-responsive-sm table-hover mb-0 table-sm" style="font-size: 13px">
                    <table class="table display compact nowarp" id="jadwal" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th class="text-center">No</th> --}}
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
                            $number = 1;
                            @endphp
                            @foreach($datajadwals as $key=> $tahsin)
                            <tr>
                                {{-- <td class="text-center" >
                                    {{ $key + $datajadwals->firstItem() }}
                                </td> --}}
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
        {{-- <iframe src="https://calendar.google.com/calendar/embed?src=yar.balikpapan%40gmail.com&ctz=Asia%2FMakassar" style="border: 0" width="400" height="400" frameborder="0" scrolling="no"></iframe> --}}
    </div>
</div>
@endif

@endsection
