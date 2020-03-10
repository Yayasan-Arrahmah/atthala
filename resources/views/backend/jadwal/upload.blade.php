@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_jadwals.labels.management'))

@section('breadcrumb-links')
@include('backend.jadwal.includes.breadcrumb-links')
@endsection

@section('content')

<div class="card" >
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Upload Peserta <small class="text-muted">Wajib Dipilih Jenis Peserta & Angkatan</small>
                </h4>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <form onmouseover="verifikasi()" class="form-horizontal col-md-12" action="{{ route('admin.jadwals.import') }}" method="POST" enctype="multipart/form-data" style="padding-top: 20px">
                <div class="form-group row" style="margin-bottom:0px">
                    {{ csrf_field() }}
                    <label class="col-md-1 col-form-label" for="file-input">
                        Pilih File  :
                    </label>
                    <div class="col-md-5">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="upload" required>
                            <label class="custom-file-label" for="upload">Pilih File</label>
                        </div>
                    </div>
                    <div class="col">
                        <select id="jenis" name="jenispeserta" class="form-control" onchange="verifikasi()" required>
                            <option value=" ">Pilih Jenis Peserta</option>
                            <option value="IKHWAN">IKHWAN</option>
                            <option value="AKHWAT">AKHWAT</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id="angkatan" name="angkatanpeserta" class="form-control" onchange="verifikasi()" required>
                            <option value=" ">Pilih Angkatan</option>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button id="btnupload" type="submit" class="btn btn-primary btn-block" >Upload File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function verifikasi() {
	    var btn = document.getElementById("btnupload");
        if (document.getElementById("angkatan").value===" " || document.getElementById("jenis").value===" ") {
            btn.disabled = true;
        } else {
            btn.disabled = false;
        }
    }
</script>

<div class="card">
    <div class="card-body">
        <center><h4><small class="text-muted card-title">Yang ter-upload Hari Ini</small></h4></center>
        <div class="row mt-4">
            <div class="col">
                <div class="table table-responsive-sm table-hover mb-0 table-sm">
                    <table class="table">
                        <thead>
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
                                    {{ $number++ }}
                                </td>
                                <td>
                                    <a href="/admin/jadwals/{{ $jadwal->id }}" style="color: rgb(56, 56, 56);">
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
                        {!! $first !!} - {!! $end !!} Dari {!! $jadwals->total() !!} Data
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $jadwals->appends(request()->query())->links() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->

    @endsection
