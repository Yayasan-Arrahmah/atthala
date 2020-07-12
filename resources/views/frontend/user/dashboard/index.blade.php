@extends('frontend.user.layout')

@section('user')
<div class="row" >
    <div class="col-md-12">
        <ol class="breadcrumb" style="padding: .3rem .3rem;">
            <li class="breadcrumb-item active">Dasboard</li>
        </ol>
    </div>
</div>
@if (auth()->user()->last_name == 'PENGAJAR')

<div class="row mb-4">
    <div class="col-12 mb-4">
        <div class="text-center font-weight-bold big">
            Ahlan wa Sahlan, {{ auth()->user()->first_name }}
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-edit bg-primary p-4 px-2 font-2xl mr-3"></i>
                <div>
                    <a href="{{ route('frontend.user.absentahsin') }}">
                        <div class="text-value-sm text-primary">Absensi</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Tahsin - 16</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-tasks bg-success p-4 px-2 font-2xl mr-3"></i>
                <div>
                    <a href="{{ route('frontend.user.amal-yaumiah') }}">
                        <div class="text-value-sm text-success">Amal Yaumiah</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Ramadhan 1441 H</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-th-list bg-danger p-4 px-2 font-2xl mr-3"></i>
                <div>
                    <a href="{{ route('frontend.user.jadwaltahsin') }}">
                        <div class="text-value-sm text-danger">Jadwal</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Tahsin - 16</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="fa fa-user bg-warning p-4 px-2 font-2xl mr-3"></i>
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
@endif

@endsection
