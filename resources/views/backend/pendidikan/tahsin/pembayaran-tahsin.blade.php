@extends('backend.layouts.app-2')

@section('title', app_name() . '| Tahsin')

@section('content')
    <style>
        /* table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        } */
        div.dt-buttons {
            float: none !important;
        }

    </style>
    <script src="
    https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/js/jquery.dataTables.min.js
    "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/css/jquery.dataTables.min.css
    " rel="stylesheet">
    <script src="
    https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js
    "></script>
    <script src="
    https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js
    "></script>
    <script src="
    https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
    "></script>
    <script src="
    https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
    "></script>
    <script src="
    https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js
    "></script>
    <script src="
    //cdn.datatables.net/plug-ins/1.13.6/api/sum().js
    "></script>
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css
    " rel="stylesheet">
    <script>
        $(document).ready( function () {
        $('#rekap').DataTable({
            "autoWidth": true,
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: 'Download Data Excel',
                    title: 'Riwayat Pembayaran Peserta Tahsin Angkatan {!! request()->angkatan ?? 22 !!}',
                }
            ],
        });
    } );
    </script>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">
                        Rekapitulasi Pembayaran - <u>{{ $title ?? 'Peserta' }}</u>
                    </h4>
                </div><!--card-header-->
                <div class="card-body">
                    @include('backend.pendidikan.tahsin.component.filter-tahsin')
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    {{-- <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="pt-2 font-weight-bold">Total Perhitungan</h5>
                            <hr>
                            <table class="table table-sm table-borderless mb-0" style="font-size: 15px">
                                <tbody>
                                    <tr>
                                        <td>Daftar Baru</td>
                                        <td>: </td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'daftar_baru'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daftar Ulang</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'daftar_ulang'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daftar Ujian</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SPP</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'spp'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="text-info font-weight-bold">
                                        <td>Total Pendapatan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'total'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="text-success font-weight-bold">
                                        <td>Potensi Pendapatan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'total_potensi'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="text-danger font-italic font-weight-bold">
                                        <td>Piutang</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right ">
                                            {{ number_format(data_get($data_pembayaran, 'total_piutang'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4" style="background-color: #fafafa;">
                            <h5 class="pt-2 font-weight-bold">Total Perhitungan Ikhwan</h5>
                            <hr>
                            <table class="table table-sm table-borderless mb-0" style="font-size: 15px">
                                <tbody>
                                    <tr>
                                        <td>Daftar Baru</td>
                                        <td>: </td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'daftar_baru_ikhwan'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daftar Ulang</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'daftar_ulang_ikhwan'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daftar Ujian</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SPP</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'spp_ikhwan'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="text-info font-weight-bold">
                                        <td>Total Pendapatan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'total_ikhwan'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="text-success font-weight-bold">
                                        <td>Potensi Pendapatan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'total_potensi_ikhwan'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="text-danger font-italic font-weight-bold">
                                        <td>Piutang</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right ">
                                            {{ number_format(data_get($data_pembayaran, 'total_piutang_ikhwan'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <h5 class="pt-2 font-weight-bold">Total Perhitungan Akhwat</h5>
                            <hr>
                            <table class="table table-sm table-borderless mb-0" style="font-size: 15px">
                                <tbody>
                                    <tr>
                                        <td>Daftar Baru</td>
                                        <td>: </td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'daftar_baru_akhwat'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daftar Ulang</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'daftar_ulang_akhwat'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daftar Ujian</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SPP</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'spp_akhwat'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="text-info font-weight-bold">
                                        <td>Total Pendapatan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'total_akhwat'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="text-success font-weight-bold">
                                        <td>Potensi Pendapatan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right">
                                            {{ number_format(data_get($data_pembayaran, 'total_potensi_akhwat'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="text-danger font-italic font-weight-bold">
                                        <td>Piutang</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">
                                            Rp
                                        </td>
                                        <td class="font-weight-bold text-right ">
                                            {{ number_format(data_get($data_pembayaran, 'total_piutang_akhwat'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row--> --}}

    {{-- <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="legend p-3">
                        <div class="row kotak-atas mb-3">
                            <div class="col font-weight-bold text-uppercase">
                                Nama
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                                Pembayaran Ke-
                            </div>
                            <div class="col font-weight-bold text-uppercase" style="margin-left: 0px">
                                Total
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                                Status
                            </div>
                            <div class="col font-weight-bold text-uppercase">
                            </div>
                        </div>
                        @php
                            $first  = 0;
                            $end    = 0;
                            $number = 1;
                        @endphp
                        @foreach($tahsins as $key=> $tahsin)
                            <div class="row kotak mb-1" style="border-left-color: {{ $tahsin->level != null ? $tahsin->level->warna : '' }} !important; border-left-width: 4px!important;">
                                <td>{{ $key + $tahsins->firstItem() }}</td>
                                <div class="col pr-0">
                                    <a data-toggle="collapse" href="#detail{{ $key + $tahsins->firstItem() }}" aria-expanded="false" style="color: rgb(56, 56, 56);" class="">
                                        <div class="font-weight-bold text-uppercase">
                                            {{ $tahsin->no_tahsin }} - {{ $tahsin->nama_peserta }}
                                        </div>
                                        <div class="small text-muted">
                                            <strong style="color:  {{ $tahsin->level != null ? $tahsin->level->warna : '' }} !important">{{ $tahsin->level_peserta ?? 'BELUM PILIH LEVEL'  }}</strong>
                                            |
                                            {{ $tahsin->waktu_lahir_peserta ? \Carbon\Carbon::createFromFormat('d-m-Y', $tahsin->waktu_lahir_peserta ?? '01-01-1901')->format('md') : '' }}
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <table>
                                        <tbody>
                                            @php
                                                $nominal = 0;
                                            @endphp
                                            @foreach ($tahsin->pembayaran as $datapembayaran)
                                                <tr class="text-muted">
                                                    <td>
                                                        {{ $datapembayaran->keterangan_pembayaran ?? 'Daftar' }}
                                                    </td>
                                                    <td>
                                                        -
                                                    </td>
                                                    <td>
                                                        Rp. {{ number_format($datapembayaran->nominal_pembayaran , 0, '.', '.') }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $nominal = $nominal + $datapembayaran->nominal_pembayaran;
                                                @endphp
                                            @endforeach
                                            @if ($tahsin->pembayaranujian($tahsin->angkatan_peserta))
                                                <tr class="text-muted">
                                                    <td>
                                                        {{ 'Daftar Ujian' }}
                                                    </td>
                                                    <td>
                                                        -
                                                    </td>
                                                    <td>
                                                        {{ $tahsin->pembayaranujian($tahsin->angkatan_peserta)->status_pelunasan }} LUNAS
                                                    </td>
                                                </tr>
                                            @else
                                            <tr class="text-muted">
                                                <td>
                                                    Belum Daftar Ujian
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col" style="margin-left: 0px">
                                    <div class="text-muted font-weight-bold">
                                        Rp. {{ number_format($nominal , 0, '.', '.') }}
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col-12" style="color: #4e4e4e">
                                    <div class="col">
                                        <div class="collapse hide" id="detail{{ $key + $tahsins->firstItem() }}" style="">
                                            <hr>
                                            <form class="row" action="" method="post">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Tanggal Lahir</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $tahsin->tempat_lahir_peserta }}, {{ $tahsin->waktu_lahir_peserta }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nomor HP</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $tahsin->nohp_peserta }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jadwal Tahsin</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $tahsin->jadwal_tahsin }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Pengajar</td>
                                                                    <td>:</td>
                                                                    <td class="font-weight-bold">{{ $tahsin->nama_pengajar }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <table class="table table-sm table-bordered">
                                                        <tbody>
                                                            @php
                                                                $nominal_ = 0;
                                                            @endphp
                                                            @foreach ($tahsin->pembayaran as $datapembayaran_)
                                                                <tr class="font-weight-bold">
                                                                    <td>
                                                                        {{ $datapembayaran_->keterangan_pembayaran ?? 'Daftar' }}
                                                                    </td>
                                                                    <td>
                                                                        Rp. {{ number_format($datapembayaran_->nominal_pembayaran , 0, '.', '.') }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $datapembayaran_->created_at }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($datapembayaran_->keterangan_pembayaran)
                                                                            <img class="zoom"
                                                                                src="https://atthala.arrahmahbalikpapan.or.id/bukti-transfer-spp/{{ $datapembayaran_->bukti_transfer_pembayaran ?? '404.jpg' }}"
                                                                                alt="" height="50">
                                                                        @else
                                                                            <img class="zoom"
                                                                                src="https://atthala.arrahmahbalikpapan.or.id/app/public/bukti-transfer/{{ $datapembayaran_->bukti_transfer_pembayaran ?? '404.jpg' }}"
                                                                                alt="" height="50">
                                                                        @endif

                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $nominal_ = $nominal_ + $datapembayaran_->nominal_pembayaran;
                                                                @endphp
                                                            @endforeach
                                                            @if ($tahsin->pembayaranujian($tahsin->angkatan_peserta))
                                                                <tr class="font-weight-bold">
                                                                    <td>
                                                                        {{ 'Daftar Ujian' }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $tahsin->pembayaranujian($tahsin->angkatan_peserta)->status_pelunasan }} LUNAS
                                                                    </td>
                                                                    <td>
                                                                        {{ $tahsin->pembayaranujian($tahsin->angkatan_peserta)->created_at }}
                                                                    </td>
                                                                    <td>
                                                                        <img class="zoom"
                                                                                src="https://atthala.arrahmahbalikpapan.or.id/bukti-transfer-daftar-ujian/{{ $tahsin->pembayaranujian($tahsin->angkatan_peserta)->bukti_transfer ?? '404.jpg' }}"
                                                                                alt="" height="50">
                                                                    </td>
                                                                </tr>
                                                            @else
                                                            <tr class="font-weight-bold">
                                                                <td>
                                                                    Belum Daftar Ujian
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label lass="form-label">Nominal</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-sm btn-primary">Perbaruhi</button>
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
    </div> --}}

    <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table table-lg table-striped display nowrap" id="rekap" width="100%">
                        <thead style="font-weight: bold;">
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>No. Telp</th>
                                <th>Level</th>
                                <th>Kelas</th>
                                <th>Pengajar</th>
                                <th>Kode Unik</th>
                                <th>Pendaftaran</th>
                                <th>Daftar Ulang</th>
                                <th>
                                    {{ request()->angkatan == 22 || empty(request()->angkatan) ? 'JUN 2023' : 'SPP - I' }}
                                </th>
                                <th>
                                    {{ request()->angkatan == 22 || empty(request()->angkatan) ? 'JUL 2023' : 'SPP - II' }}
                                </th>
                                <th>
                                    {{ request()->angkatan == 22 || empty(request()->angkatan) ? 'AGU 2023' : 'SPP - III' }}
                                </th>
                                <th>
                                    {{ request()->angkatan == 22 || empty(request()->angkatan) ? 'SEP 2023' : 'SPP - IV' }}
                                </th>
                                <th>Status</th>
                                <th>Total Tercatat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $first  = 0;
                                $end    = 0;
                                $number = 1;
                                $angkt  = request()->angkatan ?? 22;
                                $nom_daftar = 0;
                                $nom_ulang = 0;
                                $nom_jun = 0;
                                $nom_jul = 0;
                                $nom_agu = 0;
                                $nom_sep = 0;
                                $nom_total = 0;
                            @endphp
                        @foreach($tahsins as $key => $tahsin)
                        <tr style="padding: 5px">
                            @php
                                $no_ = $key + $tahsins->firstItem();
                            @endphp
                            <td>{{ $no_ }}</td>
                            <td>{{ $tahsin->no_tahsin }}</td>
                            <td>{{ $tahsin->nama_peserta }}</td>
                            <td>62{{ $tahsin->nohp_peserta }}</td>

                            <td>{{ $tahsin->level_peserta ?? '-'  }}</td>
                            <td>{{ $tahsin->jadwal_tahsin ?? '-'  }}</td>
                            <td>{{ $tahsin->nama_pengajar ?? '-'  }}</td>

                            <td><center>{{ str_pad( $no_, 4, '0', STR_PAD_LEFT) }}</center></td>
                            <td>
                                @if ($angkt > 16)
                                    @if (strpos($tahsin->no_tahsin, '-'.$angkt.'-'))
                                        Rp. 100.000
                                        @php
                                            $nom_daftar = $nom_daftar + 100000;
                                        @endphp
                                    @else
                                        <center> - </center>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($angkt > 18)
                                    @if (!strpos($tahsin->no_tahsin, '-'.$angkt.'-'))
                                        Rp. 50.000
                                        @php
                                            $nom_ulang = $nom_ulang + 50000;
                                        @endphp
                                    @else
                                        <center> - </center>
                                    @endif
                                @else
                                    -
                                @endif

                            </td>
                                @php
                                    if ($tahsin->pembayaran) {
                                        $jumlah = $tahsin->pembayaran->sum('nominal_pembayaran');
                                    } else {
                                        $jumlah = 0;
                                    }
                                @endphp
                            <td>
                                @if ($jumlah > 100000)
                                    Rp. 100.000
                                    @php
                                        $nom_jun = $nom_jun + 100000;
                                    @endphp
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jumlah > 200000)
                                    Rp. 100.000
                                    @php
                                        $nom_jul = $nom_jul + 100000;
                                    @endphp
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jumlah > 300000)
                                    Rp. 100.000
                                    @php
                                        $nom_agu = $nom_agu + 100000;
                                    @endphp
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jumlah > 400000)
                                    Rp. 100.000
                                    @php
                                        $nom_sep = $nom_sep + 100000;
                                    @endphp
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jumlah > 400000)
                                    LUNAS
                                @else
                                    @if ($tahsin->pembayaranujian($tahsin->angkatan_peserta))
                                       LUNAS DI FORM UJIAN
                                    @else
                                        (Belum Isi Form Ujian) / N.A
                                    @endif
                                @endif

                            </td>
                            <td>
                                Rp. {{ !empty($jumlah) ? number_format($jumlah , 0, '.', '.') : '-' }}
                                @php
                                    $nom_total = $nom_total + $jumlah;
                                @endphp
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>TOTAL</th>
                                <th>Rp. {{ !empty($nom_daftar) ? number_format($nom_daftar , 0, '.', '.') : '0' }}</th>
                                <th>Rp. {{ !empty($nom_ulang) ? number_format($nom_ulang , 0, '.', '.') : '0' }}</th>
                                <th>Rp. {{ !empty($nom_jun) ? number_format($nom_jun , 0, '.', '.') : '0' }}</th>
                                <th>Rp. {{ !empty($nom_jul) ? number_format($nom_jul , 0, '.', '.') : '0' }}</th>
                                <th>Rp. {{ !empty($nom_agu) ? number_format($nom_agu , 0, '.', '.') : '0' }}</th>
                                <th>Rp. {{ !empty($nom_sep) ? number_format($nom_sep , 0, '.', '.') : '0' }}</th>
                                <th></th>
                                <th>Rp. {{ !empty($nom_total) ? number_format($nom_total , 0, '.', '.') : '0' }}</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>PENDAPATAN</th>
                                <th>Rp. {{ number_format($nom_daftar+$nom_ulang+$nom_jun+$nom_jul+$nom_agu+$nom_sep , 0, '.', '.') }}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
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
