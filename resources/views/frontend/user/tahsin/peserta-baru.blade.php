@extends('frontend.user.layout')

@section('user')
@stack('after-styles')
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css') }}
    <style>
        .flickity-prev-next-button {
            width: 18px;
            height: 18px;
        }
        .flickity-page-dots .dot {
            width: 5px;
            height: 5px;
        }
        .flickity-page-dots {
            bottom: 10px;
        }
    </style>
@stack('before-styles')

@stack('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
@stack('before-scripts')

<div class="row" >
    <div class="col-md-12">
        <ol class="breadcrumb" style="padding: .3rem .3rem;">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/#">Tahsin</a></li>
            <li class="breadcrumb-item active">Peserta Baru</li>
        </ol>
    </div>
</div>
{{-- <div class="row" style="padding-bottom: 30px">
    <div class="col">
        <div class="text-center" style="font-size: 19px; font-weight: 600">
            Peserta Tahsin Baru - Angkatan {{ session('daftar_ulang_angkatan_tahsin') }}
        </div>
    </div><!--col-md-6-->
</div><!--row--> --}}
<div class="row">
    @if (auth()->user()->last_name == 'PENGAJAR')
        @if (auth()->user()->status == 'PENGUJI')
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0">
                        Pendaftaran Baru Tahsin<small class="text-muted"> - Angkatan {{ request()->angkatan ?? session('daftar_ulang_angkatan_tahsin') }}</small>
                        {{-- {{ __('backend_tahsins.labels.management') }} <small class="text-muted">{{ __('backend_tahsins.labels.active') }}</small> --}}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    {{-- @include('backend.tahsin.includes.header-buttons') --}}
                    {{-- <a href=" {{ url()->current() }}/upload" >
                        <button class="float-right btn btn-info">
                            <i class="fa fa-upload"></i> Upload Excel
                        </button>
                    </a> --}}
                </div>
            </div><!--row-->

            {{-- <div class="row">
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
            </div> --}}
            <form action="{{ Request::fullUrl() }}" class="row mt-4">
                {{-- <div class="col-md-1">
                    <select class="form-control mt-4" name="perPage" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div> --}}

                <div class="col">
                </div>
                {{-- <div class="col-md-2">
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
                </div> --}}
                {{-- <div class="col-md-2">
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
                </div> --}}
                {{-- <div class="col-md-2">
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
                </div> --}}

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
                                    <th class="text-center">Rekaman Tilawah</th>
                                    {{-- <th class="text-center">Level</th> --}}
                                    {{-- <th class="text-center">Jadwal</th> --}}
                                    {{-- <th class="text-center">Pengajar</th> --}}
                                    {{-- <th class="text-center">Jenis</th> --}}
                                    {{-- <th class="text-center">Keterangan</th>
                                    <th class="text-center">Daftar Ulang</th> --}}
                                    {{-- <th class="text-center">Angkatan</th> --}}
                                    {{-- <th width="100" class="text-center"></th> --}}
                                    {{-- <th width="100" class="text-center"></th> --}}
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
                                                {{ $tahsin->no_tahsin }} | {{ $tahsin->jenis_peserta }}
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        @if (isset(request()->idtahsin))
                                            <div class="text-center">
                                                <audio controls style="width: 250px; height: 30px;">
                                                    <source src="/app/public/rekaman/{{ $tahsin->rekaman_peserta }}" type="audio/ogg">
                                                    <source src="/app/public/rekaman/{{ $tahsin->rekaman_peserta }}" type="audio/mpeg">
                                                    <source src="/app/public/rekaman/{{ $tahsin->rekaman_peserta }}" type="audio/mp4">
                                                    <source src="/app/public/rekaman/{{ $tahsin->rekaman_peserta }}" type="audio/wav">
                                                    error
                                                </audio>
                                            </div>
                                            <form>
                                                <input name="idtahsin" value="{{ $tahsin->no_tahsin  }}" hidden>
                                                @if(!empty(Request::get('nama')))
                                                    <input name="nama" value="{{ Request::get('nama') }}" hidden>
                                                @endif
                                                @if(!empty(Request::get('page')))
                                                    <input name="page" value="{{ Request::get('page') }}" hidden>
                                                @endif
                                                <input name="nohp" value="{{ $tahsin->nohp_peserta }}" hidden>
                                                <select style="font-weight: 600;" class="form-control" name="level" onchange='if(this.value != 0) { this.form.submit(); }'>
                                                    <option value=""> Pilih Hasil Peserta </option>
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
                                        @else
                                            @if ($tahsin->status_peserta != null)
                                                <button type="" class="btn btn-danger btn-block btn-pill btn-sm">DIPERIKSA Oleh <strong>{{ $tahsin->status_peserta }}</strong></button>
                                            @else
                                                @if ($tahsin->jenis_peserta == auth()->user()->jenis_peserta)
                                                    <form class="text-center">
                                                        <input name="idtahsin" value="{{ $tahsin->no_tahsin }}" hidden>
                                                        <button type="submit" class="btn btn-primary btn-block btn-pill btn-sm">Pilih</button>
                                                    </form>
                                                @endif
                                            @endif

                                        @endif

                                    </td>
                                    {{-- <td>
                                        <form action="{{ Request::fullUrl() }}">
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
                                    </td> --}}
                                    {{-- <td>
                                        <div class="text-center">
                                            <strong>{{ $tahsin->jadwal_tahsin }}</strong>
                                        </div>
                                    </td> --}}
                                    {{-- <td>
                                        <div style="text-transform: uppercase;">{{ $tahsin->nama_pengajar }}</div>
                                        <div class="small text-muted">
                                            {{ $tahsin->jadwal_tahsin }} | {{ $tahsin->jenis_peserta }}
                                        </div>
                                    </td> --}}
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
                                    {{-- <td>
                                        <div class="text-center">
                                            {{ $tahsin->angkatan_peserta }}
                                        </div>
                                    </td> --}}

                                    {{-- <td>
                                        <button class="btn btn-danger  btn-sm"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-success  btn-sm"><i class="fa fa-pen"></i></button>
                                        <div class="text-center">
                                            {!! $tahsin->action_buttons !!}
                                        </div>
                                    </td> --}}
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
        @endif
    @endif
</div>
@endsection
