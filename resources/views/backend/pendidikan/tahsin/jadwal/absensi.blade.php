@extends('backend.layouts.app-2')

@section('title', app_name() . '| Tahsin Absensi')

@section('content')

<!-- Button trigger modal -->


  <!-- Modal -->
  {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="tambahdata" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('admin.tahsin/jadwal.postCreateJadwal') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahdata">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label lass="form-label">Pengajar <span style="color:red !important">*</span></label>
                        <select name="pengajar" name="pengajar" class="form-control" required>
                            <option value="">Pilih Pengajar...</option>
                            @foreach($datapengajars as $pengajar)
                                <option value="{{ $pengajar->nama_pengajar }}">{{ $pengajar->nama_pengajar }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Level <span style="color:red !important">*</span></label>
                        <select name="level" class="form-control" required>
                            <option value="">Pilih Level...</option>
                            @foreach ( $datalevel as $level )
                                <option value="{{ $level->nama }}">{{ $level->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">
                            Waktu <span style="color:red !important">*</span>
                        </label>
                        <div class="row">
                            <div class="col-sm-6 pr-0">
                                <select name="hari" class="form-control" id="hari" required>
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
                                <select name="jam" class="form-control" required>
                                    <option value="">Jam...</option>
                                    @for ($i = 5; $i <= 22; $i++)
                                        @php
                                            $jam_ = ($i < 10 ? '0'.$i : $i).':00';
                                        @endphp
                                        <option value="{{ $jam_ }}">{{ $jam_ }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Jenis <span style="color:red !important">*</span></label>
                        <select name="jenis" class="form-control" required>
                            <option value="IKHWAN">IKHWAN</option>
                            <option value="AKHWAT">AKHWAT</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Jumlah Batasan Peserta <span style="color:red !important">*</span></label>
                        <input name="jumlahpeserta" class="form-control" type="number" value="0" required>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Status Belajar <span style="color:red !important">*</span></label>
                        <select name="statusbelajar" class="form-control" required>
                            <option value="ONLINE / OFFLINE">ONLINE / OFFLINE</option>
                            <option value="ONLINE">ONLINE</option>
                            <option value="OFFLINE">OFFLINE</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Angkatan <span style="color:red !important">*</span></label>
                        <select name="angkatan" class="form-control" required>
                            @for ($i = 23; $i >= 16; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
  </div> --}}

    {{-- <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">
                        Jadwal Tahsin
                    </h4>
                </div><!--card-header-->
                <div class="card-body">
                    @include('backend.pendidikan.tahsin.component.filter-jadwal')
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row--> --}}

    {{-- <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus-circle"></i> Tambah Data
                        </button>
                    </div>
                    <div class="legend p-3">
                        <div class="row kotak-atas mb-3">
                            <div class="col-2 ml-3 font-weight-bold text-uppercase">
                                Nama Pengajar
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                                Level
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                                Waktu
                            </div>
                            <div class="col font-weight-bold text-uppercase text-center ">
                                Jenis
                            </div>
                            <div class="col font-weight-bold text-uppercase text-center small">
                                Batasan Peserta
                            </div>
                            <div class="col font-weight-bold text-uppercase text-center small">
                                Banyak Peserta
                            </div>
                            <div class="col font-weight-bold text-uppercase text-center">
                                Angkatan
                            </div>
                            <div class="col-2 font-weight-bold text-uppercase">
                                Status
                            </div>
                            <div class="col-1"></div>
                        </div>
                        @php
                            $first  = 0;
                            $end    = 0;
                            $number = 1;
                        @endphp
                        @foreach($jadwals as $key => $jadwal)
                            <div class="row d-flex align-content-between flex-wrap kotak mb-1" style="border-left-color: {{ $jadwal->level != null ? $jadwal->level->warna : '' }} !important; border-left-width: 4px!important;">
                                <div class="position-absolute">{{ $key + $jadwals->firstItem() }}</div>
                                <div class="col-2 ml-3 d-flex align-items-center font-weight-bold">
                                    {{ $jadwal->pengajar_jadwal }}
                                </div>
                                <div class="col d-flex align-items-center font-weight-bold">
                                    <button class="btn btn-sm btn-outline-dark" style="border-color: {{ $jadwal->level != null ? $jadwal->level->warna : '' }} !important; ">
                                        {{ $jadwal->level_jadwal }}
                                    </button>
                                </div>
                                <div class="col d-flex align-items-center font-weight-bold">
                                    {{ $jadwal->hari_jadwal }} - {{ $jadwal->waktu_jadwal }}
                                </div>
                                <div class="col d-flex align-items-center justify-content-center font-weight-bold">
                                    {{ $jadwal->jenis_jadwal }}
                                </div>
                                <div class="col d-flex align-items-center justify-content-center font-weight-bold">
                                    {{ $jadwal->jumlah_peserta }}
                                </div>
                                <div class="col d-flex align-items-center justify-content-center font-weight-bold">
                                    @php
                                        $jadwal_ = $jadwal->hari_jadwal.' '.$jadwal->waktu_jadwal;
                                    @endphp
                                    {{-- $jadwal->jumlahpeserta($jadwal->level_jadwal, $jadwal_, $jadwal->angkatan_jadwal)->count() --}}
                                </div>
                                <div class="col d-flex align-items-center justify-content-center font-weight-bold">
                                    <button class="btn btn-sm btn-outline-dark">{{ $jadwal->angkatan_jadwal }}</button>

                                </div>
                                <div class="col-2 d-flex align-items-center font-weight-bold small">
                                    {{ $jadwal->status_belajar }}
                                </div>
                                <div class="col-1 d-flex align-items-center justify-content-end">
                                    <a class="btn btn-sm btn-primary mr-2" data-toggle="collapse" href="#peserta{{ $key + $jadwals->firstItem() }}" aria-expanded="false"  >
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-warning mr-2" data-toggle="collapse" href="#detail{{ $key + $jadwals->firstItem() }}" aria-expanded="false" >
                                        Edit
                                    </a>
                                    <div class="btn-group dropleft">
                                        <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="#" title="Hapus" data-method="delete" data-trans-button-cancel="Batal" data-trans-button-confirm="Hapus" data-trans-title="dihapus?" class=" dropdown-item" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();">
                                                <form action="{{ route('admin.tahsin/jadwal.getDeleteJadwal') }}" onsubmit="return confirm('Apakah Anda yakin {{ $jadwal->level_jadwal }} - {{ $jadwal->pengajar_jadwal }} dihapus ?');" style="display:none">
                                                    <input type="hidden" name="id" value="{{ $jadwal->id }}">
                                                </form>
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" style="color: #4e4e4e">
                                    <div class="row">
                                        <div class="col-12 collapse hide" id="peserta{{ $key + $jadwals->firstItem() }}">
                                            <hr>
                                            <table class="table table-sm table-bordered">
                                                <tbody>
                                                    @php
                                                        $no_ = 1;
                                                    @endphp
                                                    @foreach ( $jadwal->jumlahpeserta($jadwal->level_jadwal, $jadwal_, $jadwal->angkatan_jadwal) as $peserta)
                                                    <tr>
                                                        <td class="text-center">{{ $no_++ }}</td>
                                                        <td class="text-center">
                                                            {{ $peserta->no_tahsin }}
                                                        </td>
                                                        <td>
                                                            {{ $peserta->nama_peserta }}
                                                        </td>
                                                        <td>
                                                            {{ $peserta->nohp_peserta }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="col-12 collapse hide" id="detail{{ $key + $jadwals->firstItem() }}" style="">
                                            <hr>
                                            <form class="row" action="{{ route('admin.tahsin/jadwal.postUpdateJadwal') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $jadwal->id }}">
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Pengajar</label>
                                                        <select name="pengajar" name="pengajar" class="form-control" required>
                                                            @foreach($datapengajars as $pengajar)
                                                                <option value="{{ $pengajar->nama_pengajar }}" {{ $jadwal->pengajar_jadwal == $pengajar->nama_pengajar ? 'selected' : '' }}>{{ $pengajar->nama_pengajar }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label lass="form-label">Level</label>
                                                        <select name="level" class="form-control" required>
                                                            <option value=""></option>
                                                            @foreach ( $datalevel as $level )
                                                                <option value="{{ $level->nama }}" {{ $jadwal->level_jadwal == $level->nama ? 'selected' : '' }}>{{ $level->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label lass="form-label">
                                                            Waktu
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-sm-6 pr-0">
                                                                <select name="hari" class="form-control" id="hari{{ $jadwal->id }}" required>
                                                                    <option value="">Hari...</option>
                                                                    <option {{ $jadwal->hari_jadwal == 'AHAD' ? 'selected' : '' }} value="AHAD">AHAD</option>
                                                                    <option {{ $jadwal->hari_jadwal == 'SENIN' ? 'selected' : '' }} value="SENIN">SENIN</option>
                                                                    <option {{ $jadwal->hari_jadwal == 'SELASA' ? 'selected' : '' }} value="SELASA">SELASA</option>
                                                                    <option {{ $jadwal->hari_jadwal == 'RABU' ? 'selected' : '' }} value="RABU">RABU</option>
                                                                    <option {{ $jadwal->hari_jadwal == 'KAMIS' ? 'selected' : '' }} value="KAMIS">KAMIS</option>
                                                                    <option {{ $jadwal->hari_jadwal == 'JUMAT' ? 'selected' : '' }} value="JUMAT">JUMAT</option>
                                                                    <option {{ $jadwal->hari_jadwal == 'SABTU' ? 'selected' : '' }} value="SABTU">SABTU</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6 pl-0">
                                                                <select name="jam" class="form-control" id="jam{{ $jadwal->id }}" required>
                                                                    <option value="">Jam...</option>
                                                                    @for ($i = 5; $i <= 22; $i++)
                                                                        @php
                                                                            $jam_ = ($i < 10 ? '0'.$i : $i).':00';
                                                                        @endphp
                                                                        <option {{ $jadwal->waktu_jadwal == $jam_ ? 'selected' : '' }} value="{{ $jam_ }}">{{ $jam_ }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label lass="form-label">Jenis</label>
                                                        <select name="jenis" class="form-control"  required>
                                                            <option value="IKHWAN" {{ $jadwal->jenis_jadwal == 'IKHWAN' ? 'selected' : '' }}>IKHWAN</option>
                                                            <option value="AKHWAT" {{ $jadwal->jenis_jadwal == 'AKHWAT' ? 'selected' : '' }}>AKHWAT</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Batasan Peserta</label>
                                                        <input name="jumlahpeserta" class="form-control" type="number" value="{{ $jadwal->jumlah_peserta }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label lass="form-label">Status Belajar</label>
                                                        <select name="statusbelajar" class="form-control" required>
                                                            <option value=""></option>
                                                            <option {{ $jadwal->status_belajar == 'ONLINE' ? 'selected' : '' }} value="ONLINE">ONLINE</option>
                                                            <option {{ $jadwal->status_belajar == 'OFFLINE' ? 'selected' : '' }} value="OFFLINE">OFFLINE</option>
                                                            <option {{ $jadwal->status_belajar == 'ONLINE / OFFLINE' ? 'selected' : '' }} value="ONLINE / OFFLINE">ONLINE / OFFLINE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3 float-right">
                                                        <button type="submit" class="btn btn-outline-success">
                                                            Update
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
                            $first  = $jadwals->firstItem();
                            $end    = $key + $jadwals->firstItem();
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
                {!! $first !!} - {!! $end !!} Dari {!! $jadwals->total() !!} Data
            </div>
        </div><!--col-->

        <div class="col-5">
            <div class="float-right">
                {!! $jadwals->appends(request()->query())->links() !!}
            </div>
        </div><!--col-->
    </div><!--row--> --}}

    {{-- <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div> --}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-0">
                Absen Tahsin<small class="text-muted"> - Angkatan {{ session('angkatan_tahsin') }}</small>
            </h4>
        </div>
    </div><!--card-->

    <div class="card" style="background: #e4e5e6;">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#pengajar" role="tab" aria-controls="pengajar" aria-selected="true">Pengajar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kelas" role="tab" aria-controls="kelas" aria-selected="false">Kelas</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="pengajar" role="tabpanel">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Absensi Pengajar
                            <small class="text-muted">Akumulasi Perbulan</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <div class="row mt-4">
                    <div class="col">
                        <div class="table table-responsive-sm table-hover mb-0 table-sm">
                            <table class="table display compact nowarp" id="jadwaltahsinabsenpengajar" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="150">Pengajar</th>
                                        <th class="text-center">Juni - Juli</th>
                                        <th class="text-center">Juli - Agust</th>
                                        <th class="text-center">Agust - Sept</th>
                                        <th class="text-center">Sept - Nov</th>
                                        <th class="text-center">Total Pertemuan</th>
                                        <th class="text-center">Jumlah Kelas</th>
                                        <th class="text-center">Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $first  = 0;
                                    $end    = 0;
                                    $number = 1;
                                    $n = 1;
                                    @endphp
                                    @foreach($datapengajars as $key=> $tahsin)

                                    @php
                                    // ngambil data per-kelas per-pengajar
                                    $kelas = DB::table('tahsins')
                                            ->where('nama_pengajar', $tahsin->nama_pengajar)
                                            ->select('jadwal_tahsin', 'level_peserta', (DB::raw('COUNT(*) as jumlahkelas ')))
                                            ->groupBy('jadwal_tahsin', 'level_peserta')
                                            ->havingRaw(DB::raw('COUNT(*) > 0'))
                                            ->get();

                                    // deklarasi var hasil penjumlahan angkatan 16
                                    $numjunjul_ = 0;
                                    $numjulgus_ = 0;
                                    $numgussep_ = 0;
                                    $numsepokt_ = 0;
                                    @endphp

                                    <tr>
                                        <td>
                                            {{ $tahsin->nama_pengajar }}
                                        </td>
                                        <td class="text-center">
                                            {{-- Subtitusi jadwal untuk akumulasi pertemuan --}}
                                            @foreach($kelas as $jadwal)

                                                {{-- Mengambil data per-pertemuan absen --}}
                                                @php
                                                    $junjul = DB::table('absens')
                                                            ->where('deleted_at', null)
                                                            ->where('jenis_absen', 'TAHSIN')
                                                            ->where('angkatan_absen', session('angkatan_tahsin'))
                                                            ->where('level_kelas_absen', $jadwal->level_peserta)
                                                            ->where('waktu_kelas_absen', $jadwal->jadwal_tahsin)
                                                            ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                                            ->whereBetween('created_at', ['2020-06-15','2020-07-14']) // perhitungan waktu yg diambil
                                                            ->select('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen', (DB::raw('COUNT(*) as jumlahhadir ')))
                                                            ->groupBy('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen')
                                                            ->havingRaw(DB::raw('COUNT(*) > 0'))
                                                            ->get();
                                                    $numjunjul = 0;
                                                @endphp

                                                {{-- subtitusi data per-pertemuan --}}
                                                @foreach($junjul as $tes)
                                                    @php
                                                    // perhitungan pertemuan
                                                        $numjunjul++;
                                                    @endphp
                                                @endforeach

                                                {{-- <div style="font-size: 10px">
                                                    ( {{ $jadwal->jadwal_tahsin }} - {{ $jadwal->level_peserta }} = {{ $jadwal->jumlahkelas }} Peserta, {{ $numjunjul }} Pertemuan )
                                                </div> --}}

                                                @php
                                                // penjumlahan data pertemuan sesuai pengambilan waktu hitungan bulan
                                                $numjunjul_ = $numjunjul + $numjunjul_;
                                                @endphp

                                            @endforeach
                                            {{ $numjunjul_ }}
                                        </td>
                                        <td class="text-center">
                                            {{-- Subtitusi jadwal untuk akumulasi pertemuan --}}
                                            @foreach($kelas as $jadwal)

                                                {{-- Mengambil data per-pertemuan absen --}}
                                                @php
                                                    $julgus = DB::table('absens')
                                                            ->where('deleted_at', null)
                                                            ->where('jenis_absen', 'TAHSIN')
                                                            ->where('angkatan_absen', session('angkatan_tahsin'))
                                                            ->where('level_kelas_absen', $jadwal->level_peserta)
                                                            ->where('waktu_kelas_absen', $jadwal->jadwal_tahsin)
                                                            ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                                            ->whereBetween('created_at', ['2020-07-15','2020-08-14']) // perhitungan waktu yg diambil
                                                            ->select('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen', (DB::raw('COUNT(*) as jumlahhadir ')))
                                                            ->groupBy('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen')
                                                            ->havingRaw(DB::raw('COUNT(*) > 0'))
                                                            ->get();
                                                    $numjulgus = 0;
                                                @endphp

                                                {{-- subtitusi data per-pertemuan --}}
                                                @foreach($julgus as $tes)
                                                    @php
                                                    // perhitungan pertemuan
                                                        $numjulgus++;
                                                    @endphp
                                                @endforeach

                                                {{-- <div style="font-size: 10px">
                                                    ( {{ $jadwal->jadwal_tahsin }} - {{ $jadwal->level_peserta }} = {{ $jadwal->jumlahkelas }} Peserta, {{ $numjulgus }} Pertemuan )
                                                </div> --}}

                                                @php
                                                // penjumlahan data pertemuan sesuai pengambilan waktu hitungan bulan
                                                $numjulgus_ = $numjulgus + $numjulgus_;
                                                @endphp

                                            @endforeach
                                            {{ $numjulgus_ }}
                                        </td>
                                        <td class="text-center">
                                            {{-- Subtitusi jadwal untuk akumulasi pertemuan --}}
                                            @foreach($kelas as $jadwal)

                                                {{-- Mengambil data per-pertemuan absen --}}
                                                @php
                                                    $gussep = DB::table('absens')
                                                            ->where('deleted_at', null)
                                                            ->where('jenis_absen', 'TAHSIN')
                                                            ->where('angkatan_absen', session('angkatan_tahsin'))
                                                            ->where('level_kelas_absen', $jadwal->level_peserta)
                                                            ->where('waktu_kelas_absen', $jadwal->jadwal_tahsin)
                                                            ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                                            ->whereBetween('created_at', ['2020-08-15','2020-09-14']) // perhitungan waktu yg diambil
                                                            ->select('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen', (DB::raw('COUNT(*) as jumlahhadir ')))
                                                            ->groupBy('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen')
                                                            ->havingRaw(DB::raw('COUNT(*) > 0'))
                                                            ->get();
                                                    $numgussep = 0;
                                                @endphp

                                                {{-- subtitusi data per-pertemuan --}}
                                                @foreach($gussep as $tes)
                                                    @php
                                                    // perhitungan pertemuan
                                                        $numgussep++;
                                                    @endphp
                                                @endforeach

                                                {{-- <div style="font-size: 10px">
                                                    ( {{ $jadwal->jadwal_tahsin }} - {{ $jadwal->level_peserta }} = {{ $jadwal->jumlahkelas }} Peserta, {{ $numgussep }} Pertemuan )
                                                </div> --}}

                                                @php
                                                // penjumlahan data pertemuan sesuai pengambilan waktu hitungan bulan
                                                $numgussep_ = $numgussep + $numgussep_;
                                                @endphp

                                            @endforeach
                                            {{ $numgussep_ }}
                                        </td>
                                        <td class="text-center">
                                            {{-- Subtitusi jadwal untuk akumulasi pertemuan --}}
                                            @foreach($kelas as $jadwal)

                                                {{-- Mengambil data per-pertemuan absen --}}
                                                @php
                                                    $sepokt = DB::table('absens')
                                                            ->where('deleted_at', null)
                                                            ->where('jenis_absen', 'TAHSIN')
                                                            ->where('angkatan_absen', session('angkatan_tahsin'))
                                                            ->where('level_kelas_absen', $jadwal->level_peserta)
                                                            ->where('waktu_kelas_absen', $jadwal->jadwal_tahsin)
                                                            ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                                            ->whereBetween('created_at', ['2020-09-15','2020-10-14']) // perhitungan waktu yg diambil
                                                            ->select('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen', (DB::raw('COUNT(*) as jumlahhadir ')))
                                                            ->groupBy('level_kelas_absen', 'waktu_kelas_absen', 'pertemuan_ke_absen')
                                                            ->havingRaw(DB::raw('COUNT(*) > 0'))
                                                            ->get();
                                                    $numsepokt = 0;
                                                @endphp

                                                {{-- subtitusi data per-pertemuan --}}
                                                @foreach($sepokt as $tes)
                                                    @php
                                                    // perhitungan pertemuan
                                                        $numsepokt++;
                                                    @endphp
                                                @endforeach

                                                {{-- <div style="font-size: 10px">
                                                    ( {{ $jadwal->jadwal_tahsin }} - {{ $jadwal->level_peserta }} = {{ $jadwal->jumlahkelas }} Peserta, {{ $numsepokt }} Pertemuan )
                                                </div> --}}

                                                @php
                                                // penjumlahan data pertemuan sesuai pengambilan waktu hitungan bulan
                                                $numsepokt_ = $numsepokt + $numsepokt_;
                                                @endphp

                                            @endforeach
                                            {{ $numsepokt_ }}
                                        </td>
                                        <td class="text-center" style="font-weight: bold;">
                                            {{-- {{ $tahsin->jumlah }} --}}
                                            @php
                                                $totalp = $numjunjul_ + $numjulgus_ + $numgussep_ + $numsepokt_;
                                            @endphp
                                            {{ $totalp }}
                                        </td>
                                        <td class="text-center" style="font-weight: bold;">
                                            {{ count($kelas) }}
                                        </td>
                                        <td>
                                            @if ($tahsin->jenis_peserta == 'IKHWAN')
                                                <div class="text-center">
                                                    <strong  style="color: #20a8d8!important">{{ $tahsin->jenis_peserta }}</strong>
                                                </div>
                                            @elseif ($tahsin->jenis_peserta == 'AKHWAT')
                                                <div class="text-center">
                                                    <strong  style="color: #e83e8c!important">{{ $tahsin->jenis_peserta }}</strong>
                                                </div>
                                            @else
                                                <div class="text-center">
                                                    -
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                    $number++;
                                    $n = 1;
                                    $first  = $datapengajars->firstItem();
                                    $end    = $key + $datapengajars->firstItem();
                                    @endphp
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div>
            <div class="tab-pane" id="kelas" role="tabpanel">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Jadwal Absensi
                            <small class="text-muted">Waktu Per-pertemuan</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <div class="row mt-4">
                    <div class="col">
                        <div class="table table-responsive-sm table-hover mb-0 table-sm">
                            <table class="table display compact nowarp" id="jadwaltahsinabsen" style="width:100%">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-center">No</th> --}}
                                        <th class="text-center">Jadwal Tahsin</th>
                                        @for ($a = 1; $a <= 15; $a++)
                                        <th class="text-center">
                                            {{ $a }}
                                        </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $first  = 0;
                                    $end    = 0;
                                    $number = 1;
                                    @endphp
                                    @foreach($datajadwals as $key=> $tahsin)
                                    <tr>
                                        {{-- <td class="text-center" >
                                            {{ $key + $datajadwals->firstItem() }}
                                        </td> --}}
                                        <td>
                                            <a href="{{ route('admin.tahsins.absenkelas') }}?pengajar={{ $tahsin->nama_pengajar }}&level={{ $tahsin->level_peserta }}&waktu={{ $tahsin->jadwal_tahsin }}&jenis={{ $tahsin->jenis_peserta }}">
                                                <strong>{{ $tahsin->nama_pengajar }}</strong> - {{ $tahsin->level_peserta }}, {{ $tahsin->jadwal_tahsin }}
                                            </a>
                                        </td>
                                        {{-- @php
                                        $cekuser = DB::table('users')->where('user_pengajar', $tahsin->nama_pengajar )->first();
                                        @endphp --}}
                                        @for ($b = 1; $b <= 15; $b++)
                                        @php
                                        $cek = DB::table('absens')
                                                // ->where('user_create_absen', $cekuser->id ?? 0 )
                                                ->where('pertemuan_ke_absen', $b)
                                                ->where('angkatan_absen', session('angkatan_tahsin'))
                                                ->where('level_kelas_absen', $tahsin->level_peserta)
                                                ->where('waktu_kelas_absen', $tahsin->jadwal_tahsin)
                                                ->where('jenis_kelas_absen', $tahsin->jenis_peserta)
                                                ->where('jenis_absen', 'TAHSIN')
                                                ->first();
                                        @endphp
                                        <td class="text-center" style="font-size: 11px">
                                            @if (isset($cek))
                                            {{ $cek->created_at }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        @endfor

                                    </tr>
                                    @php
                                    $first  = $datajadwals->firstItem();
                                    $end    = $key + $datajadwals->firstItem();
                                    @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div>
        </div>
    </div>

    @push('scripts')
        {{$dataTable->scripts()}}
    @endpush
@endsection
