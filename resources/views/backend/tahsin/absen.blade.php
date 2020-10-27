@extends('backend.layouts.app')

@section('title', app_name() . ' - Pengajar Tahsin Angkatan'.session('angkatan_tahsin'))

@section('breadcrumb-links')
@include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')

{{-- @stack('before-styles')
    <style>
        .tab-content {
            border: 0px;
        }
        .nav-tabs .nav-link {
            border: 1px solid;
            font-weight: 700;
            color: #858b91;
        }
    </style>
@stack('after-styles') --}}

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-0">
            Absen Tahsin<small class="text-muted"> - Angkatan {{ session('angkatan_tahsin') }}</small>
        </h4>
    </div>
</div><!--card-->

<div class="card" style="background: #e4e5e6;">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active show" data-toggle="tab" href="#pengajar" role="tab" aria-controls="pengajar" aria-selected="true">Pengajar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kelas" role="tab" aria-controls="kelas" aria-selected="false">Kelas</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active show" id="pengajar" role="tabpanel">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Absensi Pengajar
                        <small class="text-muted">Akumulasi Perbulan</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    <div class="table table-responsive-sm table-hover mb-0 table-sm">
                        <table class="table display compact nowarp" id="jadwaltahsinabsenpengajar" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="150">Pengajar</th>
                                    <th class="text-center">Juni - Juli</th>
                                    <th class="text-center">Juli - Agust</th>
                                    <th class="text-center">Agust - Sept</th>
                                    <th class="text-center">Sept - Nov</th>
                                    <th class="text-center">Total Pertemuan</th>
                                    <th class="text-center">Jumlah Kelas</th>
                                    <th class="text-center">Jenis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $first  = 0;
                                $end    = 0;
                                $number = 1;
                                $n = 1;
                                @endphp
                                @foreach($datapengajars as $key=> $tahsin)

                                @php
                                // ngambil data per-kelas per-pengajar
                                $kelas = DB::table('tahsins')
                                        ->where('nama_pengajar', $tahsin->nama_pengajar)
                                        ->select('jadwal_tahsin', 'level_peserta', (DB::raw('COUNT(*) as jumlahkelas ')))
                                        ->groupBy('jadwal_tahsin', 'level_peserta')
                                        ->havingRaw(DB::raw('COUNT(*) > 0'))
                                        ->get();

                                // deklarasi var hasil penjumlahan angkatan 16
                                $numjunjul_ = 0;
                                $numjulgus_ = 0;
                                $numgussep_ = 0;
                                $numsepokt_ = 0;
                                @endphp

                                <tr>
                                    <td>
                                        {{ $tahsin->nama_pengajar }}
                                    </td>
                                    <td class="text-center">
                                        {{-- Subtitusi jadwal untuk akumulasi pertemuan --}}
                                        @foreach($kelas as $jadwal)

                                            {{-- Mengambil data per-pertemuan absen --}}
                                            @php
                                                $junjul = DB::table('absens')
                                                        ->where('deleted_at', null)
                                                        ->where('jenis_absen', 'TAHSIN')
                                                        ->where('angkatan_absen', session('angkatan_tahsin'))
                                                        ->where('level_kelas_absen', $jadwal->level_peserta)
                                                        ->where('waktu_kelas_absen', $jadwal->jadwal_tahsin)
                                                        ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                                        ->whereBetween('created_at', ['2020-06-15','2020-07-14']) // perhitungan waktu yg diambil
                                                        ->select('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen', (DB::raw('COUNT(*) as jumlahhadir ')))
                                                        ->groupBy('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen')
                                                        ->havingRaw(DB::raw('COUNT(*) > 0'))
                                                        ->get();
                                                $numjunjul = 0;
                                            @endphp

                                            {{-- subtitusi data per-pertemuan --}}
                                            @foreach($junjul as $tes)
                                                @php
                                                // perhitungan pertemuan
                                                    $numjunjul++;
                                                @endphp
                                            @endforeach

                                            {{-- <div style="font-size: 10px">
                                                ( {{ $jadwal->jadwal_tahsin }} - {{ $jadwal->level_peserta }} = {{ $jadwal->jumlahkelas }} Peserta, {{ $numjunjul }} Pertemuan )
                                            </div> --}}

                                            @php
                                            // penjumlahan data pertemuan sesuai pengambilan waktu hitungan bulan
                                            $numjunjul_ = $numjunjul + $numjunjul_;
                                            @endphp

                                        @endforeach
                                        {{ $numjunjul_ }}
                                    </td>
                                    <td class="text-center">
                                        {{-- Subtitusi jadwal untuk akumulasi pertemuan --}}
                                        @foreach($kelas as $jadwal)

                                            {{-- Mengambil data per-pertemuan absen --}}
                                            @php
                                                $julgus = DB::table('absens')
                                                        ->where('deleted_at', null)
                                                        ->where('jenis_absen', 'TAHSIN')
                                                        ->where('angkatan_absen', session('angkatan_tahsin'))
                                                        ->where('level_kelas_absen', $jadwal->level_peserta)
                                                        ->where('waktu_kelas_absen', $jadwal->jadwal_tahsin)
                                                        ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                                        ->whereBetween('created_at', ['2020-07-15','2020-08-14']) // perhitungan waktu yg diambil
                                                        ->select('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen', (DB::raw('COUNT(*) as jumlahhadir ')))
                                                        ->groupBy('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen')
                                                        ->havingRaw(DB::raw('COUNT(*) > 0'))
                                                        ->get();
                                                $numjulgus = 0;
                                            @endphp

                                            {{-- subtitusi data per-pertemuan --}}
                                            @foreach($julgus as $tes)
                                                @php
                                                // perhitungan pertemuan
                                                    $numjulgus++;
                                                @endphp
                                            @endforeach

                                            {{-- <div style="font-size: 10px">
                                                ( {{ $jadwal->jadwal_tahsin }} - {{ $jadwal->level_peserta }} = {{ $jadwal->jumlahkelas }} Peserta, {{ $numjulgus }} Pertemuan )
                                            </div> --}}

                                            @php
                                            // penjumlahan data pertemuan sesuai pengambilan waktu hitungan bulan
                                            $numjulgus_ = $numjulgus + $numjulgus_;
                                            @endphp

                                        @endforeach
                                        {{ $numjulgus_ }}
                                    </td>
                                    <td class="text-center">
                                        {{-- Subtitusi jadwal untuk akumulasi pertemuan --}}
                                        @foreach($kelas as $jadwal)

                                            {{-- Mengambil data per-pertemuan absen --}}
                                            @php
                                                $gussep = DB::table('absens')
                                                        ->where('deleted_at', null)
                                                        ->where('jenis_absen', 'TAHSIN')
                                                        ->where('angkatan_absen', session('angkatan_tahsin'))
                                                        ->where('level_kelas_absen', $jadwal->level_peserta)
                                                        ->where('waktu_kelas_absen', $jadwal->jadwal_tahsin)
                                                        ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                                        ->whereBetween('created_at', ['2020-08-15','2020-09-14']) // perhitungan waktu yg diambil
                                                        ->select('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen', (DB::raw('COUNT(*) as jumlahhadir ')))
                                                        ->groupBy('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen')
                                                        ->havingRaw(DB::raw('COUNT(*) > 0'))
                                                        ->get();
                                                $numgussep = 0;
                                            @endphp

                                            {{-- subtitusi data per-pertemuan --}}
                                            @foreach($gussep as $tes)
                                                @php
                                                // perhitungan pertemuan
                                                    $numgussep++;
                                                @endphp
                                            @endforeach

                                            {{-- <div style="font-size: 10px">
                                                ( {{ $jadwal->jadwal_tahsin }} - {{ $jadwal->level_peserta }} = {{ $jadwal->jumlahkelas }} Peserta, {{ $numgussep }} Pertemuan )
                                            </div> --}}

                                            @php
                                            // penjumlahan data pertemuan sesuai pengambilan waktu hitungan bulan
                                            $numgussep_ = $numgussep + $numgussep_;
                                            @endphp

                                        @endforeach
                                        {{ $numgussep_ }}
                                    </td>
                                    <td class="text-center">
                                        {{-- Subtitusi jadwal untuk akumulasi pertemuan --}}
                                        @foreach($kelas as $jadwal)

                                            {{-- Mengambil data per-pertemuan absen --}}
                                            @php
                                                $sepokt = DB::table('absens')
                                                        ->where('deleted_at', null)
                                                        ->where('jenis_absen', 'TAHSIN')
                                                        ->where('angkatan_absen', session('angkatan_tahsin'))
                                                        ->where('level_kelas_absen', $jadwal->level_peserta)
                                                        ->where('waktu_kelas_absen', $jadwal->jadwal_tahsin)
                                                        ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                                        ->whereBetween('created_at', ['2020-09-15','2020-10-14']) // perhitungan waktu yg diambil
                                                        ->select('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen', (DB::raw('COUNT(*) as jumlahhadir ')))
                                                        ->groupBy('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen')
                                                        ->havingRaw(DB::raw('COUNT(*) > 0'))
                                                        ->get();
                                                $numsepokt = 0;
                                            @endphp

                                            {{-- subtitusi data per-pertemuan --}}
                                            @foreach($sepokt as $tes)
                                                @php
                                                // perhitungan pertemuan
                                                    $numsepokt++;
                                                @endphp
                                            @endforeach

                                            {{-- <div style="font-size: 10px">
                                                ( {{ $jadwal->jadwal_tahsin }} - {{ $jadwal->level_peserta }} = {{ $jadwal->jumlahkelas }} Peserta, {{ $numsepokt }} Pertemuan )
                                            </div> --}}

                                            @php
                                            // penjumlahan data pertemuan sesuai pengambilan waktu hitungan bulan
                                            $numsepokt_ = $numsepokt + $numsepokt_;
                                            @endphp

                                        @endforeach
                                        {{ $numsepokt_ }}
                                    </td>
                                    <td class="text-center" style="font-weight: bold;">
                                        {{-- {{ $tahsin->jumlah }} --}}
                                        @php
                                            $totalp = $numjunjul_ + $numjulgus_ + $numgussep_ + $numsepokt_;
                                        @endphp
                                        {{ $totalp }}
                                    </td>
                                    <td class="text-center" style="font-weight: bold;">
                                        {{ count($kelas) }}
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
                                $first  = $datapengajars->firstItem();
                                $end    = $key + $datapengajars->firstItem();
                                @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th class="text-center"></th>
                                    <th class="text-center"></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
        <div class="tab-pane" id="kelas" role="tabpanel">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Jadwal Absensi
                        <small class="text-muted">Waktu Per-pertemuan</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    <div class="table table-responsive-sm table-hover mb-0 table-sm">
                        <table class="table display compact nowarp" id="jadwaltahsinabsen" style="width:100%">
                            <thead>
                                <tr>
                                    {{-- <th class="text-center">No</th> --}}
                                    <th class="text-center">Jadwal Tahsin</th>
                                    @for ($a = 1; $a <= 15; $a++)
                                    <th class="text-center">
                                        {{ $a }}
                                    </th>
                                    @endfor
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
                                        <a href="{{ route('admin.tahsins.absenkelas') }}?pengajar={{ $tahsin->nama_pengajar }}&level={{ $tahsin->level_peserta }}&waktu={{ $tahsin->jadwal_tahsin }}&jenis={{ $tahsin->jenis_peserta }}">
                                            <strong>{{ $tahsin->nama_pengajar }}</strong> - {{ $tahsin->level_peserta }}, {{ $tahsin->jadwal_tahsin }}
                                        </a>
                                    </td>
                                    {{-- @php
                                    $cekuser = DB::table('users')->where('user_pengajar', $tahsin->nama_pengajar )->first();
                                    @endphp --}}
                                    @for ($b = 1; $b <= 15; $b++)
                                    @php
                                    $cek = DB::table('absens')
                                            // ->where('user_create_absen', $cekuser->id ?? 0 )
                                            ->where('pertemuan_ke_absen', $b)
                                            ->where('angkatan_absen', session('angkatan_tahsin'))
                                            ->where('level_kelas_absen', $tahsin->level_peserta)
                                            ->where('waktu_kelas_absen', $tahsin->jadwal_tahsin)
                                            ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                            ->where('jenis_absen', 'TAHSIN')
                                            ->first();
                                    @endphp
                                    <td class="text-center" style="font-size: 11px">
                                        @if (isset($cek))
                                        {{ $cek->created_at }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    @endfor

                                </tr>
                                @php
                                $first  = $datajadwals->firstItem();
                                $end    = $key + $datajadwals->firstItem();
                                @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
</div>
@endsection
