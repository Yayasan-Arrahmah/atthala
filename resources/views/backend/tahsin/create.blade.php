@extends('backend.layouts.app')

@section('title', __('backend_tahsins.labels.management') . ' | ' . __('backend_tahsins.labels.create'))

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.tahsins.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_tahsins.labels.management')
                        <small class="text-muted">@lang('backend_tahsins.labels.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <input name="no_tahsin" value=" " hidden >

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Nama Peserta</label>
                        <div class="col-md-7">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="nama_peserta" placeholder="Nama Peserta" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >No. HP Peserta</label>
                        <div class="col-md-4">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="nohp_peserta" placeholder="No. HP Peserta" maxlength="15" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Level Peserta</label>
                        <div class="col-md-4">
                            <select class="form-control" name="level_peserta">
                                <option value="ASAASI 1">ASAASI 1</option>
                                <option value="ASAASI 2">ASAASI 2</option>
                                <option value="TILAWAH ASAASI">TILAWAH ASAASI</option>
                                <option value="TAMHIDI">TAMHIDI</option>
                                <option value="TAWASUTHI">TAWASUTHI</option>
                                <option value="TILAWAH TAWASUTHI">TILAWAH TAWASUTHI</option>
                                <option value="I'DADI">I'DADI</option>
                                <option value="TAKMILI">TAKMILI</option>
                                <option value="TAHSINI">TAHSINI</option>
                                <option value="ITQON">ITQON</option>
                            </select>
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Jenis Peserta</label>
                        <div class="col-md-3">
                            <select name="jenis_peserta" class="form-control" required>
                                <option value="IKHWAN">IKHWAN</option>
                                <option value="AKHWAT">AKHWAT</option>
                            </select>
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Angkatan Peserta</label>
                        <div class="col-md-3">
                            <select name="angkatan_peserta" class="form-control" required>
                                @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Nama Pengajar</label>
                        <div class="col-md-7">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="nama_pengajar" placeholder="Nama Pengajar" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Jadwal Tahsin</label>
                        <div class="col-md-3">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="jadwal_tahsin" placeholder="Jadwal Tahsin" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Status Daftar</label>
                        <div class="col-md-2">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="sudah_daftar_tahsin" placeholder="Isi Jika Status Sudah Daftar" maxlength="191" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="belum_daftar_tahsin" placeholder="Isi Jika Status Belum Daftar" maxlength="191" >
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Keterangan </label>
                        <div class="col-md-10">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="keterangan_tahsin" placeholder="Keterangan" maxlength="191" >
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Perubahan dari jadwal </label>
                        <div class="col-md-5">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="pindahan_tahsin" placeholder="Diisi jika pindahan jadwal" maxlength="191" >
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Keterangan Perubahan </label>
                        <div class="col-md-6">
                            <input onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="pindahan_tahsin_2" placeholder="Diisi jika pindahan jadwal" maxlength="191" >
                        </div><!--col-->
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.tahsins.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
