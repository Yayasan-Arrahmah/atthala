@extends('backend.layouts.app')

@section('title', app_name() . ' | Peserta ' . __('backend_tahsins.labels.management'))

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
{{-- <div class="card">
    @include('backend.tahsin.includes.cari')
</div> --}}
@if (request()->metode == 'edit')
    <form class="row" action="">
        @php
            $peserta = DB::table('tahsins')->where('id', request()->peserta)->first();
        @endphp
        <input type="hidden" name="id" value="{{ request()->id }}">
        <input type="hidden" name="idtahsin" value="{{ $peserta->no_tahsin }}">
        <input type="hidden" name="metode" value="update">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col">
                            <h5>Edit Nominal Pembayaran</h5>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Peserta</label>
                        <label class="col-sm-10 col-form-label">
                            <div style="text-transform: uppercase; font-weight: 700">{{ $peserta->no_tahsin }} - {{ $peserta->nama_peserta ?? '' }}</div>
                            <div class="small text-muted">
                                {{ $peserta->nohp_peserta ?? '' }} |  {{ $peserta->waktu_lahir_peserta ?? '' }} | {{ \Carbon\Carbon::createFromFormat('d-m-Y', $peserta->waktu_lahir_peserta ?? '01-01-1901')->age ?? '' }} Tahun
                            </div>
                        </label>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Nominal</label>
                        <div class="col-sm-10 input-group">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input class="form-control" name="nominal" type="text" value="{{ request()->nominal }}" placeholder="Nominal">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-left">
                            <a href="{{ route('admin.tahsins.daftarulang') }}?page={{ request()->page ?? '' }}" class="btn btn-light">Tutup</a>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Daftar Ulang Tahsin<small class="text-muted"> - Angkatan {{ request()->angkatan ?? '19' }}</small>
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
                    <option value="20">20</option>
                    <option value="19">19</option>
                    <option value="18">18</option>
                    <option value="17">17</option>
                    <option value="16">16</option>
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
                                <th>Nama</th>
                                <th>Nominal Pembayaran</th>
                                <th>Kode BBTT</th>
                                <th>Bukti Transfer</th>
                                <th class="text-center">Info</th>
                                <th></th>
                                <th></th>
                                {{-- <th class="text-center">Level</th> --}}
                                {{-- <th class="text-center">Jadwal</th> --}}
                                {{-- <th class="text-center">Pengajar</th> --}}
                                {{-- <th class="text-center">Jenis</th> --}}
                                {{-- <th class="text-center">Keterangan</th>
                                <th class="text-center">Daftar Ulang</th> --}}
                                {{-- <th class="text-center">Angkatan</th> --}}
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
                            @php
                                $data = DB::table('pembayarans')->where('id_peserta', $tahsin->id)->first() ?? null;
                            @endphp
                            <tr>
                                <td class="text-center" >
                                    {{ $key + $tahsins->firstItem() }}
                                </td>
                                <td>
                                    <a href="/admin/tahsins/{{ $tahsin->id }}/edit" style="color: rgb(56, 56, 56);">
                                        <div style="text-transform: uppercase; font-weight: 700">{{ $tahsin->no_tahsin }} - {{ $tahsin->nama_peserta ?? '' }}</div>
                                        <div class="small text-muted">
                                            {{ $tahsin->nohp_peserta ?? '' }} |  {{ $tahsin->waktu_lahir_peserta ?? '' }} | {{ \Carbon\Carbon::createFromFormat('d-m-Y', $tahsin->waktu_lahir_peserta ?? '01-01-1901')->age ?? '' }} Tahun
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    Rp. {{ strrev(implode('.',str_split(strrev(strval( $data->nominal_pembayaran ?? '-')),3)))}}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('d-m-Y', $tahsin->waktu_lahir_peserta ?? '01-01-1901')->format('md') }}
                                </td>
                                <td>

                                    <div class="text-center">
                                        {{-- @isset($pesertaujian->bukti_transfer) --}}
                                        <div style="">
                                            <img class="zoom"
                                                src="/app/public/bukti-transfer/{{ $data->bukti_transfer_pembayaran ?? '404.jpg' }}"
                                            alt="" height="50">
                                        </div>
                                        {{-- @endisset --}}
                                    </div>
                                </td>
                                <td>
                                    <div style="text-transform: uppercase;">{{ $tahsin->level_peserta }}</div>
                                    <div class="small text-muted">
                                        @if ($tahsin->jadwal_tahsin != null)
                                            {{ $tahsin->nama_pengajar }} | {{ $tahsin->jadwal_tahsin }}
                                        @else
                                            Peserta Belum Pilih Jadwal
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="row">
                                        <div class="col">
                                            <form action="{{ route('admin.tahsins.konfirmasidaftarulang') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                                @if (!null == $data)
                                                    @if ($data->admin_pembayaran == 'MENUNGGU KONFIRMASI' || $data->admin_pembayaran == 'TRANSFER')
                                                        <button class="btn btn-warning" style="font-weight: 700">Konfirmasi</button>
                                                    @elseif ($data->admin_pembayaran == 'BERHASIL')
                                                        <button class="btn btn-success" style="font-weight: 700">Berhasil <i class="fas fa-"></i></button>
                                                    @endif
                                                @else
                                                    <label class="btn btn-outline-dark" style="font-weight: 700">Belum Daftar Ulang<i class="fas fa-"></i></label>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="/admin/tahsin/daftar-ulang?metode=edit&id={{ $data->id ?? '' }}&peserta={{ $tahsin->id }}&nominal={{ $data->nominal_pembayaran ?? '' }}" class="btn btn-sm btn-info">Edit <i class="fas fa-edit"></i></a>
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
