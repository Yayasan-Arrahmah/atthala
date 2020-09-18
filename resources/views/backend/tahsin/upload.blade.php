@extends('backend.layouts.app')

@section('title', app_name() . ' | Upload Data' )

@section('breadcrumb-links')
@include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')

<div class="card" >
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Upload Peserta <small class="text-muted">Wajib Dipilih Jenis Peserta & Angkatan</small>
                </h4>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <form onmouseover="verifikasi()" class="form-horizontal col-md-12" action="{{ route('admin.tahsins.import') }}" method="POST" enctype="multipart/form-data" style="padding-top: 20px">
                <div class="form-group row" style="margin-bottom:0px">
                    {{ csrf_field() }}
                    <label class="col-md-1 col-form-label" for="file-input">
                        Pilih File  :
                    </label>
                    <div class="col-md-5">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="upload" required>
                            <label class="custom-file-label" for="upload">Pilih File</label>
                        </div>
                    </div>
                    <div class="col">
                        <select id="jenis" name="jenispeserta" class="form-control" onchange="verifikasi()" required>
                            <option value=" ">Pilih Jenis Peserta</option>
                            <option value="IKHWAN">IKHWAN</option>
                            <option value="AKHWAT">AKHWAT</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id="angkatan" name="angkatanpeserta" class="form-control" onchange="verifikasi()" required>
                            <option value=" ">Pilih Angkatan</option>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button id="btnupload" type="submit" class="btn btn-primary btn-block" >Upload File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>
<div class="card" >
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Upload Pembayaran
                </h4>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <form class="form-horizontal col-md-12" action="{{ route('admin.tahsins.importPembayaran') }}" method="POST" enctype="multipart/form-data" style="padding-top: 20px">
                <div class="form-group row" style="margin-bottom:0px">
                    {{ csrf_field() }}
                    <label class="col-md-1 col-form-label" for="file-input">
                        Pilih File  :
                    </label>
                    <div class="col">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="upload" required>
                            <label class="custom-file-label" for="upload">Pilih File</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button id="btnupload" type="submit" class="btn btn-primary btn-block" >Upload File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function verifikasi() {
	    var btn = document.getElementById("btnupload");
        if (document.getElementById("angkatan").value===" " || document.getElementById("jenis").value===" ") {
            btn.disabled = true;
        } else {
            btn.disabled = false;
        }
    }
</script>

@endsection
