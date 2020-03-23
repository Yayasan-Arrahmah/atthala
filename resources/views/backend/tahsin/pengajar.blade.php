@extends('backend.layouts.app')

@section('title', app_name() . ' | Pengajar Tahsin')

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@stack('before-styles')
    {{ style('//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}
@stack('after-styles')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Pengajar Tahsin<small class="text-muted"> - Angkatan 15</small>

                    {{-- {{ __('backend_tahsins.labels.management') }} <small class="text-muted">{{ __('backend_tahsins.labels.active') }}</small> --}}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table table-responsive-sm table-hover mb-0 table-sm">
                    <table class="table display compact nowarp" id="pengajartahsin" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center" width="350">Pengajar</th>
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
                            $kelas = DB::table('jadwals')
                                    ->where('nama_pengajar', $tahsin->nama_pengajar)
                                    ->select('jadwal_tahsin', (DB::raw('COUNT(*) as jumlahkelas ')))
                                    ->groupBy('jadwal_tahsin')
                                    ->havingRaw(DB::raw('COUNT(*) > 0'))
                                    ->get();
                            @endphp

                            <tr>
                                <td class="text-center" >
                                    {{ $key + $datapengajars->firstItem() }}
                                </td>
                                <td>
                                    <a data-toggle="collapse" href="#detail{{ $number }}" aria-expanded="false" style="padding-left: 15px">{{ $tahsin->nama_pengajar }}</a>
                                    <div class="collapse" id="detail{{ $number }}" style="padding: 5px 0 5px 15px">
                                        @foreach($kelas as $jadwal)
                                          {{ $n++ }}.  {{ $jadwal->jadwal_tahsin }} = {{ $jadwal->jumlahkelas }} Peserta<br>
                                        @endforeach
                                    </div>
                                </td>
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
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{-- {!! $first !!} - {!! $end !!} Dari {!! $datapengajars->total() !!} Data --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $datapengajars->appends(request()->query())->links() !!} --}}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
