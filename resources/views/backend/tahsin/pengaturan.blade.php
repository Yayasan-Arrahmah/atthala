@extends('backend.layouts.app')

@section('title', app_name() . ' | Peserta ' . __('backend_tahsins.labels.management'))

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Absen Tahsin<small class="text-muted"> - Angkatan 16</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-md-12">
                Pengaturan Tahsin
            </div>
        </div>
    </div>
</div><!--card-->
@endsection
