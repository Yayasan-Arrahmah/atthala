@extends('backend.layouts.app-2')

@section('title', app_name() . '| Pengaturan Tahsin')

@section('content')


    <div class="row">
        <div class="col">
            <div class="">
                <h2 class="m-0">
                    Pengaturan Tahsin
                </h2>
                <div class="row m-1 row">
                    <div class="col-12 text-right mb-4 pr-0">
                        <button class="btn btn-primary">
                            Konfigurasi Angkatan <i class="fas fa-cog"></i>
                        </button>
                    </div>
                    @include('backend.pendidikan.tahsin.pengaturan.daftar-baru')
                    @include('backend.pendidikan.tahsin.pengaturan.daftar-baru')
                    @include('backend.pendidikan.tahsin.pengaturan.daftar-baru')
                    @include('backend.pendidikan.tahsin.pengaturan.daftar-baru')
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
