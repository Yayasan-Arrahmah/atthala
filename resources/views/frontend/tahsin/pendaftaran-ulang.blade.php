@extends('frontend.layouts.app')

@section('title', app_name() . ' | Pendaftaran')

@section('content')
@stack('before-styles')
<link rel="stylesheet" type="text/css" href="/filepond/app.css">
@stack('after-styles')
{{-- {{ $sesidaftar }} --}}
<form action="{{ route('frontend.tahsin.simpan') }}" onsubmit="return checkForm(this);" method="post" enctype="multipart/form-data">
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-5 align-self-center">
            <div class="card">
                {{-- <div class="card-header">
                    <strong>
                        @lang('labels.frontend.auth.register_box_title')
                    </strong>
                </div><!--card-header--> --}}
                <h1>

                </h1>
                @csrf
                <center>
                    <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="150" alt="Arrahmah" style="padding-top: 20px">
                </center>
                <div class="text-center">
                    <h4> Pendaftaran Tahsin </h4>
                    <div class="text-muted">Angkatan 16</div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="nama_peserta" placeholder="Nama Peserta (Sesuai KTP)" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input class="form-control" type="number" name="nohp_peserta" placeholder="No. HP Peserta (Whatsapp)" maxlength="15" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <select name="jenis_peserta" class="gender form-control" required>
                                <option value="IKHWAN">IKHWAN</option>
                                <option value="AKHWAT">AKHWAT</option>
                            </select>
                        </div><!--col-->
                    </div>
                    <div id="ikhwan">
                        <div class="form-group row">
                            <label class="col-6 form-control-label" >Pilih Jadwal Utama</label>
                            <div class="col-6">
                                <select name="pilih_jadwal_peserta" class="form-control">
                                    <option value="">Pilih...</option>
                                    <option value="SABTU 08.00">SABTU 08.00 WITA</option>
                                    <option value="SABTU 10.00">SABTU 10.00 WITA</option>
                                    <option value="SABTU 13.00">SABTU 13.00 WITA</option>
                                    <option value="SABTU 16.00">SABTU 16.00 WITA</option>
                                    <option value="SABTU 20.00">SABTU 20.00 WITA</option>
                                    <option value="AHAD 08.00">AHAD 08.00 WITA</option>
                                    <option value="AHAD 10.00">AHAD 10.00 WITA</option>
                                    <option value="AHAD 13.00">AHAD 13.00 WITA</option>
                                    <option value="AHAD 16.00">AHAD 16.00 WITA</option>
                                    <option value="AHAD 20.00">AHAD 20.00 WITA</option>
                                    <option value="SENIN 20.00">SENIN - 20.00 WITA</option>
                                    <option value="SELASA 20.00">SELASA - 20.00 WITA</option>
                                    <option value="RABU 20.00">RABU - 20.00 WITA</option>
                                    <option value="KAMIS 20.00">KAMIS - 20.00 WITA</option>
                                    <option value="JUMAT 20.00">JUMAT - 20.00 WITA</option>
                                </select>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            <label class="col-6 form-control-label" >Pilih Jadwal Cadangan 1</label>
                            <div class="col-6">
                                <select name="pilih_jadwal_cadangan_1_peserta" class="form-control">
                                    <option value="">Pilih...</option>
                                    <option value="SABTU 08.00">SABTU 08.00 WITA</option>
                                    <option value="SABTU 10.00">SABTU 10.00 WITA</option>
                                    <option value="SABTU 13.00">SABTU 13.00 WITA</option>
                                    <option value="SABTU 16.00">SABTU 16.00 WITA</option>
                                    <option value="SABTU 20.00">SABTU 20.00 WITA</option>
                                    <option value="AHAD 08.00">AHAD 08.00 WITA</option>
                                    <option value="AHAD 10.00">AHAD 10.00 WITA</option>
                                    <option value="AHAD 13.00">AHAD 13.00 WITA</option>
                                    <option value="AHAD 16.00">AHAD 16.00 WITA</option>
                                    <option value="AHAD 20.00">AHAD 20.00 WITA</option>
                                    <option value="SENIN 20.00">SENIN - 20.00 WITA</option>
                                    <option value="SELASA 20.00">SELASA - 20.00 WITA</option>
                                    <option value="RABU 20.00">RABU - 20.00 WITA</option>
                                    <option value="KAMIS 20.00">KAMIS - 20.00 WITA</option>
                                    <option value="JUMAT 20.00">JUMAT - 20.00 WITA</option>
                                </select>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            <label class="col-6 form-control-label" >Pilih Jadwal Cadangan 2</label>
                            <div class="col-6">
                                <select name="pilih_jadwal_cadangan_2_peserta" class="form-control">
                                    <option value="">Pilih...</option>
                                    <option value="SABTU 08.00">SABTU 08.00 WITA</option>
                                    <option value="SABTU 10.00">SABTU 10.00 WITA</option>
                                    <option value="SABTU 13.00">SABTU 13.00 WITA</option>
                                    <option value="SABTU 16.00">SABTU 16.00 WITA</option>
                                    <option value="SABTU 20.00">SABTU 20.00 WITA</option>
                                    <option value="AHAD 08.00">AHAD 08.00 WITA</option>
                                    <option value="AHAD 10.00">AHAD 10.00 WITA</option>
                                    <option value="AHAD 13.00">AHAD 13.00 WITA</option>
                                    <option value="AHAD 16.00">AHAD 16.00 WITA</option>
                                    <option value="AHAD 20.00">AHAD 20.00 WITA</option>
                                    <option value="SENIN 20.00">SENIN - 20.00 WITA</option>
                                    <option value="SELASA 20.00">SELASA - 20.00 WITA</option>
                                    <option value="RABU 20.00">RABU - 20.00 WITA</option>
                                    <option value="KAMIS 20.00">KAMIS - 20.00 WITA</option>
                                    <option value="JUMAT 20.00">JUMAT - 20.00 WITA</option>
                                </select>
                            </div><!--col-->
                        </div>
                    </div>
                    <div id="akhwat">
                        <div class="form-group row">
                            <label class="col-6 form-control-label" >Pilih Jadwal Utama</label>
                            <div class="col-3" style="padding-right: 2px; padding-left: 2px">
                                <select  name="pilih_jadwal_peserta_hari" class="form-control">
                                    <option value="">Pilih Hari...</option>
                                    <option value="SABTU">SABTU</option>
                                    <option value="AHAD">AHAD</option>
                                    <option value="SENIN">SENIN</option>
                                    <option value="RABU">RABU</option>
                                    <option value="KAMIS">KAMIS</option>
                                    <option value="JUMAT">JUMAT</option>
                                </select>
                            </div><!--col-->
                            <div class="col-3" style="padding-left: 2px">
                                <select  name="pilih_jadwal_peserta_jam" class="form-control">
                                    <option value="">Pilih Jam...</option>
                                    <option value="07.00">07.00 WITA</option>
                                    <option value="08.00">08.00 WITA</option>
                                    <option value="09.00">09.00 WITA</option>
                                    <option value="10.00">10.00 WITA</option>
                                    <option value="13.00">13.00 WITA</option>
                                    <option value="16.00">16.00 WITA</option>
                                </select>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            <label class="col-6 form-control-label" >Pilih Jadwal Cadangan 1</label>
                            <div class="col-3" style="padding-right: 2px; padding-left: 2px">
                                <select  name="pilih_jadwal_cadangan_1_peserta_hari" class="form-control">
                                    <option value="">Pilih Hari...</option>
                                    <option value="SABTU">SABTU</option>
                                    <option value="AHAD">AHAD</option>
                                    <option value="SENIN">SENIN</option>
                                    <option value="RABU">RABU</option>
                                    <option value="KAMIS">KAMIS</option>
                                    <option value="JUMAT">JUMAT</option>
                                </select>
                            </div><!--col-->
                            <div class="col-3" style="padding-left: 2px">
                                <select  name="pilih_jadwal_cadangan_1_peserta_jam" class="form-control">
                                    <option value="">Pilih Jam...</option>
                                    <option value="07.00">07.00 WITA</option>
                                    <option value="08.00">08.00 WITA</option>
                                    <option value="09.00">09.00 WITA</option>
                                    <option value="10.00">10.00 WITA</option>
                                    <option value="13.00">13.00 WITA</option>
                                    <option value="16.00">16.00 WITA</option>
                                </select>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            <label class="col-6 form-control-label" >Pilih Jadwal Cadangan 2</label>
                            <div class="col-3" style="padding-right: 2px; padding-left: 2px">
                                <select  name="pilih_jadwal_cadangan_2_peserta_hari" class="form-control">
                                    <option value="">Pilih Hari...</option>
                                    <option value="SABTU">SABTU</option>
                                    <option value="AHAD">AHAD</option>
                                    <option value="SENIN">SENIN</option>
                                    <option value="RABU">RABU</option>
                                    <option value="KAMIS">KAMIS</option>
                                    <option value="JUMAT">JUMAT</option>
                                </select>
                            </div><!--col-->
                            <div class="col-3" style="padding-left: 2px">
                                <select  name="pilih_jadwal_cadangan_2_peserta_jam" class="form-control">
                                    <option value="">Pilih Jam...</option>
                                    <option value="07.00">07.00 WITA</option>
                                    <option value="08.00">08.00 WITA</option>
                                    <option value="09.00">09.00 WITA</option>
                                    <option value="10.00">10.00 WITA</option>
                                    <option value="13.00">13.00 WITA</option>
                                    <option value="16.00">16.00 WITA</option>
                                </select>
                            </div><!--col-->
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="alamat_peserta" placeholder="Alamat Tinggal"></textarea>
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="pekerjaan_peserta" placeholder="Pekerjaan" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <div class="col-4" style="padding-right: 2px;">
                            <input style="font-size: 11px; height: calc(1.5em + .75rem + 7px)" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="tempat_lahir_peserta" placeholder="Tempat Kelahiran" maxlength="191" required="">
                        </div><!--col-->
                        <div class="col-2" style="padding-right: 2px; padding-left: 2px">
                            <select name="tanggal_lahir" class="gender form-control" required>
                                <option value="">-- Tanggal Lahir --</option>
                                @for ($i = 1; $i < 31; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-3" style="padding-right: 2px; padding-left: 2px">
                            <select name="bulan_lahir" class="gender form-control" required>
                                <option value="">-- Bulan Lahir --</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-3" style="padding-left: 2px">
                            <select name="tahun_lahir" class="gender form-control" required>
                                <option value="">-- Tahun Lahir --</option>
                                @for ($i = 2012; $i > 1950; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 form-control-label" >Foto KTP</label>
                        <div class="col-8">
                            <input type="file" class="upload-ktp"/>
                            {{-- <div class="custom-file">
                                <input class="filestyle custom-file-input" type="file" name="fotoktp_peserta" id="upload-1" required="" data-buttonText="Your label here.">
                                <label class="custom-file-label" id="upload-1-label">Pilih File Foto KTP</label>
                            </div> --}}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-4 form-control-label">Rekaman Tilawah</label>
                        <div class="col-8">
                            <input type="file" class="upload-rekaman"/>
                            {{-- <div class="custom-file">
                                <input class="filestyle custom-file-input" type="file" name="rekaman_peserta" id="upload-2" required="" data-buttonText="Your label here.">
                                <label class="custom-file-label" id="upload-2-label">Pilih File Rekaman Tilawah</label>
                            </div> --}}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-sm table-striped nowarp" style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td>Biaya Pendaftaran & SPP Bulan Pertama <div class="text-muted">Rp. 200.000</div></td>
                                        <td><input id="biaya-daftar" type="checkbox" value="" checked disabled/></td>
                                    </tr>
                                    <tr>
                                        <td>Pembayaran modul dan buku prestasi <div class="text-muted">Rp. 60.000</div></td>
                                        <td><input id="biaya-modul" name="bayar_modul" type="checkbox" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Mushaf Al-Quran Non Terjemah <div class="text-muted">Rp. 110.000</div></td>
                                        <td><input id="biaya-mushaf" name="bayar_mushaf" type="checkbox" value="" /></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="ikhwan-rek" class="form-group row">
                        <div class="col-md-12 table-responsive">
                            <div class="alert alert-success" role="alert" style="margin-bottom: 0rem">
                                <h4 class="alert-heading">Rekening Pembayaran (IKHWAN)</h4>
                                <p>
                                    <div><strong>BNI Syariah</strong> : 4550 0000 15</div>
                                    <div><strong>A.N</strong> : Yayasan Arrahmah</div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="akhwat-rek" class="form-group row">
                        <div class="col-md-12 table-responsive">
                            <div class="alert alert-warning" role="alert" style="margin-bottom: 0rem">
                                <h4 class="alert-heading">Rekening Pembayaran (AKHWAT)</h4>
                                <p>
                                    <div><strong>BNI Syariah</strong> : 7009 9997 05</div>
                                    <div><strong>A.N</strong> : Yayasan Arrahmah</div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 form-control-label" >Bukti Transfer</label>
                        <div class="col-8">
                            <input type="file" class="upload-buktitransfer"/>

                            {{-- <div class="custom-file">
                                <input class="filestyle custom-file-input" type="file" name="bukti_transfer_peserta" id="upload-3" required="" data-buttonText="Your label here.">
                                <label class="custom-file-label" id="upload-3-label">Foto Bukti Transfer</label>
                            </div> --}}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <img class="img-fluid" src="https://lh5.googleusercontent.com/fa9h1brjURoz-uilFI0C881v4VXDR2HJxbOWc4hH7hGdItrftVaU6eWRncRHpcexyq5H6KDwoGAfBNYVLYh_jpSxdl-i4lhbnU1tigImh3SXQlmayuYAtJRk77-g=w675" alt="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-2 text-right">
                            <input id="setuju" type="checkbox" value="" required/>
                        </div>
                        <div class="col-10">
                            <label>Setuju</label>
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
@stack('before-scripts')
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
<script src="/filepond/app.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script>
    $(function(){
        $.fn.filepond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize,
            FilePondPluginImageResize
        );
    });

    $(function(){
            $('.upload-ktp').filepond({
                labelIdle: 'Pilih File/Foto KTP <span class="filepond--label-action">Browse</span>',
                allowMultiple: false,
                acceptedFileTypes: ['image/*'],
                allowFileSizeValidation: true,
                maxFileSize: '10MB',
                allowImageResize: true,
                imageResizeTargetWidth: 100,
                imageResizeTargetHeight: null,
                imageResizeMode: 'cover',
                server: {
                    url: '/tahsin/uploadktp',
                    process: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                }
            });
            $('.upload-rekaman').filepond({
                labelIdle: 'Pilih File/Rekaman Tilawah <span class="filepond--label-action">Browse</span>',
                allowMultiple: false,
                allowFileSizeValidation: true,
                maxFileSize: '15MB',
                server: {
                    url: '/tahsin/uploadrekaman',
                    process: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                }
            });
            $('.upload-buktitransfer').filepond({
                labelIdle: 'Pilih File/Foto Bukti Transfer <span class="filepond--label-action">Browse</span>',
                allowMultiple: false,
                acceptedFileTypes: ['image/*'],
                allowFileSizeValidation: true,
                maxFileSize: '10MB',
                server: {
                    url: '/tahsin/uploadbuktitransfer',
                    process: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                }
            });

        });

</script>

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
