@extends('frontend.layouts.guest')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
	<div class="row justify-content-center align-items-center">
		<div class="col col-sm-12 align-self-center">
			<div class="card">
                <center>
                    <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150" alt="arrahmah">
                    <div style="padding-top: 0px">
                        <h4>Pencarian <br>Daftar Ulang Peserta Tahsin</h4>
                        <div class="text-muted">
                            Angkatan {{ session('daftar_ulang_angkatan_tahsin') }}
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
                                                <div class="col-2"></div>
                                                <div class="col">Nama</div>
                                                <div class="col">Kenaikan Level</div>
                                            </div>

                                            @foreach($pencarian as $key=> $tahsin)
                                            <div class="row kotak">
                                                <div class="col-2 text-center">
                                                    {{-- @php
                                                        $cekujian = DB::table('peserta_ujians')->where('no_tahsin', $tahsin->no_tahsin)->where('angkatan_ujian', session('angkatan_tahsin'))->first();
                                                    @endphp
                                                    @if (isset($cekujian)) --}}
                                                    @if ($tahsin->kenaikan_level_peserta === 'TAJWIDI 1')
                                                        <a href="https://forms.gle/FGZXXGV1VZR7LHar5"  style="color:white; font-size: 11px" class="btn btn-primary">DAFTAR ULANG</a>
                                                    @else
                                                        <a href="/tahsin/daftar-ulang-peserta/daftar?id={{ $tahsin->no_tahsin }}"  style="color:white; font-size: 11px" class="btn btn-primary">DAFTAR ULANG</a>
                                                    @endif
                                                    {{-- @else
                                                        <div class="text-muted" style="font-weight: 800; font-size: 11px">
                                                            BELUM DAFTAR UJIAN
                                                        </div>
                                                        <a style="font-weight: 800; font-size: 11px" href="/tahsin/calon-peserta-ujian/daftar?id={{ $tahsin->no_tahsin }}&notelp={{ $tahsin->nohp_peserta }}"  style="color:white" class="btn btn-danger">KLIK UNTUK DAFTAR UJIAN</a>
                                                        <a href="#"  style="color:white" class="btn btn-danger">BELUM DAFTAR UJIAN</a>
                                                    @endif --}}
                                                </div>
                                                <div class="col">
                                                    <div style="text-transform: uppercase;"><strong>{{ $tahsin->nama_peserta }}</strong></div>
                                                    <div class="small text-muted">
                                                        {{ $tahsin->no_tahsin }}
                                                    </div>
                                                </div>
                                                <div class="col" style="margin-left: 0px;">
                                                    <div style="text-transform: uppercase;"><strong>{{ $tahsin->kenaikan_level_peserta ?? $tahsin->level_peserta }}</strong></div>
                                                    <div class="small text-muted">
                                                        Dari Level : {{ $tahsin->level_peserta }}<br>
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
