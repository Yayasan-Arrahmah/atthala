@extends('backend.layouts.app')

@section('title', app_name() . ' | Peserta ' . __('backend_tahsins.labels.management'))

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
{{-- <div class="card">
    @include('backend.tahsin.includes.cari')
</div> --}}

<div class="card">
    @livewire('tahsin.peserta')
</div><!--card-->
@endsection
