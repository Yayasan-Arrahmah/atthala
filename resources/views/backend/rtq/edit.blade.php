@extends('backend.layouts.app')

@section('title', __('backend_rtqs.labels.management') . ' | ' . __('backend_rtqs.labels.edit'))

@section('breadcrumb-links')
    @include('backend.rtq.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($rtq, 'PATCH', route('admin.rtqs.update', $rtq->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Santri RTQ
                        <small class="text-muted">Edit Data</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">NIS Santri</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->nis_santri }}" name="nis_santri"
                            placeholder="NIS Santri">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Nama Santri</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->nama_santri }}" name="nama_santri"
                            placeholder="Nama Santri">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">No. Telp Santri</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->notelp_santri }}" name="notelp_santri"
                            placeholder="Nomor Telepon Santri">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Jenis Santri</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->jenis_santri }}" name="jenis_santri"
                            placeholder="Nomor Telepon Santri">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Status Santri</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->status_santri }}" name="status_santri"
                            placeholder="Status Santri">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Tempat Lahir</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->tempat_lahir }}" name="tempat_lahir"
                            placeholder="Tempat Lahir">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Tanggal Lahir</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->tanggal_lahir }}" name="tanggal_lahir"
                            placeholder="Tanggal Lahir">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Alamat Santri</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->alamat }}" name="alamat"
                            placeholder="Alamat Santri">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Nama Ayah</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->nama_ayah }}" name="nama_ayah"
                            placeholder="Nama Ayah">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Pekerjaan Ayah</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->pekerjaan_ayah }}" name="pekerjaan_ayah"
                            placeholder="Pekerjaan Ayah">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Penghasilan Ayah</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->penghasilan_ayah }}" name="penghasilan_ayah"
                            placeholder="Penghasilan Ayah Perbulan">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Nama Ibu</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->nama_ibu }}" name="nama_ibu"
                            placeholder="Nama Ibu">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Pekerjaan Ibu</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->pekerjaan_ibu }}" name="pekerjaan_ibu"
                            placeholder="Pekerjaan Ibu">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Penghasilan Ibu</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->penghasilan_ibu }}" name="penghasilan_ibu"
                            placeholder="Penghasilan Ibu Perbulan">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Alaman Orang Tua</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->alamat_orangtua }}" name="alamat_orangtua"
                            placeholder="Alaman Orang Tua">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Tanggal Masuk</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->tanggal_masuk }}" name="tanggal_masuk"
                            placeholder="Tanggal Masuk">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Jumlah Hafalan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->jumlah_hafalan }}" name="jumlah_hafalan"
                            placeholder="Jumlah Hafalan Ketika Masuk">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Pengalaman Pesantren</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->pengalaman_pesantren }}" name="pengalaman_pesantren"
                            placeholder="Pengalaman Pesantren">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Riwayat Pendidikan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->riwayat_pendidikan }}" name="riwayat_pendidikan"
                            placeholder="Riwayat Pendidikan">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">SPP Disanggupi</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->spp_disanggupi }}" name="spp_disanggupi"
                            placeholder="SPP Yang Disanggupi Perbulan">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Angkatan Santri</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->angkatan_santri }}" name="angkatan_santri"
                            placeholder="SPP Yang Disanggupi Perbulan">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Angkatan Santri</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->pengajar_santri }}" name="pengajar_santri"
                            placeholder="Nama Musyrif">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Kota Domisili</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->domisili }}" name="domisili"
                            placeholder="Kota Domisili">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Kriteria</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->kriteria }}" name="kriteria"
                            placeholder="Kriteria">
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">Keterangan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $rtq->keterangan }}" name="keterangan"
                            placeholder="Keterangan Informasi Tambahan">
                        </div><!--col-->
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.rtqs.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
