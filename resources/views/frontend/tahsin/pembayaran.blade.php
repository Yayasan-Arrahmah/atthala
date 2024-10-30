@extends('frontend.layouts.guest')

@section('title', app_name() . ' | Pendaftaran')

@section('content')
@stack('before-styles')
<link rel="stylesheet" type="text/css" href="/filepond/app.css">
@stack('after-styles')
{{-- {{ $sesibayar }} --}}
        <form action="{{ route('frontend.tahsin.pembayaransimpan') }}" onsubmit="return checkForm(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
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
                            <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150" alt="Arrahmah">
                        </center>
                        <div class="text-center">
                            <h4> Pembayaran SPP Tahsin </h4>
                            {{-- <div class="text-muted">Angkatan {{ session('daftar_ulang_angkatan_tahsin') }}</div> --}}
                            <div class="text-muted">Angkatan {{ request('angkatan') }}</div>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-6">
                                    <label class="form-control-label">Nomor / ID Tahsin</label>
                                </div>
                                <div class="col-6">
                                    <input hidden name="id" type="text" value="{{ $peserta->id }}">
                                    <input hidden name="notahsin" type="text" value="{{ $peserta->no_tahsin }}">
                                    <input disabled class="form-control" type="text" placeholder="No Tahsin" value="{{ $peserta->no_tahsin }}" maxlength="191" required="">
                                </div><!--col-->
                            </div>
                            <div class="form-group row">
                                <div class="col-2">
                                    <label class="form-control-label">Nama</label>
                                </div>
                                <div class="col-10">
                                    <input disabled  onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" placeholder="Nama Peserta (Sesuai KTP)" name="namapeserta" value="{{ strtoupper($peserta->nama_peserta) }}" maxlength="191" required="">
                                </div><!--col-->
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label class="form-control-label">No. HP</label>
                                </div>
                                <div class="col-8">
                                    <input disabled  onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" placeholder="Nama Peserta (Sesuai KTP)" name="nohppeserta" value="{{ strtoupper($peserta->nohp_peserta) }}" maxlength="191" required="">
                                </div><!--col-->
                                <div class="col text-muted">Silakan menghubungi admin jika no WA telah diganti</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-5">
                                    <label class="form-control-label">Jenis Peserta</label>
                                </div>
                                <div class="col-7">
                                    <select name="jenis_peserta" class="gender form-control" disabled>
                                        <option value="{{ $peserta->jenis_peserta }}">{{ $peserta->jenis_peserta }}</option>
                                    </select>
                                </div><!--col-->
                            </div>
                            <div class="form-group row">
                                <div class="col-5">
                                    <label class="form-control-label">Level Tahsin</label>
                                </div>
                                <div class="col-7">
                                    <input disabled  onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" placeholder="Kenaikan Level Tahsin" name="levelpeserta" value="{{ $peserta->level_peserta }}" maxlength="191" required="">
                                </div><!--col-->
                            </div>
                            <div class="form-group row">
                                <div class="col-5">
                                    <label class="form-control-label">Tanggal Lahir</label>
                                </div>
                                <div class="col-7">
                                    <input disabled  onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" placeholder="Kenaikan Level Tahsin" name="tglpeserta" value="{{ $peserta->waktu_lahir_peserta }}" maxlength="191" required="">
                                </div><!--col-->
                            </div>

                            <div id="ikhwan-rek" class="form-group row">
                                <div class="col-md-12 table-responsive">
                                    <div class="alert alert-success" role="alert" style="margin-bottom: 0rem">
                                        <h4 class="alert-heading">Rekening Pembayaran (IKHWAN)</h4>
                                        <p>
                                            <div><strong>Bank Syariah Indonesia</strong> : 4550 0000 15</div>
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
                                            <div><strong>Bank Syariah Indonesia</strong> : 7009 9997 05</div>
                                            <div><strong>A.N</strong> : Yayasan Arrahmah</div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4 col-form-label">Pembayaran Ke-</label>
                                <div class="col-6 col-form-label">
                                    @foreach ($dataperiode as $data)
                                        @if ($data['status'] == 1)
                                            <div class="border border-success rounded p-1 mb-1">
                                                <input
                                                    class   ="btn-check float-left mr-2 ml-2"
                                                    type    ="checkbox"
                                                    checked
                                                    disabled
                                                    style   ="margin-top: 6px;" >
                                                <label for="nominal{{ $data['id'] }}" class="btn p-0 text-left btn-sm btn-block text-success" style="font-weight: 500;margin: 3px 0 0 0;"> {{ $data['ket'] }} </label>
                                            </div>
                                        @else
                                            <div class="border border-danger rounded p-1 mb-1">
                                                <input onclick ="hitung()"
                                                    id      ="nominal{{ $data['id'] }}"
                                                    class   ="btn-check float-left mr-2 ml-2"
                                                    type    ="checkbox"
                                                    name    ="pembayaran[]"
                                                    value   ="{{ $data['id'] }}"
                                                    style   ="margin-top: 6px;" >
                                                <label for="nominal{{ $data['id'] }}" class="btn p-0 text-left btn-sm btn-block text-danger" style="font-weight: 500;margin: 3px 0 0 0;"> {{ $data['ket'] }} </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                {{-- perebahan pertama, 2 kolom --}}
                                {{-- <div class="col-4 col-form-label">
                                    <div class="form-check checkbox">
                                        <input class="form-check-input" type="checkbox" onclick="hitung()" id="nominal1" value="1" checked disabled>
                                        <label class="form-check-label text-success">JUN 2023</label>
                                    </div>
                                    <div class="form-check checkbox">
                                        <input class="form-check-input" type="checkbox" onclick="hitung()" id="nominal2" value="2" checked disabled>
                                        <label class="form-check-label text-success">JUL 2023</label>
                                    </div>
                                </div>
                                <div class="col-4 col-form-label">
                                    <div class="form-check checkbox">
                                        <input class="form-check-input" type="checkbox" onclick="hitung()" id="nominal3" name="pembayaran[]" value="3">
                                        <label class="form-check-label text-danger">AGU 2023</label>
                                    </div>
                                    <div class="form-check checkbox">
                                        <input class="form-check-input" type="checkbox" onclick="hitung()" id="nominal4" name="pembayaran[]" value="4">
                                        <label class="form-check-label text-danger">SEP 2023</label>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-5 form-control-label" >Kode Unik</label>
                                <div class="col-7">
                                    <input type="text" class="form-control"
                                    maxlength="4" placeholder="Kode Unik"
                                    value="{{ $peserta->kode_unik ?? 0 }}"
                                    style="background-color: white;
                                            border: 0px;
                                            text-align: end;
                                            font-weight: 600;"
                                    readonly>
                                </div><!--col-->
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-5 form-control-label" >Donasi</label>
                                <div class="col-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Rp
                                            </span>
                                        </div>
                                        <input type="number" autocomplete="off" onkeydown="hitung()" oninput="hitung()" value="{{ old('donasi') }}" id="donasi" class="form-control" maxlength="12" placeholder="0">
                                    </div><!--form-group-->
                                    {{-- <input class="form-control" type="number" name="nohp_peserta" placeholder="No. HP Peserta (Whatsapp)" maxlength="15" required=""> --}}
                                </div><!--col-->
                            </div>
                            <div class="form-group row col-12" style="font-size: 18px;">
                                <label class="col-5 form-control-label">Total Transfer</label>
                                <div class="col-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                            style="background-color: white;
                                            border: 0px;
                                            font-weight: 600;">
                                                Rp
                                            </span>
                                        </div>
                                        <input type="text" id="totalnominal" name="nominaltf"
                                            value="{{ old('nominaltf') ?? 0 }}" oninvalid="setCustomValidity('Nominal Transfer')" onchange="try{setCustomValidity('')}catch(e){}"
                                            class="form-control" maxlength="12" placeholder="0"
                                            style="background-color: white;
                                            border: 0px;
                                            text-align: end;
                                            font-size: 18px;
                                            font-weight: 900;"
                                            readonly>

                                    </div><!--form-group-->
                                    <div class="input-group-append text-right">
                                        <button class="btn btn-outline-secondary btn-sm btn-block" type="button" onclick="copyTotalNominal()">Copy Total Transfer</button>
                                    </div>
                                </div><!--col-->

                                <script>
                                    function copyTotalNominal() {
                                        var copyText = document.getElementById("totalnominal");
                                        copyText.select();
                                        document.execCommand("copy");
                                        alert("Berhasil menyalin Total Transfer: " + copyText.value);
                                    }
                                </script>
                            </div>
                            <hr>
                            <div id="bukti-tf" class="form-group row">
                                <label class="col-4 form-control-label" >Bukti Transfer</label>
                                <div class="col-8">
                                    <input type="file" class="upload-buktitransfer" accept="image/png, image/jpeg" required/>
                                </div><!--col-->
                                <div class="form-group row col-12">
                                    <div class="col text-muted">
                                        Mohon Transfer sesuai dengan nominal yang tertera terlebih dahulu. Kemudian klik 'Pembayaran Selesai'.
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col-12">
                                    <p class="text-muted" style="font-weight: 700; text-align:justify">
                                        Kami merubah dari kode BBTT menjadi Kode Unik.
                                        Mohon maaf atas pembaruan ini.
                                        Kami selalu berusaha menyajikan pelayanan yang terbaik.
                                        <br><br>
                                        Terima kasih atas perhatiannya. Semoga Allah Subhanahu Wa Ta'ala memberikan kelancaran dalam kegiatan belajar tahsin saudara.
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <input oninvalid="setCustomValidity('Centang Terlebih Dahulu')" onchange="try{setCustomValidity('')}catch(e){}" id="setuju" type="checkbox" value="" required/> <label style="margin-bottom: 2px">Data yang diisi sudah benar.</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 clearfix">
                                        {{-- {{ form_submit(__('labels.frontend.auth.register_button')) }} --}}
                                        <button type="submit" class="btn btn-primary px-4 btn-block" style="background-color: rgb(83, 163, 28); border: rgb(83, 163, 28);">Pembayaran Selesai <i class="fas fa-check"></i></button>
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
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
        <script src="/filepond/app.js"></script>
        <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                    $("#tgllahir").val("{!! $peserta->waktu_lahir_peserta != null ? \Carbon\Carbon::create($peserta->waktu_lahir_peserta)->format('d') : '' !!}");
                    $("#blnlahir").val("{!! $peserta->waktu_lahir_peserta != null ? \Carbon\Carbon::create($peserta->waktu_lahir_peserta)->format('m') : '' !!}");
                    $("#thnlahir").val("{!! $peserta->waktu_lahir_peserta != null ? \Carbon\Carbon::create($peserta->waktu_lahir_peserta)->format('Y') : '' !!}");
            });
        </script>
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

                    $('.upload-buktitransfer').filepond({
                        labelIdle: '<span class="filepond--label-action">Pilih File/Foto Bukti Transfer</span>',
                        allowMultiple: false,
                        acceptedFileTypes: ['image/*'],
                        allowFileSizeValidation: true,
                        maxFileSize: '10MB',
                        server: {
                            url: '/tahsin/pembayaran/uploadbuktitransferspp',
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
                            $("#admin-akhwat").hide();
                            $("#ikhwan").show();
                            $("#ikhwan-rek").show();
                            $("#admin-ikhwan").show();
                        } else if (optionValue === "AKHWAT") {
                            $("#akhwat").show();
                            $("#akhwat-rek").show();
                            $("#admin-akhwat").show();
                            $("#ikhwan").hide();
                            $("#ikhwan-rek").hide();
                            $("#admin-ikhwan").hide();
                        }
                    });
                }).change();

                $(".buktitf").change(function(){
                    $(this).find("option:selected").each(function(){
                        var optionValue = $(this).attr("value");
                        if(optionValue === "SUDAH"){
                            $("#bukti-tf").show();
                            $("#non-bukti-tf").hide();
                        } else if (optionValue === "BELUM") {
                            $("#bukti-tf").hide();
                            $("#non-bukti-tf").show();
                        }
                    });
                }).change();
            });

        </script>

        <script>
            function hitung(){
                var checkboxes = document.querySelectorAll('input[type=checkbox][name="pembayaran[]"]');
                var spp = 0;
                checkboxes.forEach(function(checkbox, index) {
                    if (checkbox.checked) {
                        spp = index + 1;
                        for (let i = 0; i <= index; i++) {
                            checkboxes[i].checked = true;
                        }
                    }
                });

                var totalspp = 100000 * spp;
                var kodeunik = '{!! $peserta->kode_unik ?? 0 !!}';
                var kdu = Number(kodeunik.replace(/^0+/, ''));
                var totalnominal = totalspp + kdu;
                var donasi = document.getElementById("donasi").value;
                var totaltf = totalnominal + Number(donasi);

                if (spp == 0 && donasi == 0) {
                    document.getElementById("totalnominal").value = 0;
                } else {
                    document.getElementById("totalnominal").value = totaltf;
                }
            }
        </script>

@stack('after-scripts')

@stack('before-scripts')
    <script>
        window.addEventListener( "pageshow", function ( event ) {
        var historyTraversal = event.persisted ||
                                ( typeof window.performance != "undefined" &&
                                    window.performance.navigation.type === 2 );
        if ( historyTraversal ) {
            // Handle page restore.
            window.location.reload();
        }
        });
    </script>
@stack('after-scripts')

@endsection
