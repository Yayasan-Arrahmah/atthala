@extends('frontend.user.layout')

@section('user')
@stack('after-styles')
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css') }}
    <style>
        .flickity-prev-next-button {
            width: 18px;
            height: 18px;
        }
        .flickity-page-dots .dot {
            width: 5px;
            height: 5px;
        }
        .flickity-page-dots {
            bottom: 10px;
        }
    </style>
@stack('before-styles')

@stack('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
@stack('before-scripts')

<div class="row">
    <div class="col-12 mb-4">
        <div class="font-weight-bold big">
            Ahlan wa Sahlan, {{ auth()->user()->first_name }}
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="js-flickity"
        data-flickity-options='{ "wrapAround": false, "autoPlay": 3000 }'>
        <div class="col-11 p-1">
            <div class="card" style="background: url('{{ asset('img/frontend/web-slide-1.png') }}') no-repeat center; background-size: cover;">
                <div class="card-body d-flex align-items-center" >
                    <div style="height: 150px;">
                        <a href="https://web.arrahmahbalikpapan.or.id/protokol-kesehatan-lttq-ar-rahmah-balikpapan/" target="_blank">
                            <div style="font-size: 20px; font-weight:800; color: #fff; position: absolute; bottom: 10px; width: 80%;" >
                                PROTOKOL KESEHATAN <br> LTTQ ARRAHMAH
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-11 p-1">
            <div class="card" style="background: url('{{ asset('img/frontend/web-slide-2.png') }}') no-repeat center; background-size: cover;">
                <div class="card-body d-flex align-items-center" >
                    <div style="height: 150px;">
                        <a href="https://www.instagram.com/p/CCkshZhp6dc/" target="_blank">
                            <div style="font-size: 20px; font-weight:800; color: #fff; position: absolute; bottom: 10px; width: 80%;" >
                                PENDAFTARAN SANTRI <br> RAUDHOTUL QURAN
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-11 p-1">
            <div class="card" style="background: url('{{ asset('img/frontend/web-slide-3.png') }}') no-repeat center; background-size: cover;">
                <div class="card-body d-flex align-items-center" >
                    <div style="height: 150px;">
                        <a href="{{ route('frontend.user.absentahsin') }}">
                            <a href="https://web.arrahmahbalikpapan.or.id/donasi/" target="_blank">
                                <div style="font-size: 20px; font-weight:800; color: #fff; position: absolute; bottom: 10px; width: 80%;" >
                                    DONASI LEMBAGA<br> TAHSIN TAHFIDZ QURAN ARRAHMAH
                                </div>
                            </a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="row">

@if (auth()->user()->last_name == 'PENGAJAR')
    @if (auth()->user()->status == 'PENGUJI')
        <div class="col-xs-12 col-md-6">
            <div class="card" style="margin-bottom: .3rem">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-edit p-3 px-2 font-1xl mr-3" style="border-radius: 5px 0px 0px 5px; background-color: #a220d8; color: #fff"></i>
                    <div>
                        <a href="{{ route('frontend.user.pesertatahsinbaru') }}">
                            <div class="text-value-sm" style="color: #a220d8">Pendaftaran Baru</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Tahsin </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-xs-12 col-md-6">
        <div class="card" style="margin-bottom: .3rem">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-edit bg-primary p-3 px-2 font-1xl mr-3" style="border-radius: 5px 0px 0px 5px"></i>
                <div>
                    <a href="{{ route('frontend.user.absentahsin') }}">
                        <div class="text-value-sm text-primary">Absensi</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Tahsin </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="card" style="margin-bottom: .3rem">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-users bg-secondary p-3 px-2 font-1xl mr-3" style="border-radius: 5px 0px 0px 5px"></i>
                <div>
                    <a href="{{ route('frontend.user.tahsinpeserta') }}">
                        <div class="text-value-sm text-dark">Data Peserta</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Tahsin</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="card" style="margin-bottom: .3rem">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-th-list bg-danger p-3 px-2 font-1xl mr-3" style="border-radius: 5px 0px 0px 5px"></i>
                <div>
                    <a href="{{ route('frontend.user.jadwaltahsin') }}">
                        <div class="text-value-sm text-danger">Jadwal</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Tahsin </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="card" style="margin-bottom: .3rem">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-tasks bg-dark p-3 px-2 font-1xl mr-3" style="border-radius: 5px 0px 0px 5px"></i>
                <div>
                    <a href="{{ route('frontend.user.amal-yaumiah.peserta') }}">
                        <div class="text-value-sm text-dark">Peserta Amal Yaumiah</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Melihat Amalan Harian Peserta</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
    <div class="col-xs-12 col-md-6">
        <div class="card" style="margin-bottom: .3rem">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-tasks bg-success p-3 px-2 font-1xl mr-3" style="border-radius: 5px 0px 0px 5px"></i>
                <div>
                    <a href="{{ route('frontend.user.amal-yaumiah') }}">
                        <div class="text-value-sm text-success">Amal Yaumiah</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Amalan Harian</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="card" style="margin-bottom: .3rem">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-user bg-warning p-3 px-2 font-1xl mr-3" style="border-radius: 5px 0px 0px 5px"></i>
                <div>
                    <a href="{{ route('frontend.user.account') }}">
                        <div class="text-value-sm text-warning">Akun</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Info</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
