@extends('backend.layouts.app-2')

@section('title', app_name() . '| Tahsin')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">
                        Administrasi Tahsin - <u>{{ $title ?? 'Peserta' }}</u>
                    </h4>
                </div><!--card-header-->
                <div class="card-body">
                    @include('backend.pendidikan.tahsin.component.filter-tahsin')
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col-md-8 collapse hide" id="tambahdata">
            <div class="card">
                <div class="card-body m-4">
                    <form action="{{ route('admin.tahsin/jadwal.postCreateJadwal') }}" method="post">
                        <div class="mb-3 row">
                            <h5 class="modal-title" id="tambahdata">Tambah Data Peserta</h5>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-4 form-label">Nama <span style="color:red !important">*</span></label>
                            <div class="col-md-8">
                            <input name="nama" class="form-control" type="text" value="" placeholder="Nama Peserta" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-4 form-label">No. Telp. <span style="color:red !important">*</span></label>
                            <div class="col-md-8">
                            <input name="notelp" class="form-control" type="number" value="" placeholder="No. Telp. Whatsapp" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-4 form-label">Tanggal Lahir <span style="color:red !important">*</span></label>
                            <div class="col-md-8">
                            <input name="tgllahir" id="datelahir" class="form-control" value="" required>
                            </div>
                            <script>
                                $( function() {
                                  $( "#datelahir" ).datepicker({
                                        dateFormat: 'dd-mm-yy',
                                        yearRange: "{!! \Carbon\Carbon::now()->subYears(85)->year !!}:{!! \Carbon\Carbon::now()->subYears(10)->year !!}",
                                        changeMonth: true,
                                        changeYear: true
                                    });
                                });
                            </script>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-12 form-label">Pilih Jadwal <span style="color:red !important">*</span></label>
                            <div class="col-md-12">
                                <select class="livesearch form-control p-3" name="jadwal" style="width: 100%">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" data-toggle="collapse" href="#tambahdata" aria-expanded="false">
                            <i class="fas fa-plus-circle"></i> Tambah Data
                        </button>
                    </div>
                    <div class="legend p-3">
                        <div class="row kotak-atas mb-3">
                            <div class="col-md-4 pr-0 font-weight-bold text-uppercase">
                                Nama
                            </div>
                            <div class="col-md-2 font-weight-bold text-uppercase">
                                Level
                            </div>
                            <div class="col-md-2 font-weight-bold text-uppercase" style="margin-left: 0px">
                                Pengajar
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                                @if (request()->input('daftar-ujian'))
                                    Kenaikan Level
                                @else
                                    Status
                                @endif
                            </div>
                        </div>
                        @php
                            $first  = 0;
                            $end    = 0;
                            $number = 1;
                        @endphp
                        @foreach($tahsins as $key=> $tahsin)
                            <div class="row kotak mb-1">
                                <td>{{ $key + $tahsins->firstItem() }}</td>
                                <div class="col-md-4 pr-0">
                                    <a data-toggle="collapse" href="#detail{{ $key + $tahsins->firstItem() }}" aria-expanded="false" style="color: rgb(56, 56, 56);" class="">
                                        <div class="font-weight-bold text-uppercase">
                                            {{ $tahsin->no_tahsin }} - {{ $tahsin->nama_peserta }}
                                        </div>
                                        <div class="small text-muted">
                                            {{ $tahsin->waktu_lahir_peserta }} | {{ $tahsin->nohp_peserta }}
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <span class="fa-stack float-left mr-2">
                                        <i class="fa fa-circle fa-stack-2x icon-background" style="color: {{ $tahsin->level->warna ?? '-' }}"></i>
                                        <i class="fa fa-book fa-stack-1x" style="color: #fff"></i>
                                    </span>
                                    <div class="font-weight-bold text-uppercase">
                                        {{ $tahsin->level_peserta }}
                                    </div>
                                    <div class="small text-muted">
                                        {{-- {{ $tahsin->jenis_pembelajaran }} |  --}}
                                        Angkatan {{ $tahsin->angkatan_peserta }}
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-left: 0px">
                                    <div class="font-weight-bold text-uppercase">{{ $tahsin->nama_pengajar }}</div>
                                    <div class="small text-muted">
                                        {{ $tahsin->jadwal_tahsin }} | {{ $tahsin->jenis_peserta }}
                                    </div>
                                </div>
                                <div class="col-md">
                                    @if (request()->input('daftar-ujian'))
                                        <form action="{{ route('admin.tahsin/peserta.postUjianUpdateLevel') }}" method="POST">
                                            @csrf
                                            <input name="id" value="{{ $tahsin->id  }}" hidden>
                                            <input name="idtahsin" value="{{ $tahsin->no_tahsin  }}" hidden>
                                            <input name="angkatan" value="{{ $tahsin->angkatan_peserta  }}" hidden>
                                            @if(!empty(Request::get('nama')))
                                                <input name="nama" value="{{ Request::get('nama') }}" hidden>
                                            @endif
                                            @if(!empty(Request::get('page')))
                                                <input name="page" value="{{ Request::get('page') }}" hidden>
                                            @endif
                                            <select style="font-weight: 700;" class="form-control" name="kenaikanlevel" onchange='if(this.value != 0) { this.form.submit(); }'>
                                                <option value="">{{ $tahsin->kenaikan_level_peserta }}</option>
                                                <option value="">-----</option>
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
                                            </select>
                                        </form>
                                    @else
                                        @php
                                            $ceklevel = data_get($tahsin->cekstatusnaik($tahsin->angkatan_peserta), 'level_peserta');
                                        @endphp
                                        @if (request()->input('daftar-ulang') == 2)
                                            HASIL UJIAN -
                                            <div class="btn btn-sm btn-outline-success" style="font-size: 10px">
                                                LEVEL <strong>{{ $tahsin->kenaikan_level_peserta }}</strong>
                                            </div>
                                        @else
                                            @if (!null == $ceklevel)
                                                @if ($ceklevel == $tahsin->level_peserta)
                                                    <div class="btn btn-sm btn-outline-danger" style="font-size: 10px">
                                                        MENGULANG LEVEL <strong>{{ $ceklevel }}</strong>
                                                    </div>
                                                @else
                                                    <div class="btn btn-sm btn-outline-success" style="font-size: 10px">
                                                        NAIK LEVEL DARI <strong>{{ $ceklevel }}</strong>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="btn btn-sm btn-outline-info" style="font-size: 10px">
                                                    BARU TERDAFTAR
                                                </div>
                                            @endif
                                        @endif


                                        <div class="small text-muted">
                                            PESERTA {{ $tahsin->status_peserta ?? 'UMUM' }} || {{ $tahsin->created_at }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md text-right p-0">
                                    @if (request()->input('daftar-ulang') == 2)
                                        <a href="{{ route('admin.tahsin/peserta.getDaftarUlang') }}?notif-daftar-ulang=1&notahsin={{ $tahsin->no_tahsin }}&id={{ $tahsin->id }}&nama={{ $tahsin->nama_peserta }}&notelp={{ $tahsin->nohp_peserta }}"
                                            class="btn {{ $tahsin->notif_daftar_ulang == null ? 'btn-warning' : 'btn-outline-warning' }} btn-sm"
                                        >
                                            <i class="fa fa-info-circle"></i>
                                            Kirim Notif Daftar Ulang
                                            @if ($tahsin->notif_daftar_ulang )
                                                <span class="badge bg-danger ms-auto">{{ $tahsin->notif_daftar_ulang  }}</span>
                                            @endif
                                        </a>
                                    @endif
                                    @if ($tahsin->nama_pengajar == null)
                                        <a href="{{ route('admin.tahsin/peserta.getBaru') }}?notif-pilih-jadwal=1&notahsin={{ $tahsin->no_tahsin }}&id={{ $tahsin->id }}&nama={{ $tahsin->nama_peserta }}&notelp={{ $tahsin->nohp_peserta }}"
                                            class="btn {{ $tahsin->notif_pilih_jadwal == null ? 'btn-warning' : 'btn-outline-warning' }} btn-sm"
                                        >
                                            <i class="fa fa-info-circle"></i>
                                            Kirim Notif Pilih Jadwal
                                            @if ($tahsin->notif_pilih_jadwal )
                                                <span class="badge bg-danger ms-auto">{{ $tahsin->notif_pilih_jadwal  }}</span>
                                            @endif
                                        </a>
                                    @endif
                                    <div class="btn-group dropleft">
                                        <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                            Opsi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @if ($tahsin->status_keaktifan == 'AKTIF')
                                                <a href="{{ route('admin.tahsin/peserta.getCutiPeserta') }}?id={{ $tahsin->id }}" class="dropdown-item" onclick="return confirm('Apakah Anda yakin {{ $tahsin->nama_peserta }} merubah status menjadi Cuti ?');">
                                                    Cuti
                                                </a>
                                                    <a href="{{ route('admin.tahsin/peserta.getOffPeserta') }}?id={{ $tahsin->id }}" class="dropdown-item" onclick="return confirm('Apakah Anda yakin {{ $tahsin->nama_peserta }} merubah status menjadi Off ?');">
                                                    Off
                                                </a>
                                            @else
                                                <a href="{{ route('admin.tahsin/peserta.getAktifPeserta') }}?id={{ $tahsin->id }}" class="dropdown-item" onclick="return confirm('Apakah Anda yakin {{ $tahsin->nama_peserta }} merubah status menjadi Off ?');">
                                                    Aktif
                                                </a>
                                            @endif
                                            @if ($tahsin->nama_pengajar == null)
                                                <a href="https://atthala.arrahmahbalikpapan.or.id/tahsin/pendaftaran/peserta?id={{ $tahsin->no_tahsin }}" class="dropdown-item"  target="_blank">
                                                    Link Pilih Jadwal
                                                </a>
                                            @endif

                                            <a href="{{ route('admin.tahsin/peserta.postDeletePeserta') }}?id={{ $tahsin->id }}" title="Hapus" data-method="delete" data-trans-button-cancel="Batal" data-trans-button-confirm="Hapus" data-trans-title="dihapus?" class=" dropdown-item" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();">
                                                <form action="{{ route('admin.tahsin/peserta.postDeletePeserta') }}" onsubmit="return confirm('Apakah Anda yakin {{ $tahsin->no_tahsin }} - {{ $tahsin->nama_peserta }} dihapus ?');" method="post" style="display:none">
                                                    @csrf
                                                    <input type="hidden" name="metode" value="hapus">
                                                    <input type="hidden" name="id" value="{{ $tahsin->id }}">
                                                </form>
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" style="color: #4e4e4e">
                                    <div class="col">
                                        <div class="collapse hide" id="detail{{ $key + $tahsins->firstItem() }}" style="">
                                            <hr>
                                            <form class="row" action="{{ route('admin.tahsin/peserta.postUpdatePeserta') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $tahsin->id }}">
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Nama</label>
                                                        <input name="nama" type="text" class="form-control" value="{{ $tahsin->nama_peserta }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label lass="form-label">No. HP</label>
                                                                <input name="nohp" type="text" class="form-control" value="{{ $tahsin->nohp_peserta }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <label lass="form-label">Tanggal Lahir</label>
                                                                <input name="tgllahir" id="date{{ $tahsin->id }}" class="form-control" value="{{ $tahsin->waktu_lahir_peserta }}">
                                                                <script>
                                                                    $( function() {
                                                                      $( "#date{{ $tahsin->id }}" ).datepicker({
                                                                            dateFormat: 'dd-mm-yy',
                                                                            yearRange: "{!! \Carbon\Carbon::now()->subYears(85)->year !!}:{!! \Carbon\Carbon::now()->subYears(10)->year !!}",
                                                                            changeMonth: true,
                                                                            changeYear: true
                                                                        });
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Jenis</label>
                                                        <select name="jenis" name="jenis" class="form-control"  id="">
                                                            <option value="IKHWAN" {{ $tahsin->jenis_peserta == 'IKHWAN' ? 'selected' : '' }}>IKHWAN</option>
                                                            <option value="AKHWAT" {{ $tahsin->jenis_peserta == 'AKHWAT' ? 'selected' : '' }}>AKHWAT</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label lass="form-label">Status Peserta</label>
                                                        <select name="status" class="form-control"  id="">
                                                            <option value=""></option>
                                                            <option value="UMUM" {{ $tahsin->status_peserta == 'UMUM' || $tahsin->status_peserta == '' ? 'selected' : '' }}>UMUM</option>
                                                            <option value="LAZIZ" {{ $tahsin->status_peserta == 'LAZIZ' ? 'selected' : '' }}>LAZIZ</option>
                                                            <option value="KARYAWAN" {{ $tahsin->status_peserta == 'KARYAWAN' ? 'selected' : '' }}>KARYAWAN</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Level</label>
                                                        <select name="level" class="form-control"  id="">
                                                            <option value=""></option>
                                                            @foreach ( $datalevel as $level )
                                                                <option value="{{ $level->nama }}" {{ $tahsin->level_peserta == $level->nama ? 'selected' : '' }}>{{ $level->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label lass="form-label">Pengajar</label>
                                                        <select name="pengajar" class="form-control"  id="">
                                                            <option value=""></option>
                                                            @foreach ( $datapengajars as $pengajar )
                                                                <option value="{{ $pengajar->nama_pengajar }}" {{ $tahsin->nama_pengajar == $pengajar->nama_pengajar ? 'selected' : '' }}>{{ $pengajar->nama_pengajar }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-3">
                                                        <label lass="form-label">
                                                            Jadwal
                                                        </label>
                                                        <a class="float-right" data-toggle="collapse" href="#editjadwal{{ $key + $tahsins->firstItem() }}" aria-expanded="false">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <div class="collapse hide" id="editjadwal{{ $key + $tahsins->firstItem() }}" style="">
                                                            <div class="row">
                                                                <div class="col-sm-6 pr-0">
                                                                    <select name="hari" class="form-control" id="hari{{ $tahsin->id }}">
                                                                        <option value="">Hari...</option>
                                                                        <option value="AHAD">AHAD</option>
                                                                        <option value="SENIN">SENIN</option>
                                                                        <option value="SELASA">SELASA</option>
                                                                        <option value="RABU">RABU</option>
                                                                        <option value="KAMIS">KAMIS</option>
                                                                        <option value="JUMAT">JUMAT</option>
                                                                        <option value="SABTU">SABTU</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6 pl-0">
                                                                    <select name="jam" class="form-control" id="jam{{ $tahsin->id }}">
                                                                        <option value="">Jam...</option>
                                                                        @php
                                                                            for ($i = 5; $i <= 22; $i++) {
                                                                                for ($j=0; $j <= 1 ; $j++) {
                                                                                    echo '<option value="';
                                                                                    if ($i < 10) { echo '0'; } else { echo ''; } echo $i;
                                                                                    echo ':';
                                                                                    if ($j == 0){ echo '00'; } elseif ($j == 1) { echo '30'; }
                                                                                    echo '">';
                                                                                    if ($i < 10) { echo '0'; } else { echo ''; } echo $i;
                                                                                    echo ':';
                                                                                    if ($j == 0){ echo '00'; } elseif ($j == 1) { echo '30'; }
                                                                                    echo '</option>';
                                                                                }
                                                                            }
                                                                        @endphp
                                                                    </select>
                                                                </div>
                                                                @php
                                                                    $datawaktu = $tahsin->jadwal_tahsin ? explode(" ",$tahsin->jadwal_tahsin) : null;
                                                                @endphp
                                                                <script type="text/javascript">
                                                                    $(document).ready(function(){
                                                                          $("#hari{{ $tahsin->id }}").val("{{ $datawaktu ? $datawaktu[0] : null }}");
                                                                          $("#jam{{ $tahsin->id }}").val("{{ $datawaktu ? $datawaktu[1] : null }}");
                                                                    });
                                                                  </script>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" value="{{ $tahsin->jadwal_tahsin }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label lass="form-label">Pembelajaran</label>
                                                        <select name="pembelajaran" class="form-control" id="">
                                                            <option value=""></option>
                                                            <option value="ONLINE" {{ $tahsin->jenis_pembelajaran == 'ONLINE' ? 'selected' : '' }}>ONLINE</option>
                                                            <option value="OFFLINE" {{ $tahsin->jenis_pembelajaran == 'OFFLINE' ? 'selected' : '' }}>OFFLINE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-3">
                                                        <label lass="form-label">KTP</label>
                                                        @php
                                                            $foto = DB::table('tahsins')->where('no_tahsin', $tahsin->no_tahsin )->first();
                                                        @endphp
                                                        <div class="img-thumbnail">
                                                            <img data-src="https://atthala.arrahmahbalikpapan.or.id/app/public/ktp/{{ $foto->fotoktp_peserta ?? '-' }}" alt="" height="105" class="ktp img rounded lazy">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2"></div>
                                                <div class="col-12">
                                                    <div class="mb-3 float-right">
                                                        <button type="submit" class="btn btn-outline-success">
                                                            Update Profile
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                            $first  = $tahsins->firstItem();
                            $end    = $key + $tahsins->firstItem();
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-7">
            <div class="float-left">
                {!! $first !!} - {!! $end !!} Dari {!! $tahsins->total() !!} Data
            </div>
        </div><!--col-->

        <div class="col-5">
            <div class="float-right">
                {{-- {!! $tahsins->links() !!} --}}
                {!! $tahsins->appends(request()->query())->links() !!}
            </div>
        </div><!--col-->
    </div><!--row-->
    <script>
        $(document).ready(function(){
            var lazyLoadInstance = new LazyLoad({
            // Your custom settings go here
            });
        });
    </script>
    <script type="text/javascript">
        $('.livesearch').select2({
            placeholder: 'Cari Jadwal',
            ajax: {
                url: '{{ route("admin.tahsin/peserta.getCariJadwal") }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.pengajar_jadwal+' - '+
                                        item.level_jadwal+' - '+
                                        item.hari_jadwal+' - '+
                                        item.waktu_jadwal+' - '+
                                        item.status_belajar+' - '+
                                        item.jenis_jadwal+' - '+
                                        item.angkatan_jadwal
                                        ,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
