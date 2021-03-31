@extends('frontend.layouts.guest')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
{{-- <div class="row justify-content-center align-items-center">
    <div class="col col-sm-12 align-self-center">
        <div class="card">
            <center>
                <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150" alt="arrahmah">
                <div style="padding-top: 0px">
                    <h4>Daftar Ulang Peserta Tahsin<br> Telah Ditutup</h4>
                    <div class="text-muted">
                        Angkatan {{ session('daftar_ulang_angkatan_tahsin') }}
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
                        <h4>Pencarian <br>Daftar Ulang Peserta Tahsin</h4>
                        <div class="text-muted">
                            {{-- Angkatan {{ session('daftar_ulang_angkatan_tahsin') }} --}}
                            Angkatan 18
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
                                                    @if (strpos($tahsin->kenaikan_level_peserta, 'TAJWIDI') !== false )
                                                        <a href="https://forms.gle/FGZXXGV1VZR7LHar5"  style="color:white; font-size: 11px" class="btn btn-primary">DAFTAR ULANG</a>
                                                    @else
                                                        {{-- <a href="/tahsin/daftar-ulang-peserta/daftar?id={{ $tahsin->no_tahsin }}"  --}}
                                                            <a href="/tahsin/cek/daftar-ulang-peserta/daftar?id={{ $tahsin->no_tahsin }}&idt={{ $tahsin->id }}&nama={{ $tahsin->nama_peserta }}" style="color:white; font-size: 11px" class="btn btn-primary">DAFTAR ULANG</a>
                                                    @endif
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
