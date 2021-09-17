@extends('frontend.user.layout')

@section('user')

<div class="row" >
    <div class="col-md-12">
        <ol class="breadcrumb" style="padding: .3rem .3rem;">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Tahsin</li>
        </ol>
    </div>
</div>
<div class="row" style="padding-bottom: 30px">
    <div class="col">
        <div class="text-center" style="font-size: 19px; font-weight: 600">
            Data Kelas Tahsin - ANGKATAN 18
        </div>
    </div><!--col-md-6-->
</div><!--row-->
<div class="row">
    <div class="col">
        <form action="" class="row pb-4">
            <div class="col">
                <div class="text-muted text-center" style="position: absolute">
                    Pengajar
                 </div>
                <select class="form-control mt-4" name="pengajar" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->pengajar)
                        <option value="{{ request()->pengajar }}">{{ request()->pengajar }}</option>
                        <option value="">-------</option>
                    @endisset
                        <option value="SEMUA">SEMUA</option>
                    @foreach($datapengajar as $pengajar)
                        <option value="{{ $pengajar->nama_pengajar }}">{{ $pengajar->nama_pengajar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <div class="text-muted text-center" style="position: absolute">
                    Level
                 </div>
                <select class="form-control mt-4" name="level" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->level)
                        <option value="{{ request()->level }}">{{ request()->level }}</option>
                        <option value="">----</option>
                    @endisset
                        <option value="SEMUA">SEMUA</option>
                        <option value="ASAASI 1">ASAASI 1</option>
                        <option value="ASAASI 2">ASAASI 2</option>
                        <option value="TILAWAH ASAASI">TILAWAH ASAASI</option>
                        <option value="TAMHIDI">TAMHIDI</option>
                        <option value="TAWASUTHI">TAWASUTHI</option>
                        <option value="TILAWAH TAWASUTHI">TILAWAH TAWASUTHI</option>
                        <option value="IDADI">IDADI</option>
                        <option value="TAKMILI">TAKMILI</option>
                        <option value="TAHSINI">TAHSINI</option>
                        <option value="ITQON">ITQON</option>
                </select>
            </div>
            <div class="col">
                <div class="text-muted text-center" style="position: absolute">
                    Waktu
                 </div>
                <select class="form-control mt-4" name="waktu" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->waktu)
                        <option value="{{ request()->waktu }}">{{ request()->waktu }}</option>
                        <option value="">-------</option>
                    @endisset
                        <option value="SEMUA">SEMUA</option>
                    @foreach($datajadwaltahsin as $jadwal)
                        <option value="{{ $jadwal->jadwal_tahsin }}">{{ $jadwal->jadwal_tahsin }}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <div class="row justify-content-center">
            <div class="col-md-12" style="font-weight: 600; padding-bottom: 20px ">
                <div class="table-responsive" style="padding: 0px 15px 15px 15px">
                    <section>
                        <div class="row kotak-atas">
                            <div class="col-4">Jadwal</div>
                            <div class="col-4 text-center">Level</div>
                            <div class="col-4 text-center">Jumlah</div>
                        </div>
                        @php
                            $first  = 0;
                            $end    = 0;
                            $number = 1;
                        @endphp
                        @foreach ($datajadwals as $key => $jadwal)
                        <a href="{{ route('frontend.user.tahsinpesertakelas') }}?waktu={{ $jadwal->jadwal_tahsin }}&level={{ $jadwal->level_peserta }}&jenis={{ $jadwal->jenis_peserta }}&pengajar={{ $jadwal->nama_pengajar }}" style="color: rgb(56, 56, 56);">
                            <div class="row kotak" style="margin-bottom: 3px;">
                                <div class="col-4">
                                    <div style="text-transform: uppercase;"><strong>{{ $jadwal->nama_pengajar }}</strong></div>
                                    <div class="small text-muted">
                                        {{ $jadwal->jadwal_tahsin }} | {{ $jadwal->jenis_peserta }}
                                    </div>
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
                                        ANGKATAN 18
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
                        </a>
                        @php
                            $first  = $datajadwals->firstItem();
                            $end    = $key + $datajadwals->firstItem();
                        @endphp
                        @endforeach
                    </section>
                </div>
            </div>
        </div>
    </div>
</div><!--row-->
<div class="row">
    <div class="col-7">
        <div class="float-left">

            {!! $first !!} - {!! $end !!} Dari {!! $datajadwals->total() !!} Data
        </div>
    </div><!--col-->

    <div class="col-5">
        <div class="float-right">
            {!! $datajadwals->appends(request()->query())->links() !!}
        </div>
    </div><!--col-->
</div><!--row-->
{{-- @livewire('absen-tahsin') --}}
@endsection
