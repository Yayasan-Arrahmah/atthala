@extends('frontend.layouts.guest')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
{{-- <div class="row justify-content-center align-items-center">
    <div class="col col-sm-12 align-self-center">
        <div class="card">
            <center>
                <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150" alt="arrahmah">
                <div style="padding-top: 0px">
                    <h4>Pendaftaran Calon Peserta Ujian Tahsin <br> Telah Ditutup</h4>
                    <div class="text-muted">
                        Angkatan {{ session('daftar_ujian') }}
                    </div>
                </div>
            </center>
        </div>
    </div>
</div> --}}
<div class="row justify-content-center align-items-center">
    <div class="col col-sm-12 align-self-center">
        <div class="card">
            <center>
                <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150" alt="arrahmah">
                <div style="padding-top: 0px">
                    <h4>Pembayaran Tahsin</h4>
                    <div class="text-muted">
                        Pencarian Peserta
                    </div>
                </div>
            </center>
            @include('frontend.includes.cari')
            @if (is_null($pencarian))
                <center>
                </center>
            @else
                <div class="card-body">
                    <center>
                        Hasil Pencarian
                    </center>
                    @if (count($pencarian) === 0)
                    <center>
                        <div class="text-muted pt-4">
                            <strong>DATA TIDAK DITEMUKAN</strong>
                        </div>
                        <p>
                            Mohon Ulangi Pencarian Dengan Benar Dan Membaca Basmalah. Terima Kasih
                        </p>
                    </center>
                    @else
                        <div class="row mt-4" style=" overflow-x: scroll;">
                            <div class="col" style="min-width: 500px; ">
                                <div class="table-responsive" style="padding: 0px 15px 15px 15px;">
                                    <section>
                                        <div class="row kotak-atas">
                                            <div class="col">Nama</div>
                                            <div class="col">Pengajar</div>
                                        </div>

                                        @foreach($pencarian as $key=> $tahsin)
                                        <div class="row kotak">
                                            <div class="col-12">
                                                <h5 style="font-size: 13px; color: #185280">
                                                    <strong>PEMBAYARAN ANGKATAN {{ $tahsin->angkatan_peserta }}</strong>
                                                </h5>
                                            </div>
                                            <hr>
                                            <div class="col-6">
                                                <div style="text-transform: uppercase;"><strong>{{ $tahsin->nama_peserta }}</strong></div>
                                                <div class="small text-muted">
                                                    {{ $tahsin->no_tahsin }} | {{ $tahsin->level_peserta }} - {{ $tahsin->jadwal_tahsin }}
                                                </div>
                                            </div>
                                            <div class="col-6" style="margin-left: 0px;">
                                                <div style="text-transform: uppercase;"><strong>{{ $tahsin->nama_pengajar }}</strong></div>
                                                <div class="small text-muted">
                                                    {{ $tahsin->jenis_peserta }}<br>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <label class="text-muted mb-0">Riwayat Pembayaran</label>
                                                <hr class="mt-1 mb-1">
                                                <div class="row" style="font-weight: 600; padding-bottom: 10px;">
                                                    <div class="col">Nominal</div>
                                                    <div class="col">Status</div>
                                                    <div class="col">Info Pembayaran</div>
                                                </div>
                                                @php
                                                $noriwayat = 1;
                                                $riwayatpembayaran = DB::table('pembayarans')
                                                        ->where('id_peserta', $tahsin->id)
                                                        ->get();
                                                @endphp
                                                @foreach($riwayatpembayaran as $riwayat)
                                                    <div class="row">
                                                        <div class="col" style="font-size: 16px"> Rp. {{ number_format($riwayat->nominal_pembayaran, 0, '.', '.') }} </div>
                                                        <div class="col" style="font-size: 15px">
                                                            @if ($riwayat->admin_pembayaran == 'MENUNGGU KONFIRMASI' || $riwayat->admin_pembayaran == 'TRANSFER')
                                                                <span class="badge badge-warning">{{ $riwayat->admin_pembayaran }}</span>
                                                            @elseif ($riwayat->admin_pembayaran == 'BERHASIL')
                                                                <span class="badge badge-info">{{ $riwayat->admin_pembayaran }}</span>
                                                            @elseif ($riwayat->admin_pembayaran == 'GAGAL MASUK')
                                                                <span class="badge badge-danger">{{ $riwayat->admin_pembayaran }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col" style="font-size: 11px">
                                                            <strong>{{ $riwayat->keterangan_pembayaran ?? 'DAFTAR ULANG' }}</strong>
                                                            <div class="text-muted">
                                                                {{ $riwayat->created_at }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-12 mt-4 pt-2">
                                            <div class="row kotak">
                                                <div class="col-md-6 mt-4 pt-2">
                                                    <h5>Total Kewajiban Tahsin Peserta Baru 1 Periode</h5>
                                                    <div class="col-md-12 table-responsive" style="padding-top: 20px">
                                                        <table class="table table-sm table-striped nowarp" style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="">Biaya Pendaftaran</td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 100.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="">SPP Bulan 1</td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 100.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="">SPP Bulan 2</td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 100.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="">SPP Bulan 3</td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 100.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="">SPP Bulan 4</td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 100.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class=""><strong>Total Kewajiban 1 Periode </strong></td>
                                                                    <td class="text-center"><div class="text-muted"><strong>Rp. 500.000</strong></div></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-4 pt-2">
                                                    <h5>Total Kewajiban Tahsin Peserta Lama 1 Periode</h5>
                                                    <div class="col-md-12 table-responsive" style="padding-top: 20px">
                                                        <table class="table table-sm table-striped nowarp" style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="">Biaya Daftar Ulang </td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 50.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="">SPP Bulan 1</td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 100.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="">SPP Bulan 2</td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 100.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="">SPP Bulan 3</td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 100.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="">SPP Bulan 4</td>
                                                                    <td class="text-center"><div class="text-muted">Rp. 100.000</div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class=""><strong>Total Kewajiban 1 Periode </strong></td>
                                                                    <td class="text-center"><div class="text-muted"><strong>Rp. 450.000</strong></div></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-12 mt-4 pt-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="/tahsin/pembayaran?id={{ $tahsin->id }}&idt={{ $tahsin->no_tahsin }}&notelp={{ $tahsin->nohp_peserta }}&angkatan={{ $tahsin->angkatan_peserta }}"
                                                            style="color:white"
                                                            class="btn btn-success">
                                                            <i class="fas fa-chevron-right"></i> Form Pembayaran SPP
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </section>
                                </div>
                            </div>
                        </div>
                    @endif
                </div><!--card body-->
            @endif


        </div><!--card-->

    </div><!-- col-md-8 -->
</div><!-- row -->
@endsection
