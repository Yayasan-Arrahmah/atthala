@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
	<div class="row justify-content-center align-items-center">
		<div class="col col-sm-12 align-self-center">
			<div class="card">
                <center>
                    <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="150" alt="arrahmah" style="padding-top: 10px">
                    <div style="padding-top: 20px">
                        <h4>Pencarian Peserta Tahsin</h4>
                        <div class="text-muted">
                            Angkatan {{ session('angkatan_tahsin') }}
                        </div>
                    </div>
                </center>
                @include('frontend.includes.cari')
				<div class="card-body">
                    <div class="row mt-4" style=" overflow-x: scroll;">
                        <div class="col" style="min-width: 1000px; ">
                            <div class="table-responsive" style="padding: 0px 15px 15px 15px;">
                                <section>
                                    <div class="row kotak-atas">
                                        {{-- <div class="col-md-1">No</div> --}}
                                        <div class="col">Nama</div>
                                        <div class="col-2">Pengajar</div>
                                        <div class="col-3">Status Pembayaran</div>
                                        <div class="col">Waktu Ujian</div>
                                        <div class="col">Penilaian</div>
                                    </div>
                                    @php
                                    $first  = 0;
                                    $end    = 0;
                                    $number = 1;
                                    @endphp
                                    @foreach($pencarian as $key=> $tahsin)
                                    <div class="row kotak">
                                        {{-- <div class="col-md-1">{{ $key + $pencarian->firstItem() }}</div> --}}
                                        <div class="col">
                                            <a href="/admin/pencarian/{{ $tahsin->id }}" style="color: rgb(56, 56, 56);">
                                                <div style="text-transform: uppercase;"><strong>{{ $tahsin->nama_peserta }}</strong></div>
                                                <div class="small text-muted">
                                                    {{ $tahsin->level_peserta }} | {{ $tahsin->jadwal_tahsin }}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-2" style="margin-left: 0px;">
                                            <div style="text-transform: uppercase;"><strong>{{ $tahsin->nama_pengajar }}</strong></div>
                                            <div class="small text-muted">
                                                {{ $tahsin->jenis_peserta }}<br>
                                            </div>
                                        </div>
                                        <div class="col-3" style="margin-top: 0px">
                                            @php
                                            $totalpembayaran = DB::table('pembayarans')
                                                    ->select(DB::raw('SUM(nominal_pembayaran) as total'))
                                                    ->where('id_peserta', $tahsin->no_tahsin)
                                                    ->first();
                                            @endphp
                                            <div>
                                                <strong>Rp. {{ number_format($totalpembayaran->total, 0, '.', '.') }} </strong> / Rp. 400.000
                                            </div>
                                            <div class="small text-muted text-center">
                                                @if( $totalpembayaran->total < 400000 )
                                                    <label class="badge badge-danger">BELUM LUNAS</label>
                                                @else
                                                    <label class="badge badge-success">LUNAS</label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            -
                                            {{-- <div class="text-center" style="padding-bottom: 5px">
                                                <div class="text-value">0</div>
                                                <div class="text-uppercase text-muted small">Pesan Whatsapp Terkirim</div>
                                            </div>
                                            <button class="btn btn-outline-success btn-pill btn-sm btn-block" >
                                                Tahap Pengembangan
                                            </button> --}}
                                            {{-- <div class="small text-center"> *chat pengingat pembayaran </div> --}}
                                        </div>
                                        <div class="col">
                                            -
                                        </div>
                                        <div class="col-md-12">
                                            <a data-toggle="collapse" href="#detail{{ $key + $pencarian->firstItem() }}" aria-expanded="false" style="padding-left: 15px">Riwayat Pembayaran</a>
                                            {{-- <a data-toggle="collapse" href="#detailwa{{ $key + $pencarian->firstItem() }}" aria-expanded="false" style="padding-left: 35px">Riwayat Pesan WA</a> --}}
                                        </div>
                                        <div class="col-md-12" style="color: #4e4e4e">
                                            <div class="col">
                                                <div class="collapse" id="detail{{ $key + $pencarian->firstItem() }}" >
                                                    <hr>
                                                    <div class="row" style="font-weight: 600; padding-bottom: 10px;">
                                                        <div class="col-1">No</div>
                                                        <div class="col-2">Nominal</div>
                                                        <div class="col-4">Admin</div>
                                                        <div class="col-3">Waktu</div>
                                                    </div>
                                                    @php
                                                    $noriwayat = 1;
                                                    $riwayatpembayaran = DB::table('pembayarans')
                                                            ->select('nominal_pembayaran', 'admin_pembayaran', 'created_at' )
                                                            ->where('id_peserta', $tahsin->no_tahsin)
                                                            ->get();
                                                    @endphp
                                                    @foreach($riwayatpembayaran as $riwayat)
                                                        <div class="row">
                                                            <div class="col-1"> {{ $noriwayat++ }} </div>
                                                            <div class="col-2"> Rp. {{ number_format($riwayat->nominal_pembayaran, 0, '.', '.') }} </div>
                                                            <div class="col-4"> {{ $riwayat->admin_pembayaran }} </div>
                                                            <div class="col-3"> {{ $riwayat->created_at }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="collapse" id="detailwa{{ $key + $pencarian->firstItem() }}" >
                                                    <hr>
                                                    tes WA
                                                </div>
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
            <center style="color: #fff">Ar-Rahmah Balikpapan &copy; {{ date('Y') }}</center>

		</div><!-- col-md-8 -->
	</div><!-- row -->
@endsection
