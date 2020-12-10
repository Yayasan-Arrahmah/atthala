@extends('backend.layouts.app')

@section('title', app_name() . ' | Rapor Santri')

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
{{-- <div class="card">
    @include('backend.tahsin.includes.cari')
</div> --}}
{{-- <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<form id="form" class="card" action="{{ route('admin.rtqs.raporupdate') }}" method="POST" data-turbolinks="false">
    @csrf
    <input type="text" name="uuid" value="{{ request()->uuid }}" hidden>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Rapor Santri RTQ Ar Rahmah Balikpapan
                    {{-- <small class="text-muted"> - Angkatan {{ request()->angkatan ?? session('angkatan_tahsin') }}</small> --}}
                </h4>
            </div>

            <div class="col-sm-7">
            </div>
        </div>

        <div class="row mb-4 pt-4" style="font-size: 13px; font-weight: 500">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-4">NIS</div>
                    <div class="col-8 info-absen" style="font-weight: 800">: {{ $santri->nis_santri }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Nama</div>
                    <div class="col-8 info-absen" style="font-weight: 800">: {{ $santri->nama_santri }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Binti</div>
                    <div class="col-8 info-absen" style="font-weight: 800">: {{ $santri->nama_ayah }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Periode</div>
                    <div class="col-8 info-absen" style="font-weight: 800">: November 2020 - Februari 2021</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-4">Jenis Santri</div>
                    <div class="col-8 info-absen" style="font-weight: 800">: {{ $santri->jenis_santri }}</div>
                </div>
                <div class="row">
                    <div class="col-4">No. Telp</div>
                    <div class="col-8 info-absen" style="font-weight: 800">: {{ $santri->notelp_santri }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Status</div>
                    <div class="col-8 info-absen" style="font-weight: 800">: {{ $santri->status_santri }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Angkatan</div>
                    <div class="col-8 info-absen" style="font-weight: 800">: {{ $santri->angkatan_santri }}</div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col">
                <h4 class="text-center">Form Penilaian</h4>
            </div>
        </div>

        <div class="row mt-4">
            @php
                $huruf = ['A', 'B', 'C', 'D'];
                $h     = 0;
            @endphp
            @foreach($kategoris as $kategori)
                <div class="col-md-6">
                    <div class="text-muted pl-4" style="font-weight: 700; font-size: 15px;">
                        {{ $huruf[$h++] }}. {{ $kategori->nama_kategori }}
                    </div>
                    <div class="table table-responsive-sm table-hover mb-0 table-sm">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th class="text-center" width="200">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subkategoris = DB::table('rtq_sub_kategori_penilaians')->where('id_kategori', $kategori->id)->get();
                                    $no = 1;
                                @endphp
                                @foreach($subkategoris as $subkategori)
                                    <tr>
                                        <td class="text-center">
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $subkategori->nama_sub_kategori }}
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $nilai = DB::table('rtq_penilaians')
                                                        ->where('id_rapor', $rapor->id)
                                                        ->where('id_sub_kategori', $subkategori->id)
                                                        ->first();
                                            @endphp
                                            {{-- <a href="#" class="xedit"
                                                data-pk="{{ $nilai->id }}"
                                                data-name="nilai">
                                                {{ $nilai->nilai_santri }}
                                            </a> --}}
                                            <input type="text" name="nilai{{ $nilai->id }}" style="text-transform:uppercase" class="form-control text-center" value="{{ $nilai->nilai_santri }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-4 form-control-label text-right">Hafalan Tercapai</label>
                    <div class="col-6">
                        <div class="input-group">
                            <input class="form-control" size="2" type="number" name="hafalan_santri" placeholder="Jumlah Hafalan Terakhir" value="{{ $rapor->hafalan_santri }}">
                            <div class="input-group-append"><span class="input-group-text">JUZ</span></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 form-control-label text-right">Level Tahsin</label>
                    <div class="col-6">
                        <select id="levelsantri" class="form-control" name="level_tahsin_santri">
                            <option value="">PILIH</option>
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
                            <option value="TAJWIDI 1">TAJWIDI 1</option>
                            <option value="TAJWIDI 2">TAJWIDI 2</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 form-control-label text-right">Sakit</label>
                    <div class="col-4">
                        <div class="input-group">
                            <input class="form-control" size="2" type="number" name="jumlah_hari_sakit" placeholder="Jumlah Hari" value="{{ $rapor->jumlah_hari_sakit }}">
                            <div class="input-group-append"><span class="input-group-text">Hari</span></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 form-control-label text-right">Izin</label>
                    <div class="col-4">
                        <div class="input-group">
                            <input class="form-control" size="2" type="number" name="jumlah_hari_izin" placeholder="Jumlah Hari" value="{{ $rapor->jumlah_hari_izin }}">
                            <div class="input-group-append"><span class="input-group-text">Hari</span></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 form-control-label text-right">Tanpa Keterangan</label>
                    <div class="col-4">
                        <div class="input-group">
                            <input class="form-control" size="2" type="number" name="jumlah_hari_tanpa_ket" placeholder="Jumlah Hari" value="{{ $rapor->jumlah_hari_tanpa_ket }}">
                            <div class="input-group-append"><span class="input-group-text">Hari</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-3 form-control-label text-center">Catatan Pembimbing</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <textarea class="form-control" rows="10" name="catatan_pembimbing_santri">{{ $rapor->catatan_pembimbing_santri }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{-- {!! $rtqs->count() !!} {{ trans_choice('backend_rtqs.table.total', $rtqs->count()) }} --}}

                    {{-- {!! $first !!} - {!! $end !!} Dari {!! $rtqs->total() !!} Data --}}
                    <button type="submit" id="btn-submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </div>

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $rtqs->links() !!} --}}
                    {{-- {!! $rtqs->appends(request()->query())->links() !!} --}}
                    <a href="{{ route('admin.rtqs.raporcetak') }}?uuid={{ request()->uuid }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Cetak Rapor</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
          $("#levelsantri").val("{!! $rapor->level_tahsin_santri ?? '' !!}");
    });

    $(document).on('click', '#btn-submit', function(e) {
        e.preventDefault();
        swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Sudah Benar ?",
            confirmButtonText: 'Ya',
            showCancelButton: true,
            cancelButtonText: 'Periksa'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (result.isDenied) {
                return false;
            }
        });
    });
</script>
{{-- <script type="text/javascript">
    $(document).ready(function(){
          $("#levelsantri").val("{!! $rapor->level_tahsin_santri ?? '' !!}");
    });

    $(document).on('click', '#btn-submit', function(e) {
        e.preventDefault();
        swal.fire({
            title: 'Confirm',
            input: 'checkbox',
            inputValue: 0,
            inputPlaceholder: ' I agree with the Terms',
            confirmButtonText: 'Continue',
            inputValidator: function (result) {
                return new Promise(function (resolve, reject) {
                    if (result) {
                        resolve();
                    } else {
                        reject('You need to agree with the Terms');
                    }
                })
            }
        }).then(function (result) {
            $('#form').submit();
        });
    });
</script> --}}
@endsection
