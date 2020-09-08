@extends('frontend.layouts.guest')

@section('title', app_name() . ' | Ekonomi')

@section('content')
@stack('before-styles')
<link rel="stylesheet" type="text/css" href="/filepond/app.css">
<style>
    hr {
        margin: 0.5rem
    }
    .form-group {
        margin-bottom: 0.5rem;
    }
    </style>
@stack('after-styles')
{{-- {{ $sesidaftar }} --}}
@if ( \Carbon\Carbon::now()->format('d') > 20)
    <div class="row justify-content-center align-items-center mt-4" >
        <div class="col col-sm-5 align-self-center">
            <div class="card">
                @csrf
                <center>
                    <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="150" alt="Arrahmah" style="padding-top: 20px">
                </center>
                <div class="text-center">
                    <h4> Form Pemesanan Sembako </h4>
                    <div class="text-muted">DIVISI EKONOMI</div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert" style="margin-bottom: 2rem">
                                <h5 class="alert-heading">Form Pemesanan Ditutup</h5>
                                <p>Dibuka lagi Di Bulan Berikutnya</p>
                            </div>
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 table-responsive">
                            <div class="alert alert-success" role="alert" style="margin-bottom: 0rem">
                                <h4 class="alert-heading">INFORMASI</h4>
                                <p>
                                    <div><strong>Kontak</strong> : 0813-2044-1672 (Pak Hakim)</div>
                                    <div><strong>Lokasi</strong> : Perumahan Spinggan Pratama Blok D2 No. 10</div>
                                </p>
                                <hr>
                                <h5 class="alert-heading">Catatan :</h5>
                                <p>
                                    Layanan ini aktif setiap bulannya.
                                </p>
                                <table>
                                    <thead>
                                        <th width="100" class="text-center">Tanggal</th>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><strong>1 - 20</strong></td>
                                            <td>:</td>
                                            <td>Pemesanan</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>21 - 25</strong></td>
                                            <td>:</td>
                                            <td>Belanja Sesuai Pesanan</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>26 - 30</strong></td>
                                            <td>:</td>
                                            <td>Pesanan Dapat Diambil</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <h5 class="alert-heading">Pembayaran :</h5>
                                <p>
                                    <div><strong>KARYAWAN/ASATIDZ</strong> : Pemotongan Kafalah</div>
                                    <div><strong>BUKAN KARYAWAN/ASATIDZ</strong> : Transfer. Kontak Nomor diatas.</div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0 clearfix">
                                {{-- {{ form_submit(__('labels.frontend.auth.register_button')) }} --}}
                                <button type="submit" class="btn btn-primary px-4 btn-block" style="background-color: rgb(83, 163, 28); border: rgb(83, 163, 28);">Daftar</button>
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <div class="text-left">
                                {{-- <a href="{{ route('frontend.auth.login') }}" style="color: rgb(83, 163, 28);">
                                    <i class="fas fa-angle-double-left"></i> Login
                                </a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                            </div>
                        </div><!--/ .col -->
                    </div><!-- / .row -->

                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-md-8 -->
    </div><!-- row -->
@elseif($status == 'selesai')
<div class="row justify-content-center align-items-center mt-4" >
    <div class="col col-sm-5 align-self-center">
        <div class="card">
            @csrf
            <center>
                <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="150" alt="Arrahmah" style="padding-top: 20px">
            </center>
            <div class="text-center">
                <h4> Form Pemesanan Sembako </h4>
                <div class="text-muted">DIVISI EKONOMI</div>
            </div>

            <div class="card-body">
                <hr>
                <div class="form-group row">
                    <div class="col-md-12 table-responsive">
                        <div class="alert alert-success" role="alert" style="margin-bottom: 0rem">
                            <h4 class="alert-heading">INFORMASI</h4>
                            <p>
                                <div><strong>Kontak</strong> : 0813-2044-1672 (Pak Hakim)</div>
                                <div><strong>Lokasi</strong> : Perumahan Spinggan Pratama Blok D2 No. 10</div>
                            </p>
                            <hr>
                            <h5 class="alert-heading">Catatan :</h5>
                            <p>
                                Layanan ini aktif setiap bulannya.
                            </p>
                            <table>
                                <thead>
                                    <th width="100" class="text-center">Tanggal</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><strong>1 - 20</strong></td>
                                        <td>:</td>
                                        <td>Pemesanan</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><strong>21 - 25</strong></td>
                                        <td>:</td>
                                        <td>Belanja Sesuai Pesanan</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><strong>26 - 30</strong></td>
                                        <td>:</td>
                                        <td>Pesanan Dapat Diambil</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <h5 class="alert-heading">Pembayaran :</h5>
                            <p>
                                <div><strong>KARYAWAN/ASATIDZ</strong> : Pemotongan Kafalah</div>
                                <div><strong>BUKAN KARYAWAN/ASATIDZ</strong> : Transfer. Kontak Nomor diatas.</div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-0 clearfix">
                            {{-- {{ form_submit(__('labels.frontend.auth.register_button')) }} --}}
                            <button type="submit" class="btn btn-primary px-4 btn-block" style="background-color: rgb(83, 163, 28); border: rgb(83, 163, 28);">Daftar</button>
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row" style="padding-top: 10px">
                    <div class="col">
                        <div class="text-left">
                            {{-- <a href="{{ route('frontend.auth.login') }}" style="color: rgb(83, 163, 28);">
                                <i class="fas fa-angle-double-left"></i> Login
                            </a> --}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="text-center">
                        </div>
                    </div><!--/ .col -->
                </div><!-- / .row -->

            </div><!-- card-body -->
        </div><!-- card -->
    </div><!-- col-md-8 -->
</div><!-- row -->
@else
<form action="{{ route('frontend.sembakosimpan') }}" onsubmit="return checkForm(this);" method="post">
    <div class="row justify-content-center align-items-center mt-4" >
        <div class="col col-sm-5 align-self-center">
            <div class="card">
                @csrf
                <center>
                    <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="150" alt="Arrahmah" style="padding-top: 20px">
                </center>
                <div class="text-center">
                    <h4> Form Pemesanan Sembako </h4>
                    <div class="text-muted">DIVISI EKONOMI</div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" text-center text-muted text-sm" style="font-size: 10px; font-weight: 700">Tanggal Hari ini : {{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
                        </div><!--col-->
                    </div>
                    <div class="form-group row pb-3">
                        <div class="col-md-12">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="{{ old('nama') }}" type="text" name="nama" placeholder="Nama Lengkap" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="text-muted" style="font-size: 10px; font-weight: 700">Tidak Pakai Angka 0 . Contoh : 81234563789</div>
                            <div class="input-group pb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        +62
                                    </span>
                                </div>
                                <input id="notelp" type="number" name="notelp" value="{{ old('notelp') }}" class="form-control" maxlength="12" placeholder="No. HP WhatsApp" required="">
                            </div><!--form-group-->
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <select name="status" class="gender form-control" required>
                                <option value="1">KARYAWAN/ASATIDZ Ar-Rahmah</option>
                                <option value="2">BUKAN KARYAWAN/ASATIDZ Ar-Rahmah</option>
                            </select>
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-6 form-control-label" >
                            Beras Mawar 5 Kg
                            <div class="text-muted">Rp. 62.000</div>
                        </label>
                        <div class="col-3">
                            <select name="beras" class="form-control">
                                @for ($i = 0; $i < 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div><!--col-->
                        <div class="col-3 form-control-label">Paket</div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-6 form-control-label" >
                            Minyak SIFF 2 Liter
                            <div class="text-muted">Rp. 27.000</div>
                        </label>
                        <div class="col-3">
                            <select name="minyak" class="form-control">
                                @for ($i = 0; $i < 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div><!--col-->
                        <div class="col-3 form-control-label">Paket</div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-6 form-control-label" >
                            Telur 1 Piring
                            <div class="text-muted">Rp. 50.000</div>
                        </label>
                        <div class="col-3">
                            <select name="telur" class="form-control">
                                @for ($i = 0; $i < 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div><!--col-->
                        <div class="col-3 form-control-label">Paket</div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-6 form-control-label" >
                            Gula 1 Kilo
                            <div class="text-muted">Rp. 14.000</div>
                        </label>
                        <div class="col-3">
                            <select name="gula" class="form-control">
                                @for ($i = 0; $i < 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div><!--col-->
                        <div class="col-3 form-control-label">Paket</div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 table-responsive">
                            <div class="alert alert-success" role="alert" style="margin-bottom: 0rem">
                                <h4 class="alert-heading">INFORMASI</h4>
                                <p>
                                    <div><strong>Kontak</strong> : 0813-2044-1672 (Pak Hakim)</div>
                                    <div><strong>Lokasi</strong> : Perumahan Spinggan Pratama Blok D2 No. 10</div>
                                </p>
                                <hr>
                                <h5 class="alert-heading">Catatan :</h5>
                                <p>
                                    Layanan ini aktif setiap bulannya.
                                </p>
                                <table>
                                    <thead>
                                        <th width="100" class="text-center">Tanggal</th>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><strong>1 - 20</strong></td>
                                            <td>:</td>
                                            <td>Pemesanan</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>21 - 25</strong></td>
                                            <td>:</td>
                                            <td>Belanja Sesuai Pesanan</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>26 - 30</strong></td>
                                            <td>:</td>
                                            <td>Pesanan Dapat Diambil</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <h5 class="alert-heading">Pembayaran :</h5>
                                <p>
                                    <div><strong>KARYAWAN/ASATIDZ</strong> : Pemotongan Kafalah</div>
                                    <div><strong>BUKAN KARYAWAN/ASATIDZ</strong> : Transfer. Kontak Nomor diatas.</div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0 clearfix">
                                {{-- {{ form_submit(__('labels.frontend.auth.register_button')) }} --}}
                                <button type="submit" class="btn btn-primary px-4 btn-block" style="background-color: rgb(83, 163, 28); border: rgb(83, 163, 28);">Daftar</button>
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <div class="text-left">
                                {{-- <a href="{{ route('frontend.auth.login') }}" style="color: rgb(83, 163, 28);">
                                    <i class="fas fa-angle-double-left"></i> Login
                                </a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                            </div>
                        </div><!--/ .col -->
                    </div><!-- / .row -->

                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-md-8 -->
    </div><!-- row -->
</form>
@endif

@stack('before-scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });

    $(document).ready(function(){
        $(".gender").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue === "IKHWAN"){
                    $("#akhwat").hide();
                    $("#akhwat-rek").hide();
                    $("#ikhwan").show();
                    $("#ikhwan-rek").show();
                } else if (optionValue === "AKHWAT") {
                    $("#akhwat").show();
                    $("#akhwat-rek").show();
                    $("#ikhwan").hide();
                    $("#ikhwan-rek").hide();
                }
            });
        }).change();
    });
</script>
@stack('after-scripts')
@endsection
