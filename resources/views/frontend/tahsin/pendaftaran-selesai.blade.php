@extends('frontend.layouts.guest')

@section('title', app_name() . ' | Pendaftaran')

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col col-sm-5 align-self-center">
        <div class="card">
            @csrf
            <center>
                <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="150" alt="Arrahmah" style="padding-top: 20px">
            </center>

            @if ($info == "berhasil")
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Pendataran Berhasil !</h4>
                        <p>
                            Pendaftaran Telah Selesai. Silahkan download bukti pendaftaran anda. Terima Kasih.
                        </p>
                    </div>
                    <a href="{{ route('frontend.tahsin.print.daftar') }}?id={{ $id }}" target="_blank">
                        <button class="btn btn-info float-right"><i class="fas fa-download" style="padding-right: 15px"></i> Bukti Pendaftaran </button>
                    </a>
                </div>

            @elseif ($info == "gagal")
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Terjadi Kesalahan !</h4>
                        <p>
                            Pendaftaran Gagal. Mohon ulangi form pendaftaran anda. Terima Kasih.
                        </p>
                    </div>
                    <a href="{{ route('frontend.tahsin.pendaftaran') }}">
                        <button class="btn btn-success"><i class="fas fa-arrow-circle-left" style="padding-right: 15px"></i> Ulangi Pendaftaran</button>
                    </a>
                </div>
            @else
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Terjadi Gangguan Server !</h4>
                        <p>
                            Pendataran Gagal. Mohon ulangi form pendaftaran anda. Terima Kasih.
                        </p>
                    </div>
                </div>
            @endif
        </div><!-- card -->
    </div><!-- col-md-8 -->
</div><!-- row -->
@endsection
