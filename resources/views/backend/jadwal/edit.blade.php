@extends('backend.layouts.app')

@section('title', 'Peserta' . ' | ' . 'Edit')

@section('breadcrumb-links')
    @include('backend.jadwal.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($jadwal, 'PATCH', route('admin.jadwals.update', $jadwal->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Jadwal Peserta
                        <small class="text-muted">Edit Manual</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <input name="no_jadwal" value=" " hidden >

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Nama Peserta</label>
                        <div class="col-md-7">
                            <input style="font-weight: bold; color: #000" value="{{ $jadwal->nama_peserta }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="nama_peserta" placeholder="Nama Peserta" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >No. HP Peserta</label>
                        <div class="col-md-4">
                            <input style="font-weight: bold; color: #000" value="{{ $jadwal->nohp_peserta }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="nohp_peserta" placeholder="No. HP Peserta" maxlength="15" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Level Peserta</label>
                        <div class="col-md-4">
                            <select style="font-weight: bold; color: #000" class="form-control" name="level_peserta">
                                <option value="{{ $jadwal->level_peserta }}">{{ $jadwal->level_peserta }}</option>
                                <option value="-">------</option>
                                <option value="ASAASI 1">ASAASI 1</option>
                                <option value="ASAASI 2">ASAASI 2</option>
                                <option value="TILAWAH ASAASI">TILAWAH ASAASI</option>
                                <option value="TAMHIDI">TAMHIDI</option>
                                <option value="TAWATSUTHI">TAWATSUTHI</option>
                                <option value="TILAWAH TAWATSUTHI">TILAWAH TAWATSUTHI</option>
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
                            <select style="font-weight: bold; color: #000" name="jenis_peserta" class="form-control" required>
                                <option value="{{ $jadwal->jenis_peserta }}">{{ $jadwal->jenis_peserta }}</option>
                                <option value="-">------</option>
                                <option value="IKHWAN">IKHWAN</option>
                                <option value="AKHWAT">AKHWAT</option>
                            </select>
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Angkatan Peserta</label>
                        <div class="col-md-3">
                            <select style="font-weight: bold; color: #000" name="angkatan_peserta" class="form-control" required>
                                <option value="{{ $jadwal->angkatan_peserta }}">{{ $jadwal->angkatan_peserta }}</option>
                                <option value="-">------</option>
                                @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Nama Pengajar</label>
                        <div class="col-md-7">
                            <input style="font-weight: bold; color: #000" value="{{ $jadwal->nama_pengajar }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="nama_pengajar" placeholder="Nama Pengajar" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Jadwal Tahsin</label>
                        <div class="col-md-3">
                            <input style="font-weight: bold; color: #000" value="{{ $jadwal->jadwal_tahsin }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="jadwal_tahsin" placeholder="Jadwal Tahsin" maxlength="191" required="">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Status Daftar</label>
                        <div class="col-md-2">
                            <input style="font-weight: bold; color: #000" value="{{ $jadwal->sudah_daftar_jadwal }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="sudah_daftar_jadwal" placeholder="Isi Jika Status Sudah Daftar" maxlength="191" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <input style="font-weight: bold; color: #000" value="{{ $jadwal->belum_daftar_jadwal }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="belum_daftar_jadwal" placeholder="Isi Jika Status Belum Daftar" maxlength="191" >
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Keterangan </label>
                        <div class="col-md-10">
                            <input style="font-weight: bold; color: #000" value="{{ $jadwal->keterangan_jadwal }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="keterangan_jadwal" placeholder="Keterangan" maxlength="191" >
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Perubahan dari Jadwal </label>
                        <div class="col-md-5">
                            <input style="font-weight: bold; color: #000" value="{{ $jadwal->pindahan_jadwal }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="pindahan_jadwal" placeholder="Diisi jika pindahan jadwal" maxlength="191" >
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" >Keterangan Perubahan </label>
                        <div class="col-md-6">
                            <input style="font-weight: bold; color: #000" value="{{ $jadwal->pindahan_jadwal_2 }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" type="text" name="pindahan_jadwal_2" placeholder="Diisi jika pindahan jadwal" maxlength="191" >
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
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection