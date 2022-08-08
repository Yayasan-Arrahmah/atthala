@extends('backend.layouts.app-2')

@section('title', app_name() . '| Tahsin')

@section('content')


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">
                        Administrasi Tahsin - <u>{{ $title ?? 'Peserta' }}</u>
                    </h4>
                </div><!--card-header-->
                <div class="card-body">
                    @include('backend.pendidikan.tahsin.component.filter')
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="legend p-3">
                        <div class="row kotak-atas mb-3">
                            <div class="col pr-0 font-weight-bold text-uppercase">
                                Nama
                            </div>
                            <div class="col-2 font-weight-bold text-uppercase">
                                <div class="pl-4">
                                    Level
                                </div>
                            </div>
                            <div class="col-2 font-weight-bold text-uppercase" style="margin-left: 0px">
                                Pengajar
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                                Status
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
                                <div class="col pr-0">
                                    <a data-toggle="collapse" href="#detail{{ $key + $tahsins->firstItem() }}" aria-expanded="false" style="color: rgb(56, 56, 56);" class="">
                                        <div class="font-weight-bold text-uppercase">
                                            {{ $tahsin->no_tahsin }} - {{ $tahsin->nama_peserta }}
                                        </div>
                                        <div class="small text-muted">
                                            {{ $tahsin->waktu_lahir_peserta }} | {{ $tahsin->nohp_peserta }}
                                        </div>
                                    </a>
                                </div>
                                <div class="col-2">
                                    <div class="row">
                                        <div class="col pr-0" style="text-align: center;">
                                            <span class="fa-stack">
                                                <i class="fa fa-circle fa-stack-2x icon-background" style="color: {{ $tahsin->level->warna ?? '-' }}"></i>
                                                <i class="fa fa-book fa-stack-1x" style="color: #fff"></i>
                                            </span>
                                        </div>
                                        <div class="col-9 pl-0">
                                            <div class="font-weight-bold text-uppercase">
                                                {{ $tahsin->level_peserta }}
                                            </div>
                                            <div class="small text-muted">
                                                {{ $tahsin->jenis_pembelajaran }} | Angkatan {{ $tahsin->angkatan_peserta }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2" style="margin-left: 0px">
                                    <div class="font-weight-bold text-uppercase">{{ $tahsin->nama_pengajar }}</div>
                                    <div class="small text-muted">
                                        {{ $tahsin->jadwal_tahsin }} | {{ $tahsin->jenis_peserta }}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-3">
                                            <span class="badge bg-success">
                                                <i class="fas fa-check"></i> AKTIF
                                            </span>
                                            <div class="small text-muted">
                                                PESERTA UMUM
                                            </div>
                                        </div>
                                        {{-- <div class="col-7">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-exclamation-triangle"></i> Belum Aktif
                                            </button>
                                        </div> --}}
                                        <div class="col text-right" style="padding: 0px">
                                            <div class="btn-group dropleft">
                                                <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                    Opsi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="/admin/transaksi?id=2947&amp;metode=upload" class="dropdown-item">
                                                        Aktif
                                                    </a>
                                                    <a href="/admin/transaksi?id=2947&amp;metode=upload" class="dropdown-item">
                                                        Cuti
                                                    </a>
                                                        <a href="/admin/transaksi?id=2947&amp;metode=edit" class="dropdown-item">
                                                        Off
                                                    </a>
                                                    <a href="#" title="Hapus" data-method="delete" data-trans-button-cancel="Batal" data-trans-button-confirm="Hapus" data-trans-title="rimbaborne@gmail.com dihapus?" class=" dropdown-item" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();">
                                                        <form action="" onsubmit="return confirm('Apakah Anda yakin data Copywriting Next Level - rimbaborne@gmail.com dihapus ?');" style="display:none">
                                                            <input type="hidden" name="metode" value="hapus">
                                                            <input type="hidden" name="id" value="2947">
                                                        </form>
                                                        Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" style="color: #4e4e4e">
                                    <div class="col">
                                        <div class="collapse hide" id="detail{{ $key + $tahsins->firstItem() }}" style="">
                                            <hr>
                                            <form class="row" action="" method="post">
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Nama</label>
                                                        <input type="text" class="form-control" value="{{ $tahsin->nama_peserta }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label lass="form-label">No. HP</label>
                                                                <input type="text" class="form-control" value="{{ $tahsin->nohp_peserta }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <label lass="form-label">Tanggal Lahir</label>
                                                                <input type="text" class="form-control" value="{{ $tahsin->waktu_lahir_peserta }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Jenis</label>
                                                        <input type="text" class="form-control" value="{{ $tahsin->jenis_peserta }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label lass="form-label">Status</label>
                                                        <input type="text" class="form-control" value="WARGA UMUM">
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Level</label>
                                                        <input type="text" class="form-control" value="{{ $tahsin->level_peserta }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label lass="form-label">Pengajar</label>
                                                        <input type="text" class="form-control" value="{{ $tahsin->nama_pengajar }}">
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Jadwal</label>
                                                        <input type="text" class="form-control" value="{{ $tahsin->jadwal_tahsin }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label lass="form-label">Pembelajaran</label>
                                                        <input type="text" class="form-control" value="{{ $tahsin->jenis_pembelajaran }}">
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

@endsection
