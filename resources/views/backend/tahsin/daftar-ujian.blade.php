@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card" style="margin-bottom: 200px">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Daftar Ulang Peserta Ujian <small class="text-muted">Angkatan {{ request()->angkatan ?? session('daftar_ujian') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
            </div><!--col-->
        </div><!--row-->

        <form class="row mt-4" action="" method="get">
            @csrf
            <div class="col-md-1">
                <select id="selectpaged" class="form-control" name="paged">
                    <option>{{ request()->input('paged') ?? $paged }}</option>
                    <option>---</option>
                    <option>5</option>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                    <option>150</option>
                </select>
            </div>

            <div class="col text-center">
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
                    <option value="18">18</option>
                    <option value="17">17</option>
                    <option value="16">16</option>
                </select>
            </div>
            {{-- <div class="col-md-2 text-center">
                <div class="text-muted text-center" style="position: absolute">
                    Angkatan
                </div>
                <select class="form-control" name="jenis" onchange='this.form.submit()'>
                    <option value="{{ request()->input('jenis') ?? '' }}">{{ request()->input('jenis') ?? 'Pilih Jenis' }}</option>
                    <option>---</option>
                    <option value="">Semua</option>
                    <option value="IKHWAN">IKHWAN</option>
                    <option value="AKHWAT">AKHWAT</option>
                </select>
            </div> --}}
            <div class="col-md-3 pull-right">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input class="form-control" type="text" name="idtahsin" placeholder="Cari ID Tahsin" autocomplete="password" width="100" value="{{ request()->input('idtahsin') ?? '' }}">
                </div>
            </div>
            <div class="col-md-1 text-center" style="padding-left: 0px">
                <button class="btn btn-primary btn-block"><i class="fa fa-search"></i> Cari</button>
            </div>
        </form>
        <div class="row mt-2" style="margin-bottom: -15px">
            <div class="col-2">
                <div class="float-left">
                    Total {!! $pesertaujians->total() !!} Data
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive-sm table-hover mb-0 table-sm">
                    <table class="table display compact nowarp" style="width:100%">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th width="350" class="text-center">Nama</th>
                            <th width="250" class="text-center">Jadwal</th>
                            <th>Kode BBTT</th>
                            <th class="text-center">Bukti Transfer</th>
                            <th class="text-center">Status Lunas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $first  = 0;
                            $end    = 0;
                        @endphp
                        @foreach($pesertaujians as $key => $pesertaujian)
                        @php
                            $data = DB::table('tahsins')->where('no_tahsin', $pesertaujian->no_tahsin)->where('angkatan_peserta', request()->angkatan ?? 18)->first();
                        @endphp
                        <tr>
                            <td class="text-center" >
                                {{ $key + $pesertaujians->firstItem() }}
                            </td>
                            <td>
                                <a href="#" style="color: rgb(56, 56, 56);">
                                    <div style="text-transform: uppercase; font-weight: 700">{{ $pesertaujian->no_tahsin }} - {{ $data->nama_peserta ?? '' }}</div>
                                    <div class="small text-muted">
                                        {{ $data->nohp_peserta ?? '' }} |  {{ $data->waktu_lahir_peserta ?? '' }} | {{ \Carbon\Carbon::createFromFormat('d-m-Y', $data->waktu_lahir_peserta ?? '01-01-1901')->age ?? '' }} Tahun
                                    </div>
                                </a>
                            </td>
                            <td>
                                <div style="text-transform: uppercase; font-weight: 700">{{ $data->nama_pengajar ?? '' }}</div>
                                <div class="small text-muted">
                                   {{ $data->level_peserta ?? '' }} | {{ $data->jadwal_tahsin ?? '' }} | {{ $data->jenis_peserta ?? ''  }}
                                </div>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::createFromFormat('d-m-Y', $data->waktu_lahir_peserta ?? '01-01-1901')->format('md') }}
                            </td>
                            <td>
                                <div class="text-center">
                                    {{-- @isset($pesertaujian->bukti_transfer) --}}
                                    <div style="">
                                        <img class="zoom"
                                            src="/bukti-transfer-daftar-ujian/{{ $pesertaujian->bukti_transfer ?? '404.jpg' }}"
                                        alt="" height="50">
                                    </div>
                                    {{-- @endisset --}}
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{ $pesertaujian->status_pelunasan}}
                                </div>
                            </td>
                        </tr>
                            @php
                                $first  = $pesertaujians->firstItem();
                                $end    = $key + $pesertaujians->firstItem();
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
                    {!! $first !!} - {!! $end !!} From {!! $pesertaujians->total() !!} Data
                    {{-- {!! $pesertaujians->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $pesertaujians->total()) }} --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $pesertaujians->appends(request()->query())->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@stack('before-scripts')

<script type="text/javascript">
    $(document).ready(function() {
        var select = document.getElementById('selectpaged');
        select.addEventListener('change', function(){
            this.form.submit();
        }, false);
    });
</script>

@stack('after-scripts')

@endsection
