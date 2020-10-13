@extends('frontend.layouts.guest')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
	<div class="row justify-content-center align-items-center">
		<div class="col col-sm-12 align-self-center">
			<div class="card">
                <center>
                    <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150" alt="arrahmah">
                    <div style="padding-top: 0px">
                        <h4>Pencarian <br>Calon Peserta Ujian Tahsin</h4>
                        <div class="text-muted">
                            Angkatan 16
                        </div>
                    </div>
                </center>
                @include('frontend.includes.cari')
				<div class="card-body">
                    <center>
                        Hasil Pencarian
                    </center>
                    <div class="row mt-4" style=" overflow-x: scroll;">
                        <div class="col" style="min-width: 500px; ">
                            <div class="table-responsive" style="padding: 0px 15px 15px 15px;">
                                <section>
                                    <div class="row kotak-atas">
                                        <div class="col-2"></div>
                                        <div class="col">Nama</div>
                                        <div class="col">Pengajar</div>
                                    </div>
                                    @php
                                    $first  = 0;
                                    $end    = 0;
                                    $number = 1;
                                    @endphp
                                    @foreach($pencarian as $key=> $tahsin)
                                    <div class="row kotak">
                                        {{-- <div class="col-md-1">{{ $key + $pencarian->firstItem() }}</div> --}}
                                        <div class="col-2">
                                            <a href="/tahsin/calon-peserta-ujian/daftar?id={{ $tahsin->no_tahsin }}&notelp={{ $tahsin->nohp_peserta }}"  style="color:white" class="btn btn-primary">PILIH</a>
                                        </div>
                                        <div class="col">
                                            <div style="text-transform: uppercase;"><strong>{{ $tahsin->nama_peserta }}</strong></div>
                                            <div class="small text-muted">
                                                {{ $tahsin->level_peserta }} | {{ $tahsin->jadwal_tahsin }}
                                            </div>
                                        </div>
                                        <div class="col" style="margin-left: 0px;">
                                            <div style="text-transform: uppercase;"><strong>{{ $tahsin->nama_pengajar }}</strong></div>
                                            <div class="small text-muted">
                                                {{ $tahsin->jenis_peserta }}<br>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $first  = $pencarian->firstItem();
                                    $end    = $key + $pencarian->firstItem();
                                    @endphp
                                    @endforeach
                                </section>
                            </div>
                        </div>
                    </div>
{{--
                    <div class="row" style="padding-top:10px">
                        <div class="col-7">
                            <div class="float-left" style="padding-left:10px">
                                {!! $first !!} - {!! $end !!} Dari {!! $pencarian->total() !!} Data
                            </div>
                        </div><!--col-->

                        <div class="col-5">
                            <div class="float-right" style="padding-right:10px">
                                {!! $pencarian->appends(request()->query())->links() !!}
                            </div>
                        </div><!--col-->
                    </div><!--row--> --}}

					<div class="row">
						<div class="col">
							<div class="text-center">
								{{-- {!! $socialiteLinks !!} --}}
							</div>
						</div><!--col-->
					</div><!--row-->
				</div><!--card body-->
            </div><!--card-->
            {{-- <center style="color: #fff">Ar-Rahmah Balikpapan &copy; {{ date('Y') }}</center> --}}

		</div><!-- col-md-8 -->
	</div><!-- row -->
@endsection
