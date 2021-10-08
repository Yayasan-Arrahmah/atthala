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
                    Rekapitulasi Pembayaran SPP Tahsin<small class="text-muted"> - Angkatan 18</small>
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
                    <option value="19">19</option>
                    <option value="18">18</option>
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
        <div class="row mt-4" style=" overflow-x: scroll;">
            <div class="col" style="min-width: 500px; ">
                <div class="table-responsive" style="padding: 0px 15px 15px 15px;">
                    <section>
                        <div class="row kotak-atas">
                            <div class="col-4">Nama</div>
                            <div class="col-4">Pengajar</div>
                            <div class="col-4">Pembayaran</div>
                        </div>
                        @php
                        $first  = 0;
                        $end    = 0;
                        $number = 1;
                        @endphp
                        @foreach($tahsins as $key=> $data)
                        <div class="row kotak">
                            <div class="col-4">
                                <div style="text-transform: uppercase; font-weight: 700">{{ $data->no_tahsin ?? '' }} - {{ $data->nama_peserta ?? '' }}</div>
                                <div class="small text-muted">
                                    {{ $data->nohp_peserta ?? '' }} |  {{ $data->waktu_lahir_peserta ?? '' }} | {{ \Carbon\Carbon::createFromFormat('d-m-Y', $data->waktu_lahir_peserta ?? '01-01-1901')->age ?? '' }} Tahun
                                </div>
                            </div>
                            <div class="col-4">
                                <div style="text-transform: uppercase;"><strong>{{ $data->nama_pengajar }}</strong></div>
                                <div class="small text-muted">
                                    {{ $data->jenis_peserta }} | {{ $data->level_peserta }} - {{ $data->jadwal_tahsin }}
                                </div>
                            </div>
                            @php
                                $noriwayat = 1;
                                $totalpembayaran = DB::table('pembayarans')
                                        ->where('id_peserta', $data->id)
                                        ->where('admin_pembayaran', 'BERHASIL')
                                        ->where('bukti_transfer_pembayaran', 'like', '18-SPP-%')
                                        ->sum('nominal_pembayaran');
                            @endphp
                            <div class="col-4">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Total</td>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($totalpembayaran, 0, '.', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Piutang</td>
                                            <td>:</td>
                                            <td>Rp. 400.000 - Rp. {{ number_format($totalpembayaran, 0, '.', '.') }} = <strong>Rp. {{ number_format(400000 - $totalpembayaran, 0, '.', '.') }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 mt-4">
                                <a data-toggle="collapse" lass="text-muted mb-0" href="#detail{{ $key + $tahsins->firstItem() }}" aria-expanded="false" style="padding-left: 15px">Riwayat Pembayaran</a>
                            </div>

                            <div class="col-12">
                                <div class="collapse" id="detail{{ $key + $tahsins->firstItem() }}" >
                                    <hr class="mt-1 mb-1">

                                    {{-- <label class="text-muted mb-0">Riwayat Pembayaran</label> --}}
                                    <div class="row" style="font-weight: 600; padding-bottom: 10px;">
                                        <div class="col-1">No</div>
                                        <div class="col-3">Nominal</div>
                                        <div class="col-3">Waktu</div>
                                        <div class="col-3">Bukti</div>
                                        <div class="col-2">Status</div>
                                    </div>
                                    @php
                                        $noriwayat = 1;
                                        $riwayatpembayaran = DB::table('pembayarans')
                                                ->select('nominal_pembayaran', 'admin_pembayaran', 'created_at', 'admin_pembayaran', 'bukti_transfer_pembayaran' )
                                                ->where('id_peserta', $data->id)
                                                ->where('bukti_transfer_pembayaran', 'like', '18-SPP-%')
                                                ->get();
                                    @endphp
                                    @foreach($riwayatpembayaran as $riwayat)
                                        <div class="row">
                                            <div class="col-1"> {{ $noriwayat++ }}. </div>
                                            <div class="col-3"> Rp. {{ number_format($riwayat->nominal_pembayaran, 0, '.', '.') }} </div>
                                            <div class="col-3" style="font-size: 10px"> {{ $riwayat->created_at }}</div>
                                            <div class="col-3">
                                                <img class="zoom"
                                                    src="/bukti-transfer-spp/{{ $riwayat->bukti_transfer_pembayaran ?? '404.jpg' }}"
                                                alt="" height="50">
                                            </div>
                                            <div class="col-2" style="font-size: 10px">
                                                @if ($riwayat->admin_pembayaran == 'MENUNGGU KONFIRMASI')
                                                    <span class="badge badge-warning">{{ $riwayat->admin_pembayaran }}</span>
                                                @elseif ($riwayat->admin_pembayaran == 'BERHASIL')
                                                    <span class="badge badge-info">{{ $riwayat->admin_pembayaran }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @php
                            $first  = $tahsins->firstItem();
                            $end    = $key + $tahsins->firstItem();
                        @endphp
                        @endforeach
                    </section>
                </div>
            </div>
        </div>
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

</div><!--card-->
@endsection

