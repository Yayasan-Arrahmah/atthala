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
                    {{-- Pendaftaran Baru Tahsin<small class="text-muted"> - Angkatan {{ request()->angkatan ?? session('daftar_ulang_angkatan_tahsin') }}</small> --}}
                    Pendaftaran Baru Tahsin<small class="text-muted"> - Angkatan {{ request()->angkatan ?? session('angkatan_tahsin') }}</small>

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
            <div class="col-md-2">
                <div class="text-muted text-center" style="position: absolute">
                Status
                 </div>
                <select class="form-control mt-4" id="status" name="status" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option value="SEMUA">SEMUA</option>
                    <option value="1">Belum Selesai Diperiksa</option>
                    <option value="2">Belum Pilih Jadwal</option>
                    <option value="3">Selesai</option>
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
        <script type="text/javascript">
            $(document).ready(function(){
                  $("#status").val("{!! request()->status !!}");
            });
        </script>
        <form action="{{ route('admin.tahsins.exportexceltahsinpesertabaru') }}" target="_blank" class="row">
            {{ csrf_field() }}
            <div class="col-2">
                <button class="form-control mt-4 btn btn-success btn-sm">
                    Download Excel <i class="fa fa-file-excel fa-lg"></i>
                </button>
            </div>
            <div class="col-10">
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
                                @if (auth()->user()->last_name === 'Ekonomi' || auth()->user()->last_name === 'Admin')
                                <th>Status</th>
                                @endif
                                <th class="text-center">Rekaman / Hasil</th>
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
                                $data = DB::table('pembayarans')->where('id_peserta', $tahsin->id)->first();
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
                                    Rp. {{ strrev(implode('.',str_split(strrev(strval( $data->nominal_pembayaran ?? '-')),3))) }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('d-m-Y', $tahsin->waktu_lahir_peserta ?? '01-01-1901')->format('md') }}
                                </td>
                                <td>
                                    <div class="text-center">
                                        {{-- @isset($pesertaujian->bukti_transfer) --}}
                                        <div style="">
                                            <img class="zoom"
                                                src="https://atthala.arrahmahbalikpapan.or.id/app/public/bukti-transfer/{{ $data->bukti_transfer_pembayaran ?? '404.jpg' }}"
                                            alt="" height="50">
                                        </div>
                                        {{-- @endisset --}}
                                    </div>
                                </td>
                                @if (auth()->user()->last_name === 'Ekonomi' || auth()->user()->last_name === 'Admin')
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <form action="{{ route('admin.tahsins.konfirmasidaftarbaru') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                                @if ($tahsin->level_peserta != null && $tahsin->nama_pengajar != null)
                                                    @if ($data->admin_pembayaran == 'MENUNGGU KONFIRMASI' || $data->admin_pembayaran == 'TRANSFER')
                                                        <button class="btn btn-warning" style="font-weight: 700">Konfirmasi</button>
                                                    @elseif ($data->admin_pembayaran == 'BERHASIL')
                                                        <button class="btn btn-success" style="font-weight: 700">Berhasil <i class="fas fa-"></i></button>
                                                    @endif
                                                @else
                                                    <label class="btn btn-outline-danger" style="font-weight: 700">Proses Belum Selesai<i class="fas fa-"></i></label>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                <td>
                                    @if (auth()->user()->last_name === 'Ekonomi')
                                        <div style="text-transform: uppercase;">{{ $tahsin->level_peserta ?? 'Belum Diseleksi' }}</div>
                                        <div class="small text-muted">
                                            @if ($tahsin->jadwal_tahsin != null)
                                                {{ $tahsin->nama_pengajar }} | {{ $tahsin->jadwal_tahsin }}
                                            @else
                                                <span class="text-danger" style="font-weight: 700">Peserta Belum Pilih Jadwal</span>
                                            @endif
                                        </div>
                                    @else
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
                                                @if ($tahsin->level_peserta != null)
                                                    <div style="text-transform: uppercase;">{{ $tahsin->level_peserta }}</div>
                                                    <div class="small text-muted">
                                                        @if ($tahsin->jadwal_tahsin != null)
                                                            {{ $tahsin->nama_pengajar }} | {{ $tahsin->jadwal_tahsin }}
                                                        @else
                                                            <span class="text-danger" style="font-weight: 700">Peserta Belum Pilih Jadwal</span>
                                                        @endif
                                                    </div>
                                                @else
                                                    @if ($tahsin->status_peserta === 'NOTIF')
                                                        <div class="card-bodyquote text-black text-center">
                                                            Peserta telah dikirimi Notifikasi agar mengirim Voice Note Rekaman Tilawah Ke WhatsApp Penguji. Silahkan Penguji memeriksa pesan tersebut.
                                                        </div>
                                                        <form class="text-center">
                                                            <input name="idtahsin" value="{{ $tahsin->no_tahsin }}" hidden>
                                                            <button type="submit" class="btn btn-success btn-block btn-pill btn-sm">Beri Hasil</button>
                                                        </form>
                                                    @else
                                                        <form class="text-center">
                                                            <input name="idtahsin" value="{{ $tahsin->no_tahsin }}" hidden>
                                                            <button type="submit" class="btn btn-danger btn-block btn-pill btn-sm">DIPERIKSA Oleh <strong>{{ $tahsin->status_peserta }}</strong></button>
                                                        </form>
                                                    @endif
                                                @endif
                                            @else
                                                <form class="text-center">
                                                    <input name="idtahsin" value="{{ $tahsin->no_tahsin }}" hidden>
                                                    <button type="submit" class="btn btn-primary btn-block btn-pill btn-sm">Pilih</button>
                                                </form>
                                            @endif

                                        @endif
                                    @endif

                                </td>
                            </tr>
                            @if (isset(request()->idtahsin))
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="text-muted">
                                            *Kirim notifikasi WA ke peserta Jika rekaman tidak ada.
                                        </div>
                                    </td>
                                    <td>
                                        <form class="text-center">
                                            <input name="notifikasi" value="{{ $tahsin->no_tahsin }}" hidden>
                                            <button type="submit" class="btn btn-warning btn-block btn-sm"><i class=" fas fa-paper-plane"></i> Kirim</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
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
