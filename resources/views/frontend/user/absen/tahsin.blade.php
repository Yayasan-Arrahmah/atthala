@extends('frontend.user.layout')

@section('user')

<div class="row" >
    <div class="col-md-12">
        <ol class="breadcrumb" style="padding: .3rem .3rem;">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/#">Absen</a></li>
            <li class="breadcrumb-item active">Tahsin</li>
        </ol>
    </div>
</div>
<div class="row" style="padding-bottom: 30px">
    <div class="col">
        <div class="text-center" style="font-size: 19px; font-weight: 600">
            Data Kelas Tahsin - {{ auth()->user()->user_pengajar }}
        </div>
    </div><!--col-md-6-->
</div><!--row-->
<div class="row">
    <div class="col">
        <div class="row justify-content-center">
            <div class="col-md-12" style="font-weight: 600; padding-bottom: 20px ">
                <div class="table-responsive" style="padding: 0px 15px 15px 15px">
                    <section>
                        <div class="row kotak-atas">
                            <div class="col-4">Jadwal</div>
                            <div class="col-4 text-center">Level</div>
                            <div class="col-4 text-center">Jumlah</div>
                        </div>
                        @foreach ($datajadwals as $jadwal)

                        <div class="row kotak" style="margin-bottom: 3px;">
                            <div class="col-4">
                                <a href="{{ route('frontend.user.absentahsinkelas') }}?waktu={{ $jadwal->jadwal_tahsin }}&level={{ $jadwal->level_peserta }}&jenis={{ $jadwal->jenis_peserta }}" style="color: rgb(56, 56, 56);">
                                    <div style="text-transform: uppercase;"><strong>{{ $jadwal->jadwal_tahsin }}</strong></div>
                                    <div class="small text-muted">
                                        {{ auth()->user()->jenis }}
                                    </div>
                                </a>
                            </div>
                            <div class="col-4 text-center" style="margin-left: 0px">
                                @php
                                if ($jadwal->level_peserta  == "ASAASI 1") {
                                    $warna = "#20a8d8";
                                } elseif ($jadwal->level_peserta  == "ASAASI 2") {
                                    $warna = "#20c997";
                                } elseif ($jadwal->level_peserta  == "TILAWAH ASAASI") {
                                    $warna = "#17a2b8";
                                } elseif ($jadwal->level_peserta  == "TAMHIDI") {
                                    $warna = "#ffc107";
                                } elseif ($jadwal->level_peserta  == "TAWASUTHI") {
                                    $warna = "#6610f2";
                                } elseif ($jadwal->level_peserta  == "TILAWAH TAWASUTHI") {
                                    $warna = "#ffb700";
                                } elseif ($jadwal->level_peserta  == "IDADI") {
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
                                <div class="small text-muted">
                                    {{-- ANGKATAN {{ session('daftar_ulang_angkatan_tahsin') }} --}}
                                    ANGKATAN {{ $jadwal->angkatan_peserta }}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center" style="padding-bottom: 5px">
                                    <div class="text-value" style="font-size: 15px">{{ $jadwal->jumlah }}</div>
                                    <div class="small text-muted">
                                        PESERTA
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </section>
                </div>
            </div>
        </div>
    </div>
</div><!--row-->
{{-- @livewire('absen-tahsin') --}}
@endsection
