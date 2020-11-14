@extends('backend.layouts.app')

@section('title', app_name() . ' | Peserta ' . __('backend_tahsins.labels.management'))

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
{{-- <div class="card">
    @include('backend.tahsin.includes.cari')
</div> --}}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Pembayaran Tahsin<small class="text-muted"> - Angkatan {{ request()->angkatan ?? session('angkatan_tahsin') }}</small>

                    {{-- {{ __('backend_tahsins.labels.management') }} <small class="text-muted">{{ __('backend_tahsins.labels.active') }}</small> --}}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.tahsin.includes.header-buttons')
                <a href=" {{ url()->current() }}/upload" >
                    <button class="float-right btn btn-info">
                        <i class="fa fa-upload"></i> Upload Excel
                    </button>
                </a>
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <form onmouseover="verifikasi()" class="form-horizontal col-md-12" action="{{ route('admin.tahsins.updatelevel') }}" method="POST" enctype="multipart/form-data" style="padding-top: 20px">
                <div class="form-group row" style="margin-bottom:0px">
                    {{ csrf_field() }}
                    <label class="col-md-1 col-form-label" for="file-input">
                        Pilih File  :
                    </label>
                    <div class="col-md-5">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="upload" required>
                            <label class="custom-file-label" for="upload">Pilih File Update Kenaikan Tahsin</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button id="btnupload" type="submit" class="btn btn-primary btn-block" >Upload File</button>
                    </div>
                </div>
            </form>
        </div>
        <form action="{{ Request::fullUrl() }}" class="row mt-4">
            <div class="col-md-1">
                <select class="form-control mt-4" name="perPage" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>

            <div class="col">
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
                    <option value="16">16</option>
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
                    <input name="nama" class="form-control" type="text" placeholder="Cari Nama" autocomplete="password" width="100">
                </div>
            </div>
        </form>
        <div class="row mt-4">
            <div class="col">
                <div class="table table-responsive-sm table-hover mb-0 table-sm">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Kenaikan Level</th>
                                <th class="text-center">Jadwal</th>
                                {{-- <th class="text-center">Pengajar</th> --}}
                                {{-- <th class="text-center">Jenis</th> --}}
                                {{-- <th class="text-center">Keterangan</th>
                                <th class="text-center">Daftar Ulang</th> --}}
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
                            @foreach($tahsins as $key=> $tahsin)
                            <tr>
                                <td class="text-center" >
                                    {{ $key + $tahsins->firstItem() }}
                                </td>
                                <td>
                                    <a href="/admin/tahsin/{{ $tahsin->id }}/edit" style="color: rgb(56, 56, 56);">
                                        <div style="text-transform: uppercase;">{{ $tahsin->nama_peserta }}</div>
                                        <div class="small text-muted">
                                            {{ $tahsin->no_tahsin }} | {{ $tahsin->nohp_peserta }}
                                        </div>
                                    </a>
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
                                    <form action="{{ Request::fullUrl() }}">
                                        {{-- @csrf --}}
                                        <input name="idtahsin" value="{{ $tahsin->no_tahsin  }}" hidden>
                                        @if(!empty(Request::get('nama')))
                                            <input name="nama" value="{{ Request::get('nama') }}" hidden>
                                        @endif
                                        @if(!empty(Request::get('page')))
                                            <input name="page" value="{{ Request::get('page') }}" hidden>
                                        @endif
                                        <select style="font-weight: 700;" class="form-control" name="kenaikanlevel" onchange='if(this.value != 0) { this.form.submit(); }'>
                                            <option value="">{{ $tahsin->kenaikan_level_peserta }}</option>
                                            <option value="">-----</option>
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
                                    </form>
                                </td>
                                {{-- <td>
                                    <div class="text-center">
                                        <strong>{{ $tahsin->jadwal_tahsin }}</strong>
                                    </div>
                                </td> --}}
                                <td>
                                    <div style="text-transform: uppercase;">{{ $tahsin->nama_pengajar }}</div>
                                    <div class="small text-muted">
                                        {{ $tahsin->jadwal_tahsin }} | {{ $tahsin->jenis_peserta }}
                                    </div>
                                </td>
                                {{-- <td>
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
                                </td> --}}
                                {{-- <td>
                                    <div lass="text-center" style="color: #73818f!important;">
                                        {{ $tahsin->keterangan_tahsin }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        {{ $tahsin->sudah_daftar_tahsin }}
                                        {{ $tahsin->belum_daftar_tahsin }}
                                    </div>
                                </td> --}}
                                <td>
                                    <div class="text-center">
                                        {{ $tahsin->angkatan_peserta }}
                                    </div>
                                </td>

                                <td>
                                    {{-- <button class="btn btn-danger  btn-sm"><i class="fa fa-trash"></i></button>
                                    <button class="btn btn-success  btn-sm"><i class="fa fa-pen"></i></button> --}}
                                    <div class="text-center">
                                        {!! $tahsin->action_buttons !!}
                                    </div>
                                </td>
                            </tr>
                            @php
                            $first  = $tahsins->firstItem();
                            $end    = $key + $tahsins->firstItem();
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
                    {{-- {!! $tahsins->count() !!} {{ trans_choice('backend_tahsins.table.total', $tahsins->count()) }} --}}

                    {!! $first !!} - {!! $end !!} Dari {!! $tahsins->total() !!} Data
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $tahsins->links() !!} --}}
                    {!! $tahsins->appends(request()->query())->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    {{-- @livewire('tahsin.peserta') --}}
</div><!--card-->
@endsection
