@extends('backend.layouts.app')

@section('title', app_name() . ' - Pengajar Tahsin Angkatan 16 ')

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
            Absen Tahsin<small class="text-muted"> - Angkatan 16</small>
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
            <div class="row mt-4">
                <div class="col">
                    <div class="table table-responsive-sm table-hover mb-0 table-sm">
                        <table class="table display compact nowarp" id="jadwaltahsinabsenpengajar" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="350">Pengajar</th>
                                    <th class="text-center">Juni - Juli</th>
                                    <th class="text-center">Juli - Agus</th>
                                    <th class="text-center">Agus - Sept</th>
                                    <th class="text-center">Sept - Nov</th>
                                    <th class="text-center">Jumlah Kelas</th>
                                    <th class="text-center">Jumlah Peserta</th>
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
                                $kelas = DB::table('tahsins')
                                        ->where('nama_pengajar', $tahsin->nama_pengajar)
                                        ->select('jadwal_tahsin', (DB::raw('COUNT(*) as jumlahkelas ')))
                                        ->groupBy('jadwal_tahsin')
                                        ->havingRaw(DB::raw('COUNT(*) > 0'))
                                        ->get();
                                @endphp

                                <tr>
                                    <td>
                                        <a data-toggle="collapse" href="#detail{{ $number }}" aria-expanded="false" style="padding-left: 15px">{{ $tahsin->nama_pengajar }}</a>
                                        <div class="collapse" id="detail{{ $number }}" style="padding: 5px 0 5px 15px">
                                            @foreach($kelas as $jadwal)
                                            {{ $n++ }}.  {{ $jadwal->jadwal_tahsin }} = {{ $jadwal->jumlahkelas }} Peserta<br>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        {{-- @php
                                        $kelas = DB::table('absens')
                                                ->where('nama_pengajar', $userpengajar)
                                                ->where('level_peserta', $level)
                                                ->where('jadwal_tahsin', $waktu)
                                                ->where('angkatan_peserta', $angkatan)
                                                ->where('jenis_peserta', $jenis)
                                                ->get();
                                        @endphp --}}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center" style="font-weight: bold;">
                                        {{ count($kelas) }}
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
                                    @php
                                    $cekuser = $datauser->where('user_pengajar', $tahsin->nama_pengajar )->first()
                                    @endphp
                                    @for ($b = 1; $b <= 15; $b++)
                                    @php
                                    $cek = $dataabsen->where('user_create_absen', $cekuser->id ?? 0 )
                                    ->where('pertemuan_ke_absen', $b)
                                    ->where('angkatan_absen', $angkatan)
                                    ->where('level_kelas_absen', $tahsin->level_peserta)
                                    ->where('waktu_kelas_absen', $tahsin->jadwal_tahsin)
                                    ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                    ->where('jenis_absen', 'TAHSIN')
                                    ->first()
                                    @endphp
                                    <td class="text-center text-muted">
                                        @if (isset($cek))
                                        {{ $cek->created_at->format("H:i") }} WITA, {{ $cek->created_at->format("d-M-Y") }}
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
