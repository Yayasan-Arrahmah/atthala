<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                Peserta Tahsin<small class="text-muted"> - Angkatan 15</small>

                {{-- {{ __('backend_tahsins.labels.management') }} <small class="text-muted">{{ __('backend_tahsins.labels.active') }}</small> --}}
            </h4>
        </div><!--col-->

        <div class="col-sm-7">
            @include('backend.tahsin.includes.header-buttons')
            <a href=" {{ url()->current() }}/upload" >
                <button class="float-right btn btn-info">
                    <i class="fa fa-upload"></i> Upload Excel
                </button>
            </a>
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
        <div class="col-md-1">
            <select class="form-control" wire:model="perPage">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>

        <div class="col">
        </div>

        <div class="col-md-4 pull-right">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-search"></i> </span>
                </div>
                <input wire:model.debounce.600ms="search" class="form-control" type="text" placeholder="Cari Nama" autocomplete="password" width="100">
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <div class="table table-responsive-sm table-hover mb-0 table-sm">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Jadwal</th>
                            <th class="text-center">Pengajar</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Daftar Ulang</th>
                            <th class="text-center">Angkatan</th>
                            <th width="100" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $first  = 0;
                        $end    = 0;
                        $number = 1;
                        @endphp
                        @foreach($tahsins as $key=> $tahsin)
                        <tr>
                            <td class="text-center" >
                                {{ $key + $tahsins->firstItem() }}
                            </td>
                            <td>
                                <a href="/admin/tahsin/{{ $tahsin->id }}/edit" style="color: rgb(56, 56, 56);">
                                    <div style="text-transform: uppercase;">{{ $tahsin->nama_peserta }}</div>
                                    <div class="small text-muted">
                                        {{ $tahsin->nohp_peserta }}
                                    </div>
                                </a>
                            </td>
                            <td class="text-center">
                                @php
                                    if ($tahsin->level_peserta  == "ASAASI 1") {
                                        $warna = "#20a8d8";
                                    } elseif ($tahsin->level_peserta  == "ASAASI 2") {
                                        $warna = "#20c997";
                                    } elseif ($tahsin->level_peserta  == "TILAWAH ASAASI") {
                                        $warna = "#17a2b8";
                                    } elseif ($tahsin->level_peserta  == "TAMHIDI") {
                                        $warna = "#ffc107";
                                    } elseif ($tahsin->level_peserta  == "TAWASUTHI") {
                                        $warna = "#6610f2";
                                    } elseif ($tahsin->level_peserta  == "TILAWAH TAWASUTHI") {
                                        $warna = "#ffb700";
                                    } elseif ($tahsin->level_peserta  == "I'DADI") {
                                        $warna = "#e83e8c";
                                    } elseif ($tahsin->level_peserta  == "TAKMILI") {
                                        $warna = "#4dbd74";
                                    } elseif ($tahsin->level_peserta  == "TAHSINI") {
                                        $warna = "#b81752";
                                    } elseif ($tahsin->level_peserta  == "ITQON") {
                                        $warna = "#1848f5";
                                    } else {
                                        $warna = "#2f353a";
                                    }
                                @endphp

                                @if ($tahsin->level_peserta == null)
                                @else
                                    <button class="btn btn-sm" style="color: #fff; background-color: {{ $warna }}; border-color: {{ $warna }};">
                                        <i class="fa fa-time-circle-o"></i><strong>{{ $tahsin->level_peserta }}</strong>
                                    </button>
                                @endif
                            </td>
                            <td>
                                {{-- <div>SABTU 07.00</div> --}}
                                <div class="text-center">
                                    <strong>{{ $tahsin->jadwal_tahsin }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div>{{ $tahsin->nama_pengajar }}</div>
                                </div>
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
                            <td>
                                <div lass="text-center" style="color: #73818f!important;">
                                    {{ $tahsin->keterangan_tahsin }}
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{ $tahsin->sudah_daftar_tahsin }}
                                    {{ $tahsin->belum_daftar_tahsin }}
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{ $tahsin->angkatan_peserta }}
                                </div>
                            </td>
                            <td>
                                {{-- <button class="btn btn-danger  btn-sm"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-success  btn-sm"><i class="fa fa-pen"></i></button> --}}
                                <div class="text-center">
                                    {!! $tahsin->action_buttons !!}
                                </div>
                            </td>
                        </tr>
                        @php
                        $first  = $tahsins->firstItem();
                        $end    = $key + $tahsins->firstItem();
                        @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div><!--col-->
    </div><!--row-->
    <div class="row">
        <div class="col-7">
            <div class="float-left">
                {{-- {!! $tahsins->count() !!} {{ trans_choice('backend_tahsins.table.total', $tahsins->count()) }} --}}

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
</div><!--card-body-->
