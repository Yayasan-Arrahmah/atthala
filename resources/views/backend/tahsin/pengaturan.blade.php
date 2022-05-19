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
                    Pengaturan Tahsin - {{ html()->tahsin() }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
            </div><!--col-->
        </div><!--row-->
    </div>
</div><!--card-->
<div class="row">
    @foreach ($data as $pengaturan)
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5>
                                {{ $pengaturan->nama_pengaturan }} - {{ $pengaturan->fungsi_pengaturan }}
                            </h5>
                            <hr>
                        </div>
                        <form accept="" class="col-12">
                            @csrf
                            <input type="hidden" name="id" value="{{ $pengaturan->id }}">
                            <input type="hidden" name="metode" value="update">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    Angkatan
                                </label>
                                <div class="col-md-4">
                                    <input name="angkatan" type="number" value="{{ $pengaturan->angkatan_pengaturan }}" name="file" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    Status
                                </label>
                                <div class="col-md-4">
                                    <select name="status" class="form-control" id="{{ $pengaturan->jenis_pengaturan.$pengaturan->id }}">
                                        <option value="1">DIBUKA</option>
                                        <option value="2">DITUTUP</option>
                                        <option value="3">MENGALAMI KENDALA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    Link
                                </label>
                                <div class="col-md-9 col-form-label">
                                    {{ $pengaturan->link_pengaturan }}
                                    <a   href="{{ $pengaturan->link_pengaturan }}" target="_blank">
                                        <i class="fas fa-arrow-right" style="font-size: 15px"></i>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                    $("#{!! $pengaturan->jenis_pengaturan.$pengaturan->id !!}").val("{!! $pengaturan->status_pengaturan !!}");
            });
        </script>
    @endforeach
</div>

@endsection
