@extends('backend.layouts.app-2')

@section('title', app_name() . '| Tahsin')

@section('content')


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">
                        Pembayaran Tahsin - <u>{{ $title ?? 'Peserta' }}</u>
                    </h4>
                </div><!--card-header-->
                <div class="card-body">
                    @include('backend.pendidikan.tahsin.component.filter-tahsin')
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="legend p-3">
                        <div class="row kotak-atas mb-3">
                            <div class="col pr-0 font-weight-bold text-uppercase">
                                Nama
                            </div>
                            <div class="col-1 font-weight-bold text-uppercase">
                                BBTT
                            </div>
                            <div class="col-2 font-weight-bold text-uppercase">
                                Nominal
                            </div>
                            <div class="col-2 font-weight-bold text-uppercase" style="margin-left: 0px">
                                Bukti Transfer
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                                Keterangan
                            </div>
                        </div>
                        @php
                            $first  = 0;
                            $end    = 0;
                            $number = 1;
                        @endphp
                        @foreach($pembayaranspp as $key=> $spp)
                            <div class="row kotak mb-1" style="border-left-color: {{ $spp->tahsinspp->level != null ? $spp->tahsinspp->level->warna : '' }} !important; border-left-width: 4px!important;">
                                <td>{{ $key + $pembayaranspp->firstItem() }}</td>
                                <div class="col pr-0">
                                    <a data-toggle="collapse" href="#detail{{ $key + $pembayaranspp->firstItem() }}" aria-expanded="false" style="color: rgb(56, 56, 56);" class="">
                                        <div class="font-weight-bold text-uppercase">
                                            {{ $spp->tahsinspp->no_tahsin }} - {{ $spp->tahsinspp->nama_peserta }}
                                        </div>
                                        <div class="small text-muted">
                                            <strong style="color:  {{ $spp->tahsinspp->level != null ? $spp->tahsinspp->level->warna : '' }} !important">{{ $spp->tahsinspp->level_peserta ?? 'BELUM PILIH LEVEL' }}</strong>
                                            |
                                            {{ $spp->tahsinspp->nohp_peserta }}
                                        </div>
                                    </a>
                                </div>
                                <div class="col-1 font-weight-bold">
                                    {{ $spp->tahsinspp->waktu_lahir_peserta ? \Carbon\Carbon::createFromFormat('d-m-Y', $spp->tahsinspp->waktu_lahir_peserta ?? '01-01-1901')->format('md') : '' }}
                                </div>
                                <div class="col-2 font-weight-bold">
                                        Rp. {{ number_format($spp->nominal_pembayaran , 0, '.', '.') }}
                                </div>
                                <div class="col-2" style="margin-left: 0px">
                                    <img class="zoom"
                                        src="https://atthala.arrahmahbalikpapan.or.id/bukti-transfer-spp/{{ $spp->bukti_transfer_pembayaran ?? '404.jpg' }}"
                                        alt="" height="50">
                                </div>
                                <div class="col">
                                    <table>
                                        <tr>
                                            <td>Pembayaran</td>
                                            <td>:</td>
                                            <td class="font-weight-bold">{{ $spp->keterangan_pembayaran }}</td>
                                        </tr>
                                        <tr>
                                            <td>Waktu</td>
                                            <td>:</td>
                                            <td class="font-weight-bold">{{ $spp->created_at }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12" style="color: #4e4e4e">
                                    <div class="col">
                                        <div class="collapse hide" id="detail{{ $key + $pembayaranspp->firstItem() }}" style="">
                                            <hr>
                                            <form class="row" action="" method="post">
                                                <div class="col-4">
                                                    <div class="mb-3">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Tanggal Lahir</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $spp->tahsinspp->tempat_lahir_peserta }}, {{ $spp->tahsinspp->waktu_lahir_peserta }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nomor HP</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $spp->tahsinspp->nohp_peserta }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jadwal Tahsin</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $spp->tahsinspp->jadwal_tahsin }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Pengajar</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $spp->tahsinspp->nama_pengajar }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Nominal</label>
                                                        <input type="text" class="form-control" value="{{ $spp->nominal_pembayaran }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-sm btn-primary">Perbaruhi</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                            $first  = $pembayaranspp->firstItem();
                            $end    = $key + $pembayaranspp->firstItem();
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-7">
            <div class="float-left">
                {!! $first !!} - {!! $end !!} Dari {!! $pembayaranspp->total() !!} Data
            </div>
        </div><!--col-->

        <div class="col-5">
            <div class="float-right">
                {{-- {!! $pembayaranspp->links() !!} --}}
                {!! $pembayaranspp->appends(request()->query())->links() !!}
            </div>
        </div><!--col-->
    </div><!--row-->

@endsection
