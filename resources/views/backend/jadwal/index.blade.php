@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_jadwals.labels.management'))

@section('breadcrumb-links')
@include('backend.jadwal.includes.breadcrumb-links')
@endsection

@section('content')
{{-- <div class="card">
        @include('backend.jadwal.includes.cari')
</div> --}}

<div class="card">
    {{-- <div class="card-header">
        Tahsin Angkatan 16 Tahun 2020
    </div> --}}
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Jadwal Tahsin
                     {{-- <small class="text-muted">Tahsin Angkatan {{ session('angkatan_tahsin') }}</small> --}}
                    {{-- {{ __('backend_jadwals.labels.management') }} <small class="text-muted">{{ __('backend_jadwals.labels.active') }}</small> --}}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">

                @include('backend.jadwal.includes.header-buttons')
                {{-- <a href=" {{ url()->current() }}/upload" >
                    <button class="float-right btn btn-info">
                        <i class="fa fa-upload"></i> Upload Excel
                    </button>
                </a> --}}
            </div><!--col-->
        </div><!--row-->
        {{-- {{ $duplicates }} --}}
        {{-- @foreach($duplicates as $data)
            {{ $data->jadwal_tahsin }}, {{ $data->level_jadwal }}, {{ $data->nama_pengajar }} -
            {{ $data->jumlah }} <br>
        @endforeach --}}

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
                            <label class="custom-file-label" for="upload">Pilih File Tambah Data Jadwal</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button id="btnupload" type="submit" class="btn btn-primary btn-block" >Upload File</button>
                    </div>
                </div>
            </form>
        </div>
        <form action="{{ Request::fullUrl() }}" class="row mt-4">
            @if ( !isset(request()->page))
                <input type="hidden" name="page" value="1">
            @else
                <input type="hidden" name="page" value="{{ request()->page }}">
            @endif
            <div class="col-md-1">
                <select class="form-control mt-4" name="perPage" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>

            <div class="col">
                {{-- <div class="text-muted text-center" style="position: absolute">
                    Pengajar
                 </div>
                <select class="form-control mt-4" name="pengajar" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->pengajar)
                        <option value="{{ request()->pengajar }}">{{ request()->pengajar }}</option>
                        <option value="">-------</option>
                    @endisset
                        <option value="SEMUA">SEMUA</option>
                    @foreach($datapengajars as $pengajar)
                        <option value="{{ $pengajar->nama_pengajar }}">{{ $pengajar->nama_pengajar }}</option>
                    @endforeach
                </select> --}}
            </div>
            <div class="col-md-2">
                <div class="text-muted text-center" style="position: absolute">
                    Level
                 </div>
                <select class="form-control mt-4" name="level" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->level)
                        <option value="{{ request()->level }}">{{ request()->level }}</option>
                        <option value="">-------</option>
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
            <div class="col-md-2">
                <div class="text-muted text-center" style="position: absolute">
                Angkatan
                 </div>
                <select class="form-control mt-4" name="angkatan" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->angkatan)
                        <option value="{{ request()->angkatan }}">{{ request()->angkatan }}</option>
                        <option value="">-------</option>
                    @endisset
                    <option value="19">19</option>
                    <option value="18">18</option>
                    <option value="17">17</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="text-muted text-center" style="position: absolute">
                Jenis
                 </div>
                <select class="form-control mt-4" name="jenis" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->jenis)
                        <option value="{{ request()->jenis }}">{{ request()->jenis }}</option>
                        <option value="">-------</option>
                    @endisset
                    <option value="SEMUA">SEMUA</option>
                    <option value="IKHWAN">IKHWAN</option>
                    <option value="AKHWAT">AKHWAT</option>
                </select>
            </div>

            <div class="col-md-3">
                <div class="pull-right input-group mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-search"></i> </span>
                    </div>
                    <input name="pengajar" class="form-control" type="text" placeholder="Cari Pengajar" autocomplete="password" width="100">
                </div>
            </div>
        </form>
        <div class="row mt-4">
            <div class="col">
                <div class="table">
                    <table class="table table-responsive-sm table-hover mb-0 table-sm" id="jadwal-">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Pengajar</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Waktu</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Angkatan</th>
                                <th class="text-center">Jumlah Peserta</th>
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
                                            <div style="text-transform: uppercase;">{{ $jadwal->pengajar_jadwal }}</div>
                                            {{-- <div class="small text-muted">
                                                {{ $jadwal->pengajar_jadwal }}
                                            </div> --}}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            if ($jadwal->level_jadwal  == "ASAASI 1") {
                                                $warna = "#20a8d8";
                                            } elseif ($jadwal->level_jadwal  == "ASAASI 2") {
                                                $warna = "#20c997";
                                            } elseif ($jadwal->level_jadwal  == "TILAWAH ASAASI") {
                                                $warna = "#17a2b8";
                                            } elseif ($jadwal->level_jadwal  == "TAMHIDI") {
                                                $warna = "#f86c6b";
                                            } elseif ($jadwal->level_jadwal  == "TAWASUTHI") {
                                                $warna = "#6610f2";
                                            } elseif ($jadwal->level_jadwal  == "TILAWAH TAWASUTHI") {
                                                $warna = "#ffc107";
                                            } elseif ($jadwal->level_jadwal  == "IDADI") {
                                                $warna = "#e83e8c";
                                            } elseif ($jadwal->level_jadwal  == "TAKMILI") {
                                                $warna = "#4dbd74";
                                            } elseif ($jadwal->level_jadwal  == "TAHSINI") {
                                                $warna = "#b81752";
                                            } elseif ($jadwal->level_jadwal  == "ITQON") {
                                                $warna = "#1848f5";
                                            } else {
                                                $warna = "#2f353a";
                                            }
                                        @endphp

                                        @if ($jadwal->level_jadwal == null)
                                        @else
                                            <button class="btn btn-sm" style="color: #fff; background-color: {{ $warna }}; border-color: {{ $warna }};">
                                                <i class="fa fa-time-circle-o"></i><strong>{{ $jadwal->level_jadwal }}</strong>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                        {{-- <div>SABTU</div> --}}
                                            <div>{{ $jadwal->hari_jadwal }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <div>07.00</div> --}}
                                        <div class="text-center">
                                            <strong>{{ $jadwal->waktu_jadwal }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($jadwal->jenis_jadwal == 'IKHWAN')
                                            <div class="text-center">
                                                <strong  style="color: #20a8d8!important">{{ $jadwal->jenis_jadwal }}</strong>
                                            </div>
                                        @elseif ($jadwal->jenis_jadwal == 'AKHWAT')
                                            <div class="text-center">
                                                <strong  style="color: #e83e8c!important">{{ $jadwal->jenis_jadwal }}</strong>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                -
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{ $jadwal->angkatan_jadwal }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{-- @php
                                                $data = DB::table('tahsins')
                                                        ->where('nama_pengajar', $jadwal->pengajar_jadwal)
                                                        ->where('level_peserta', $jadwal->level_jadwal)
                                                        ->where('jadwal_tahsin', $jadwal->hari_jadwal.' '.$jadwal->waktu_jadwal)
                                                        ->where('jenis_peserta', $jadwal->jenis_jadwal)
                                                        ->where('angkatan_peserta', $jadwal->angkatan_jadwal)
                                                        ->count();
                                            @endphp --}}
                                            {{ $jadwal->jumlah_peserta }}
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
