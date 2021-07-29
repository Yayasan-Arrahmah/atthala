@extends('frontend.layouts.guest')

@section('title', app_name() . ' | Pendaftaran')

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col col-sm-12 align-self-center">
        <div class="card">
            <center>
                <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150" alt="arrahmah">
                <div style="padding-top: 0px">
                    <h4>Pendaftaran Peserta Tahsin <br> Telah Ditutup</h4>
                    <div class="text-muted">
                        Angkatan 18
                    </div>
                </div>
            </center>
        </div>
    </div>
</div>
@endsection
