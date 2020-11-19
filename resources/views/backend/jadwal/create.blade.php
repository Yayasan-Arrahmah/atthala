@extends('backend.layouts.app')

@section('title', 'Peserta' . ' | ' . 'Tambah Manual')

@section('breadcrumb-links')
    @include('backend.jadwal.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.jadwals.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Tambah Jadwal Tahsin
                        <small class="text-muted">Manual</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Nama Pengajar</label>
                        <div class="col-md-7">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="pengajar_jadwal" placeholder="Nama Inisial Pengajar" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Level Tahsin</label>
                        <div class="col-md-4">
                            <select class="form-control" name="level_jadwal">
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
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Jadwal Tahsin</label>
                        <div class="col-md-5">
                            <select  name="hari_jadwal" class="form-control" required>
                                <option value="">Pilih Hari...</option>
                                <option value="SABTU">SABTU</option>
                                <option value="AHAD">AHAD</option>
                                <option value="SENIN">SENIN</option>
                                <option value="SELASA">SELASA</option>
                                <option value="RABU">RABU</option>
                                <option value="KAMIS">KAMIS</option>
                                <option value="JUMAT">JUMAT</option>
                            </select>
                        </div><!--col-->
                        <div class="col-md-5">
                            <select  name="waktu_jadwal" class="form-control" required>
                                <option value="">Pilih Jam...</option>
                                <option value="06.00">06.00 WITA</option>
                                <option value="07.00">07.00 WITA</option>
                                <option value="08.00">08.00 WITA</option>
                                <option value="09.00">09.00 WITA</option>
                                <option value="10.00">10.00 WITA</option>
                                <option value="11.00">11.00 WITA</option>
                                <option value="12.00">12.00 WITA</option>
                                <option value="13.00">13.00 WITA</option>
                                <option value="14.00">14.00 WITA</option>
                                <option value="15.00">15.00 WITA</option>
                                <option value="16.00">16.00 WITA</option>
                                <option value="17.00">17.00 WITA</option>
                                <option value="18.00">18.00 WITA</option>
                                <option value="19.00">19.00 WITA</option>
                                <option value="20.00">20.00 WITA</option>
                                <option value="21.00">21.00 WITA</option>
                            </select>
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Jenis Tahsin</label>
                        <div class="col-md-3">
                            <select name="jenis_jadwal" class="form-control" required>
                                <option value="IKHWAN">IKHWAN</option>
                                <option value="AKHWAT">AKHWAT</option>
                            </select>
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Angkatan Tahsin</label>
                        <div class="col-md-3">
                            <select name="angkatan_jadwal" class="form-control" required>
                                @for ($i = 17; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div><!--col-->
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.jadwals.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
