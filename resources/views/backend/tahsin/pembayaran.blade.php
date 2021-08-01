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
                    Pembayaran SPP Tahsin<small class="text-muted"> - Angkatan 18</small>
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
                                <th>Nama</th>
                                <th>Kode BBTT</th>
                                <th>Nominal</th>
                                <th>Bukti Transfer</th>
                                <th>SPP</th>
                                <th class="text-center" width="200">Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $first  = 0;
                            $end    = 0;
                            $number = 1;
                            @endphp
                            @foreach($pembayaran as $key=> $data)
                            <tr>
                                <td class="text-center" >
                                    {{ $key + $pembayaran->firstItem() }}
                                </td>
                                <td>
                                    <a href="#" style="color: rgb(56, 56, 56);">
                                        <div style="text-transform: uppercase; font-weight: 700">{{ $data->tahsin->no_tahsin ?? '' }} - {{ $data->tahsin->nama_peserta ?? '' }}</div>
                                        <div class="small text-muted">
                                            {{ $data->tahsin->nohp_peserta ?? '' }} |  {{ $data->tahsin->waktu_lahir_peserta ?? '' }} | {{ \Carbon\Carbon::createFromFormat('d-m-Y', $data->tahsin->waktu_lahir_peserta ?? '01-01-1901')->age ?? '' }} Tahun
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('d-m-Y', $data->tahsin->waktu_lahir_peserta ?? '01-01-1901')->format('md') }}
                                </td>
                                <td>
                                    Rp. {{ number_format($data->nominal_pembayaran,0,',','.') }}
                                </td>
                                <td>
                                    <div style="">
                                        <img class="zoom"
                                            src="/bukti-transfer-spp/{{ $data->bukti_transfer_pembayaran ?? '404.jpg' }}"
                                        alt="" height="50">
                                    </div>
                                    <div>
                                        {{ $data->created_at }}
                                    </div>
                                </td>
                                <td>
                                    Bulan Ke {{ $data->keterangan_pembayaran }}
                                </td>
                                <td>
                                    @if ($data->admin_pembayaran == 'MENUNGGU KONFIRMASI')
                                        <form action="">
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <input type="hidden" name="idp" value="{{ $data->id_peserta }}">
                                            <input type="hidden" name="notahsin" value="{{ $data->tahsin->no_tahsin }}">
                                            <input type="hidden" name="metode" value="update">
                                            <button class="btn btn-warning btn-pill" style="font-weight: 700">Menunggu Konfirmasi</button>
                                        </form>
                                    @elseif ($data->admin_pembayaran == 'BERHASIL')
                                        <form action="">
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <input type="hidden" name="idp" value="{{ $data->id_peserta }}">
                                            <input type="hidden" name="notahsin" value="{{ $data->tahsin->no_tahsin }}">
                                            <input type="hidden" name="metode" value="update">
                                            <button class="btn btn-info" style="font-weight: 700">Berhasil</button>
                                        </form>
                                    @endif
                                </td>

                            </tr>

                            @php
                            $first  = $pembayaran->firstItem();
                            $end    = $key + $pembayaran->firstItem();
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
                    {{-- {!! $pembayaran->count() !!} {{ trans_choice('backend_tahsins.table.total', $pembayaran->count()) }} --}}

                    {!! $first !!} - {!! $end !!} Dari {!! $pembayaran->total() !!} Data
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $pembayaran->links() !!} --}}
                    {!! $pembayaran->appends(request()->query())->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

</div><!--card-->
@endsection

