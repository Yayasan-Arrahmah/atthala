@extends('frontend.layouts.guest')

@section('title', app_name() . ' | Pendaftaran')

@section('content')
    @stack('before-styles')
    <link rel="stylesheet" type="text/css" href="/filepond/app.css">
    @stack('after-styles')
    {{-- {{ $sesidaftar }} --}}
    @if (is_null($calonpeserta))

        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-5 align-self-center ">
                <div class="card pb-4">
                    @csrf
                    <center>
                        <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150" alt="Arrahmah">
                    </center>
                    <div class="text-center">
                        <h4> Data Tidak Ditemukan </h4>
                        <div class="text-muted">LTTQ Arrahmah Balikpapan</div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if (isset($cekterdaftarujian))
            <div class="row justify-content-center align-items-center">
                <div class="col col-sm-5 align-self-center ">
                    <div class="card pb-4">
                        @csrf
                        <center>
                            <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150"
                                alt="Arrahmah">
                        </center>
                        <div class="text-center">
                            <h4> Peserta Telah Terdaftar </h4>
                            <div class="text-muted">Ujian Tahsin LTTQ Arrahmah Balikpapan Angkatan
                                {{ session('daftar_ujian') }}</div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <a href="/tahsin/calon-peserta-ujian/print?id={{ $cekterdaftarujian->uuid }}"
                                        style="color:white; font-size: 11px" class="btn btn-success">KARTU UJIAN</a>
                                </div>
                                <div class="col">
                                    <div style="text-transform: uppercase;">
                                        <strong>{{ $calonpeserta->nama_peserta }}</strong></div>
                                    <div class="small text-muted">
                                        {{ $calonpeserta->level_peserta }} | {{ $calonpeserta->jadwal_tahsin }}
                                    </div>
                                </div>
                                <div class="col" style="margin-left: 0px;">
                                    <div style="text-transform: uppercase;">
                                        <strong>{{ $calonpeserta->nama_pengajar }}</strong></div>
                                    <div class="small text-muted">
                                        {{ $calonpeserta->jenis_peserta }}<br>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <form action="{{ route('frontend.tahsin.simpancalonpesertaujian') }}" onsubmit="return checkForm(this);"
                method="post" enctype="multipart/form-data">
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
                                <img class="navbar-brand-full" src="{{ asset('img/logo-lttq.jpeg') }}" width="150"
                                    alt="Arrahmah">
                            </center>
                            <div class="text-center">
                                <h4> Formulir <br>Calon Peserta Ujian Tahsin </h4>
                                <div class="text-muted">Angkatan {{ session('daftar_tahsin') }}</div>
                            </div>

                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label class="form-control-label">Nomor / ID Tahsin</label>
                                    </div>
                                    <div class="col-6">
                                        <input hidden name="notahsin" type="text"
                                            value="{{ $calonpeserta->no_tahsin }}">
                                        <input disabled class="form-control" type="text" placeholder="No Tahsin"
                                            value="{{ $calonpeserta->no_tahsin }}" maxlength="191" required="">
                                    </div><!--col-->
                                </div>
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="form-control-label">Nama</label>
                                    </div>
                                    <div class="col-10">
                                        <input disabled onkeyup="this.value = this.value.toUpperCase();"
                                            class="form-control" type="text" placeholder="Nama Peserta (Sesuai KTP)"
                                            name="namapeserta" value="{{ strtoupper($calonpeserta->nama_peserta) }}"
                                            maxlength="191" required="">
                                    </div><!--col-->
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="text-muted" style="font-size: 10px; font-weight: 700">Tidak Pakai Angka
                                            0 . Contoh : 81234563789</div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    +62
                                                </span>
                                            </div>
                                            <input id="notelp" type="number" name="notelp" value="{{ old('notelp') }}"
                                                oninvalid="setCustomValidity('Masukkan No. HP Terlebih Dahulu')"
                                                onchange="try{setCustomValidity('')}catch(e){}" class="form-control"
                                                maxlength="12" placeholder="Masukkan Nomor HP WhatsApp" required="">
                                        </div><!--form-group-->
                                        {{-- <input class="form-control" type="number" name="nohp_peserta" placeholder="No. HP Peserta (Whatsapp)" maxlength="15" required=""> --}}
                                    </div><!--col-->
                                </div>
                                <div class="form-group row">
                                    <div class="col-5">
                                        <label class="form-control-label">Jenis Peserta</label>
                                    </div>
                                    <div class="col-7">
                                        <select name="jenis_peserta" class="gender form-control" disabled>
                                            <option value="{{ $calonpeserta->jenis_peserta }}">
                                                {{ $calonpeserta->jenis_peserta }}</option>
                                        </select>
                                    </div><!--col-->
                                </div>
                                <div class="form-group row">
                                    <div class="col-12" style="padding-bottom: 7px;">
                                        <input style="font-size: 11px; height: calc(1.5em + .75rem + 7px)"
                                            onkeyup="this.value = this.value.toUpperCase();"
                                            value="{{ $calonpeserta->tempat_lahir_peserta }}"
                                            oninvalid="setCustomValidity('Isi Terlebih Dahulu')"
                                            onchange="try{setCustomValidity('')}catch(e){}" class="form-control"
                                            type="text" name="tempat_lahir_peserta" placeholder="Tempat Kelahiran"
                                            maxlength="191" required="">
                                    </div><!--col-->
                                    <div class="col-4" style="padding-right: 2px;">
                                        <select id="tgl" oninvalid="setCustomValidity('Pilih Tanggal Lahir')"
                                            onchange="try{setCustomValidity('')}catch(e){}" name="tanggal_lahir_peserta"
                                            class="gender form-control" required>
                                            <option value="">-- Tanggal Lahir --</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="padding-right: 2px; padding-left: 2px">
                                        <select id="bln" oninvalid="setCustomValidity('Pilih Bulan Lahir')"
                                            onchange="try{setCustomValidity('')}catch(e){}" name="bulan_lahir_peserta"
                                            class="gender form-control" required>
                                            <option value="">-- Bulan Lahir --</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="padding-left: 2px">
                                        <select id="thn" oninvalid="setCustomValidity('Pilih Tahun Lahir')"
                                            onchange="try{setCustomValidity('')}catch(e){}" name="tahun_lahir_peserta"
                                            class="gender form-control" required>
                                            <option value="">-- Tahun Lahir --</option>
                                            @for ($i = 2017; $i > 1930; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col">
                                        <div class="text-muted" style="text-align: justify;">
                                            Gunakan Kode Bulan Lahir dan Tanggal Lahir ketika melakukan transfer. <br>
                                            <strong>
                                                Contoh : SPP Rp 100.000 + 0418 (Bulan April Tanggal 18) = Rp 100.418
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                {{--
                            <div class="form-group row">
                                <label class="col-6 form-control-label" >Level Kelas</label>
                                <div class="col-6" name="level_peserta">
                                    <select name="pilih_level_peserta" class="form-control">
                                        <option value="ASAASI 1">ASAASI 1</option>
                                        <option value="ASAASI 2">ASAASI 2</option>
                                        <option value="TILAWAH ASAASI">TILAWAH ASAASI</option>
                                        <option value="TAMHIDI">TAMHIDI</option>
                                        <option value="TAWASUTHI">TAWASUTHI</option>
                                        <option value="TILAWAH TAWASUTHI">TILAWAH TAWASUTHI</option>
                                        <option value="IDADI">IDADI</option>
                                        <option value="TAKMILI">TAKMILI</option>
                                        <option value="TAHSINI">TAHSINI</option>
                                        <option value="ITQON">ITQON</option>
                                    </select>
                                </div><!--col-->
                            </div>

                            <div id="ikhwan">
                                <div class="form-group row">
                                    <label class="col-6 form-control-label" >Jadwal Kelas</label>
                                    <div class="col-6">
                                        <select name="jadwal_peserta" class="form-control">
                                            <option value="">Pilih...</option>
                                            <option value="SABTU 08.00">SABTU - 08.00 WITA</option>
                                            <option value="SABTU 10.00">SABTU - 10.00 WITA</option>
                                            <option value="SABTU 13.00">SABTU - 13.00 WITA</option>
                                            <option value="SABTU 16.00">SABTU - 16.00 WITA</option>
                                            <option value="SABTU 20.00">SABTU - 20.00 WITA</option>
                                            <option value="AHAD 08.00">AHAD - 08.00 WITA</option>
                                            <option value="AHAD 10.00">AHAD - 10.00 WITA</option>
                                            <option value="AHAD 13.00">AHAD - 13.00 WITA</option>
                                            <option value="AHAD 16.00">AHAD - 16.00 WITA</option>
                                            <option value="AHAD 20.00">AHAD - 20.00 WITA</option>
                                            <option value="SENIN 20.00">SENIN - 20.00 WITA</option>
                                            <option value="SELASA 20.00">SELASA - 20.00 WITA</option>
                                            <option value="RABU 20.00">RABU - 20.00 WITA</option>
                                            <option value="KAMIS 20.00">KAMIS - 20.00 WITA</option>
                                            <option value="JUMAT 20.00">JUMAT - 20.00 WITA</option>
                                        </select>
                                    </div><!--col-->
                                </div>
                                <div class="form-group row">
                                    <label class="col-6 form-control-label" >Pengajar Tahsin</label>
                                    <div class="col-6">
                                        <select name="pengajar_tahsin" class="form-control">
                                            <option value="UST. ARIEF">UST. ARIEF</option>
                                            <option value="UST. HILMAN">UST. HILMAN</option>
                                            <option value="UST. ILHAM">UST. ILHAM</option>
                                            <option value="UST. IRPAN">UST. IRPAN</option>
                                            <option value="UST. KASMAR">UST. KASMAR</option>
                                            <option value="UST. LUKMAN HAKIM">UST. LUKMAN HAKIM</option>
                                            <option value="UST. MAULIAN">UST. MAULIAN</option>
                                            <option value="UST. RAHMAT">UST. RAHMAT</option>
                                            <option value="UST. RIDHO">UST. RIDHO</option>
                                            <option value="UST. RIDWANSYAH">UST. RIDWANSYAH</option>
                                            <option value="UST. RIYAN">UST. RIYAN</option>
                                            <option value="UST. SALMANI">UST. SALMANI</option>
                                            <option value="UST. SANDY IBRAHIM">UST. SANDY IBRAHIM</option>
                                            <option value="UST. SIDDIQ">UST. SIDDIQ</option>
                                            <option value="UST. SOLIHIN">UST. SOLIHIN</option>
                                            <option value="UST. SUBUR">UST. SUBUR</option>
                                            <option value="UST. SURATNO">UST. SURATNO</option>
                                            <option value="UST. ZAIDAN">UST. ZAIDAN</option>
                                        </select>
                                    </div><!--col-->
                                </div>
                            </div>
                            <div id="akhwat">
                                <div class="form-group row">
                                    <label class="col-6 form-control-label" >Jadwal Tahsin</label>
                                    <div class="col-3" style="padding-right: 2px; padding-left: 2px">
                                        <select  name="jadwal_peserta_hari" class="form-control">
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
                                        <select  name="jadwal_peserta_jam" class="form-control">
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
                                    <label class="col-6 form-control-label" >Pengajar Tahsin</label>
                                    <div class="col-6">
                                        <select name="pengajar_tahsin" class="form-control">
                                            <option value="ADE">ADE</option>
                                            <option value="AFAENI">AFAENI</option>
                                            <option value="AGUS DIANA">AGUS DIANA</option>
                                            <option value="ANI MEI">ANI MEI</option>
                                            <option value="ANITA">ANITA</option>
                                            <option value="ARI">ARI</option>
                                            <option value="ARINA">ARINA</option>
                                            <option value="CHRISNA">CHRISNA</option>
                                            <option value="DWI A">DWI A</option>
                                            <option value="ENDAH">ENDAH</option>
                                            <option value="ERINIL">ERINIL</option>
                                            <option value="FERA">FERA</option>
                                            <option value="FITRI">FITRI</option>
                                            <option value="HAYANI">HAYANI</option>
                                            <option value="HELLEN">HELLEN</option>
                                            <option value="INDAH">INDAH</option>
                                            <option value="JULI">JULI</option>
                                            <option value="JUSTANTY">JUSTANTY</option>
                                            <option value="KOMALA">KOMALA</option>
                                            <option value="MINANG">MINANG</option>
                                            <option value="MUFITTA">MUFITTA</option>
                                            <option value="NANY">NANY</option>
                                            <option value="NENY">NENY</option>
                                            <option value="NININ">NININ</option>
                                            <option value="NISWAH">NISWAH</option>
                                            <option value="NURJANNAH">NURJANNAH</option>
                                            <option value="RAHMI">RAHMI</option>
                                            <option value="RATNA">RATNA</option>
                                            <option value="RIFA">RIFA</option>
                                            <option value="RINNA">RINNA</option>
                                            <option value="RIRIN">RIRIN</option>
                                            <option value="SITI">SITI</option>
                                            <option value="UNUN">UNUN</option>
                                            <option value="WAHIDAH">WAHIDAH</option>
                                            <option value="WISNA">WISNA</option>
                                            <option value="YUNITA">YUNITA</option>
                                        </select>
                                    </div><!--col-->
                                </div>
                            </div> --}}
                                {{-- <div class="form-group row">
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
                            </div> --}}
                                {{-- <div class="form-group row">
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
                            </div> --}}
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
                                                    <input class="btn-check float-left mr-2 ml-2" type="checkbox" checked
                                                        disabled style="margin-top: 6px;">
                                                    <label for="nominal{{ $data['id'] }}"
                                                        class="btn p-0 text-left btn-sm btn-block text-success"
                                                        style="font-weight: 500;margin: 3px 0 0 0;"> {{ $data['ket'] }}
                                                    </label>
                                                </div>
                                            @else
                                                <div class="border border-danger rounded p-1 mb-1">
                                                    <input onclick="hitung()" id="nominal{{ $data['id'] }}"
                                                        class="btn-check float-left mr-2 ml-2" type="checkbox"
                                                        name="pembayaran[]" value="{{ $data['id'] }}"
                                                        style="margin-top: 6px;">
                                                    <label for="nominal{{ $data['id'] }}"
                                                        class="btn p-0 text-left btn-sm btn-block text-danger"
                                                        style="font-weight: 500;margin: 3px 0 0 0;"> {{ $data['ket'] }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                <label class="col-6 form-control-label" >Pelunasan SPP Tahsin</label>
                                <div class="col-6">
                                    <select name="pelunasan_tahsin" class="buktitf form-control">
                                        <option value="SUDAH">SUDAH</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div><!--col-->
                            </div> --}}
                            <input type="hidden" name="jumlah" value="{{ $jumlah }}">

                            @if ($jumlah <= 400000)
                                <div class="form-group row col-12">
                                    <label class="col-5 form-control-label" >Kode Unik (BBTT)</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control"
                                        maxlength="4" placeholder="Kode Unik"
                                        value="{{ $calonpeserta->waktu_lahir_peserta ? \Carbon\Carbon::createFromFormat('d-m-Y', $calonpeserta->waktu_lahir_peserta ?? '01-01-1901')->format('md') : '' }}"
                                        style="background-color: white;
                                                border: 0px;
                                                text-align: end;
                                                font-weight: 600;"
                                        readonly>
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
                                                value="{{ old('nominaltf') }}" oninvalid="setCustomValidity('Nominal Transfer')" onchange="try{setCustomValidity('')}catch(e){}"
                                                class="form-control" maxlength="12" placeholder="0"
                                                style="background-color: white;
                                                border: 0px;
                                                text-align: end;
                                                font-size: 18px;
                                                font-weight: 900;"
                                                readonly>
                                        </div><!--form-group-->
                                        {{-- <input class="form-control" type="number" name="nohp_peserta" placeholder="No. HP Peserta (Whatsapp)" maxlength="15" required=""> --}}
                                    </div><!--col-->
                                </div>
                                <div id="bukti-tf" class="form-group row">
                                    <label class="col-4 form-control-label">Bukti Transfer</label>
                                    <div class="col-8">
                                        <input type="file" class="upload-buktitransfer"
                                            accept="image/png, image/jpeg" />

                                        {{-- <div class="custom-file">
                                        <input class="filestyle custom-file-input" type="file" name="bukti_transfer_peserta" id="upload-3" required="" data-buttonText="Your label here.">
                                        <label class="custom-file-label" id="upload-3-label">Foto Bukti Transfer</label>
                                    </div> --}}
                                    </div><!--col-->
                                    <div class="col-12">
                                        <p class="text-muted" style="font-weight: 700; text-align:justify">
                                            Apabila sudah membayar / melunasi infaq SPP namun tidak memiliki bukti
                                            pembayaran, maka kami akan memverifikasi sendiri ke bagian keuangan.
                                        </p>
                                    </div>
                                </div>
                                <div id="non-bukti-tf" class="form-group row">
                                    <div class="col-12">
                                        <p class="text-muted" style="font-weight: 700; text-align:justify">
                                            Apabila saudara belum sempat melunasi pembayaran infaq SPP, maka saudara bisa
                                            melakukan pembayaran setelah selesai ujian.
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-12">
                                        <p class="text-muted" style="font-weight: 700; text-align:justify">
                                            Pembayaran Anda Sudah Lengkap.
                                        </p>
                                    </div>
                                </div>
                            @endif
                                <div class="form-group row">
                                    <div class="col-12">
                                        <p class="text-muted" style="font-weight: 700; text-align:justify">
                                            Terima kasih atas perhatiannya. Semoga Allah Subhanahu Wa Ta'ala memberikan
                                            kelancaran dalam kegiatan ujian saudara.
                                        </p>
                                    </div>
                                </div>
                                {{-- <div id="admin-ikhwan" class="form-group row">
                                <div class="col-md-12 table-responsive">
                                    <div class="alert alert-success" role="alert" style="margin-bottom: 0rem; font-size: 17px">
                                        <p>
                                            <div><strong>No. HP</strong> : 0852 4665 5951</div>
                                            <div><strong>A.N</strong> : Admin Ikhwan</div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="admin-akhwat" class="form-group row">
                                <div class="col-md-12 table-responsive">
                                    <div class="alert alert-warning" role="alert" style="margin-bottom: 0rem; font-size: 17px">
                                        <p>
                                            <div><strong>No. HP</strong> : 0813 5012 8157</div>
                                            <div><strong>A.N</strong> : Admin Akhwat</div>
                                        </p>
                                    </div>
                                </div>
                            </div> --}}
                                {{-- <div class="form-group row">
                                <div class="col-md-12">
                                    <img class="img-fluid" src="https://lh5.googleusercontent.com/fa9h1brjURoz-uilFI0C881v4VXDR2HJxbOWc4hH7hGdItrftVaU6eWRncRHpcexyq5H6KDwoGAfBNYVLYh_jpSxdl-i4lhbnU1tigImh3SXQlmayuYAtJRk77-g=w675" alt="">
                                </div>
                            </div> --}}
                                <div class="form-group row">
                                    <div class="col">
                                        <input oninvalid="setCustomValidity('Centang Terlebih Dahulu')"
                                            onchange="try{setCustomValidity('')}catch(e){}" id="setuju"
                                            type="checkbox" value="" required /> <label
                                            style="margin-bottom: 2px">Data yang diisi sudah benar.</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-0 clearfix">
                                            {{-- {{ form_submit(__('labels.frontend.auth.register_button')) }} --}}
                                            <button type="submit" class="btn btn-primary px-4 btn-block"
                                                style="background-color: rgb(83, 163, 28); border: rgb(83, 163, 28);">
                                                Selesai
                                            </button>
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
                $(function() {
                    $.fn.filepond.registerPlugin(
                        FilePondPluginImagePreview,
                        FilePondPluginFileValidateType,
                        FilePondPluginFileValidateSize,
                        FilePondPluginImageResize
                    );
                });

                $(function() {

                    $('.upload-buktitransfer').filepond({
                        labelIdle: '<span class="filepond--label-action">Pilih File/Foto Bukti Transfer</span>',
                        allowMultiple: false,
                        acceptedFileTypes: ['image/*'],
                        allowFileSizeValidation: true,
                        maxFileSize: '10MB',
                        server: {
                            url: '/tahsin/calon-peserta-ujian/uploadbuktitransfer',
                            process: {
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            }
                        }
                    });

                });

            </script>

            <script>
                function hitung(){
                    var spp             = document.querySelectorAll('input[type=checkbox][name="pembayaran[]"]:checked').length;
                    var totalspp        = 100000 * Number(spp);
                    var kodeunik        = "{!! $calonpeserta->waktu_lahir_peserta ? \Carbon\Carbon::createFromFormat('d-m-Y', $calonpeserta->waktu_lahir_peserta ?? '01-01-1901')->format('md') : '' !!}"
                    // var kodeunik        = '{!! $peserta->kode_unik ?? 0 !!}';
                    var kdu             = Number(kodeunik.replace(/^0+/, ''));
                    var totalnominal    = totalspp + kdu;
                    // var donasi          = document.getElementById("donasi").value;
                    var totaltf         = totalnominal // + Number(donasi);
                    var cek             = Number(document.getElementById("totalnominal").value);
                    if (spp == 0) {
                        document.getElementById("totalnominal").value = 0;
                    } else {
                        document.getElementById("totalnominal").value = totaltf.toLocaleString();
                    }
                }
            </script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $(".custom-file-input").on("change", function() {
                        var fileName = $(this).val().split("\\").pop();
                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                });

                $(document).ready(function() {
                    $(".gender").change(function() {
                        $(this).find("option:selected").each(function() {
                            var optionValue = $(this).attr("value");
                            if (optionValue === "IKHWAN") {
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

                    $(".buktitf").change(function() {
                        $(this).find("option:selected").each(function() {
                            var optionValue = $(this).attr("value");
                            if (optionValue === "SUDAH") {
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
            @if (!null == $calonpeserta->waktu_lahir_peserta)
                @php
                    $waktulahir = \Carbon\Carbon::createFromFormat('d-m-Y', $calonpeserta->waktu_lahir_peserta);
                @endphp
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#tgl").val("{!! $waktulahir->format('d') !!}");
                        $("#bln").val("{!! $waktulahir->format('m') !!}");
                        $("#thn").val("{!! $waktulahir->format('Y') !!}");
                    });
                </script>
            @endif

        @endif

    @endif

    @stack('after-scripts')

    @stack('before-scripts')
    <script>
        window.addEventListener("pageshow", function(event) {
            var historyTraversal = event.persisted ||
                (typeof window.performance != "undefined" &&
                    window.performance.navigation.type === 2);
            if (historyTraversal) {
                // Handle page restore.
                window.location.reload();
            }
        });
    </script>
    @stack('after-scripts')
@endsection
