@extends('backend.layouts.app-2')

@section('title', app_name() . '| Tahsin')

@section('content')


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">
                        SPP Tahsin - <u>{{ $title ?? 'Peserta' }}</u>
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
                            <div class="col font-weight-bold text-uppercase">
                                Pembayaran Ke-
                            </div>
                            <div class="col font-weight-bold text-uppercase" style="margin-left: 0px">
                                Total
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                                Status
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                            </div>
                        </div>
                        @php
                            $first  = 0;
                            $end    = 0;
                            $number = 1;
                        @endphp
                        @foreach($tahsins as $key=> $tahsin)
                            <div class="row kotak mb-1" style="border-left-color: {{ $tahsin->level != null ? $tahsin->level->warna : '' }} !important; border-left-width: 4px!important;">
                                <td>{{ $key + $tahsins->firstItem() }}</td>
                                <div class="col pr-0">
                                    <a data-toggle="collapse" href="#detail{{ $key + $tahsins->firstItem() }}" aria-expanded="false" style="color: rgb(56, 56, 56);" class="">
                                        <div class="font-weight-bold text-uppercase">
                                            {{ $tahsin->no_tahsin }} - {{ $tahsin->nama_peserta }}
                                        </div>
                                        <div class="small text-muted">
                                            <strong style="color:  {{ $tahsin->level != null ? $tahsin->level->warna : '' }} !important">{{ $tahsin->level_peserta }}</strong>
                                            |
                                            {{ $tahsin->waktu_lahir_peserta ? \Carbon\Carbon::createFromFormat('d-m-Y', $tahsin->waktu_lahir_peserta ?? '01-01-1901')->format('md') : '' }}
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <table>
                                        <tbody>
                                            @php
                                                $nominal = 0;
                                            @endphp
                                            @foreach ($tahsin->pembayaran as $datapembayaran)
                                                <tr class="text-muted">
                                                    <td>
                                                        {{ $datapembayaran->keterangan_pembayaran ?? 'Daftar' }}
                                                    </td>
                                                    <td>
                                                        -
                                                    </td>
                                                    <td>
                                                        Rp. {{ number_format($datapembayaran->nominal_pembayaran , 0, '.', '.') }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $nominal = $nominal + $datapembayaran->nominal_pembayaran;
                                                @endphp
                                            @endforeach
                                            @if ($tahsin->pembayaranujian($tahsin->angkatan_peserta))
                                                <tr class="text-muted">
                                                    <td>
                                                        {{ 'Daftar Ujian' }}
                                                    </td>
                                                    <td>
                                                        -
                                                    </td>
                                                    <td>
                                                        {{ $tahsin->pembayaranujian($tahsin->angkatan_peserta)->status_pelunasan }}
                                                    </td>
                                                </tr>
                                            @else
                                            <tr class="text-muted">
                                                <td>
                                                    Belum Daftar Ujian
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col" style="margin-left: 0px">
                                    <div class="text-muted font-weight-bold">
                                        Rp. {{ number_format($nominal , 0, '.', '.') }}
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col-12" style="color: #4e4e4e">
                                    <div class="col">
                                        <div class="collapse hide" id="detail{{ $key + $tahsins->firstItem() }}" style="">
                                            <hr>
                                            <form class="row" action="" method="post">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Tanggal Lahir</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $tahsin->tempat_lahir_peserta }}, {{ $tahsin->waktu_lahir_peserta }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nomor HP</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $tahsin->nohp_peserta }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jadwal Tahsin</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $tahsin->jadwal_tahsin }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Pengajar</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $tahsin->nama_pengajar }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <table>
                                                        <tbody>
                                                            @php
                                                                $nominal_ = 0;
                                                            @endphp
                                                            @foreach ($tahsin->pembayaran as $datapembayaran_)
                                                                <tr class="font-weight-bold">
                                                                    <td>
                                                                        {{ $datapembayaran_->keterangan_pembayaran ?? 'Daftar' }}
                                                                    </td>
                                                                    <td>
                                                                        -
                                                                    </td>
                                                                    <td>
                                                                        Rp. {{ number_format($datapembayaran_->nominal_pembayaran , 0, '.', '.') }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($datapembayaran_->keterangan_pembayaran)
                                                                            <img class="zoom"
                                                                                src="https://atthala.arrahmahbalikpapan.or.id/bukti-transfer-spp/{{ $datapembayaran_->bukti_transfer_pembayaran ?? '404.jpg' }}"
                                                                                alt="" height="50">
                                                                        @else
                                                                            <img class="zoom"
                                                                                src="https://atthala.arrahmahbalikpapan.or.id/app/public/bukti-transfer/{{ $datapembayaran_->bukti_transfer_pembayaran ?? '404.jpg' }}"
                                                                                alt="" height="50">
                                                                        @endif

                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $nominal_ = $nominal_ + $datapembayaran_->nominal_pembayaran;
                                                                @endphp
                                                            @endforeach
                                                            @if ($tahsin->pembayaranujian($tahsin->angkatan_peserta))
                                                                <tr class="font-weight-bold">
                                                                    <td>
                                                                        {{ 'Daftar Ujian' }}
                                                                    </td>
                                                                    <td>
                                                                        -
                                                                    </td>
                                                                    <td>
                                                                        {{ $tahsin->pembayaranujian($tahsin->angkatan_peserta)->status_pelunasan }}
                                                                    </td>
                                                                    <td>
                                                                        <img class="zoom"
                                                                                src="https://atthala.arrahmahbalikpapan.or.id/bukti-transfer-daftar-ujian/{{ $tahsin->pembayaranujian($tahsin->angkatan_peserta)->bukti_transfer ?? '404.jpg' }}"
                                                                                alt="" height="50">
                                                                    </td>
                                                                </tr>
                                                            @else
                                                            <tr class="font-weight-bold">
                                                                <td>
                                                                    Belum Daftar Ujian
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-3">
                                                    {{-- <div class="mb-3">
                                                        <label lass="form-label">Nominal</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-sm btn-primary">Perbaruhi</button>
                                                    </div> --}}
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                            $first  = $tahsins->firstItem();
                            $end    = $key + $tahsins->firstItem();
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

@endsection
