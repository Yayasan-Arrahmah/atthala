@extends('backend.layouts.app')

@section('title', app_name() . ' | Peserta ' . __('backend_tahsins.labels.management'))

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Absen Tahsin<small class="text-muted"> - Angkatan 16</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-md-12">
                Waktu Pertemuan Absen
            </div>
        </div>

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
                                        <div class="text-muted">
                                            {{ $tahsin->jenis_peserta }}, {{ $tahsin->jumlah }} Peserta
                                        </div>
                                    </a>
                                </td>
                                @php
                                    $cekuser = $datauser->where('user_pengajar', $tahsin->nama_pengajar )->first()
                                @endphp
                                @for ($b = 1; $b <= 15; $b++)
                                    @php
                                        $cek = $dataabsen->where('user_create_absen', $cekuser->id ?? 0 )->where('pertemuan_ke_absen', $b)->where('angkatan_absen', $angkatan)->first()
                                    @endphp
                                    <td class="text-center text-muted">
                                        @if (isset($cek))
                                        {{ $cek->updated_at->format("H:i") }} WITA<br>
                                        {{ $cek->updated_at->format("d-M-Y") }}
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
</div><!--card-->
@endsection
