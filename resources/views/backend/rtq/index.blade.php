@extends('backend.layouts.app')

@section('title', app_name() . ' | Santri ')

@section('breadcrumb-links')
    @include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
{{-- <div class="card">
    @include('backend.tahsin.includes.cari')
</div> --}}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Santri RTQ
                    {{-- <small class="text-muted"> - Angkatan {{ request()->angkatan ?? session('angkatan_tahsin') }}</small> --}}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.rtq.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <form onmouseover="verifikasi()" class="form-horizontal col-md-12" action="{{ route('admin.tahsins.updatelevel') }}" method="POST" enctype="multipart/form-data" style="padding-top: 20px">
                <div class="form-group row" style="margin-bottom:0px">
                    {{ csrf_field() }}
                    <label class="col-md-1 col-form-label" for="file-input">
                        Pilih File  :
                    </label>
                    <div class="col-md-5">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="upload" required>
                            <label class="custom-file-label" for="upload">Pilih File Tambah Santri</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button id="btnupload" type="submit" class="btn btn-primary btn-block" >Upload File</button>
                    </div>
                </div>
            </form>
        </div>
        <form action="{{ Request::fullUrl() }}" class="row mt-4">
            <div class="col-md-1">
                <select class="form-control mt-4" name="perPage" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="text-muted text-center" style="position: absolute">
                    Periode
                 </div>
                <select class="form-control mt-4" name="periode" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->periode)
                        @php
                            $periode_ = DB::table('rtq_periode_rapors')->where('id', request()->periode)->first();
                        @endphp
                        <option value="{{ request()->periode }}">{{ $periode_->nama_periode }} - {{ $periode_->tahun_ajaran }}</option>
                        <option value="">-------</option>
                    @endisset
                    @foreach ($perioderapor as $periode)
                        <option value="{{ $periode->id }}">{{ $periode->nama_periode }} - {{ $periode->tahun_ajaran }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <div class="text-muted text-center" style="position: absolute">
                    Status
                 </div>
                <select class="form-control mt-4" name="status" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->status)
                        <option value="{{ request()->status }}">{{ request()->status }}</option>
                        <option value="">-------</option>
                    @endisset
                        <option value="SEMUA">SEMUA</option>
                        <option value="ASUH">ASUH</option>
                        <option value="MANDIRI">MANDIRI</option>
                        <option value="BEASISWA">BEASISWA</option>
                        <option value="SUBSIDI">SUBSIDI</option>
                </select>
            </div>
            @if (auth()->user()->last_name === 'Admin')
            <div class="col-md-1">
                <div class="text-muted text-center" style="position: absolute">
                Angkatan
                 </div>
                <select class="form-control mt-4" name="angkatan" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->angkatan)
                        <option value="{{ request()->angkatan }}">{{ request()->angkatan }}</option>
                        <option value="">-------</option>
                    @endisset
                    <option value="SEMUA">SEMUA</option>
                    @for ($i = 1; $i < 8; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-1">
                <div class="text-muted text-center" style="position: absolute">
                Jenis
                 </div>
                <select class="form-control mt-4" name="jenis" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->jenis)
                        <option value="{{ request()->jenis }}">{{ request()->jenis }}</option>
                        <option value="">-------</option>
                    @endisset
                    <option value="SEMUA">SEMUA</option>
                    <option value="IKHWAN">IKHWAN</option>
                    <option value="AKHWAT">AKHWAT</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="text-muted text-center" style="position: absolute">
                    Halaqoh
                 </div>
                <select class="form-control mt-4" name="halaqoh" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->halaqoh)
                        <option value="{{ request()->halaqoh }}">{{ request()->halaqoh }}</option>
                        <option value="">-------</option>
                    @endisset
                    @foreach ($halaqoh as $hq)
                        <option value="{{ $hq->pengajar_santri }}">{{ $hq->pengajar_santri }}</option>
                    @endforeach
                </select>
            </div>
            @else
            <div class="col-md-2">
                <div class="text-muted text-center" style="position: absolute">
                Angkatan
                 </div>
                <select class="form-control mt-4" name="angkatan" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->angkatan)
                        <option value="{{ request()->angkatan }}">{{ request()->angkatan }}</option>
                        <option value="">-------</option>
                    @endisset
                    <option value="SEMUA">SEMUA</option>
                    @for ($i = 1; $i < 8; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <div class="text-muted text-center" style="position: absolute">
                    Halaqoh
                 </div>
                <select class="form-control mt-4" name="halaqoh" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @isset(request()->halaqoh)
                        <option value="{{ request()->halaqoh }}">{{ request()->halaqoh }}</option>
                        <option value="">-------</option>
                    @endisset
                    <option value="SEMUA">SEMUA</option>
                    @foreach ($halaqoh as $hq)
                        <option value="{{ $hq->pengajar_santri }}">{{ $hq->pengajar_santri }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="col-md-3">
                <div class="pull-right input-group mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-search"></i> </span>
                    </div>
                    <input name="nama" value="{{ request()->nama ?? '' }}" class="form-control" type="text" placeholder="Cari Nama" autocomplete="password" width="100">
                </div>
            </div>
        </form>
        <div class="row mt-4">
            <div class="col">
                <div class="table table-responsive-sm table-hover mb-0 table-sm">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th class="text-center">Verifikasi Mudir</th>
                                <th class="text-center">Status</th>
                                @if (auth()->user()->last_name == 'Admin')
                                    <th class="text-center">Jenis</th>
                                @endif
                                <th class="text-center">Halaqoh</th>
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
                            @foreach($rtqs as $key=> $rtq)
                                <tr>
                                    <td class="text-center" >
                                        {{ $key + $rtqs->firstItem() }}
                                    </td>
                                    <td>
                                        <a href="/admin/rtq/{{ $rtq->id }}/edit" style="color: rgb(56, 56, 56);">
                                            <div style="text-transform: uppercase;">{{ $rtq->nama_santri }}</div>
                                            <div class="small text-muted">
                                                {{ $rtq->nis_santri }} | {{ $rtq->notelp_santri }}
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center" style="font-weight: 800">
                                        @php
                                            $verifikasi = DB::table('rtq_rapors')
                                                        ->where('id_periode_rapor', request()->periode ?? $setperioderapor->id)
                                                        ->where('id_santri', $rtq->id)
                                                        ->first();
                                        @endphp

                                        @if ($verifikasi == null)
                                            <div style="color: #e70f0f!important">BELUM DINILAI</div>
                                        @else
                                            @if ( $verifikasi->verifikasi_rapor == null)
                                                <div style="color: #e79b0f!important">BELUM DIVERIFIKASI</div>
                                            @else
                                                <div style="color: #4dbd74!important">{{ $verifikasi->verifikasi_rapor }}</div>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $rtq->status_santri }}
                                    </td>
                                    @if (auth()->user()->last_name == 'Admin')
                                        <td class="text-center">
                                            @if ($rtq->jenis_santri == 'IKHWAN')
                                                <div class="text-center">
                                                    <strong  style="color: #20a8d8!important">{{ $rtq->jenis_santri }}</strong>
                                                </div>
                                            @elseif ($rtq->jenis_santri == 'AKHWAT')
                                                <div class="text-center">
                                                    <strong  style="color: #e83e8c!important">{{ $rtq->jenis_santri }}</strong>
                                                </div>
                                            @else
                                                <div class="text-center">
                                                    -
                                                </div>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        <div class="text-center">
                                            {{ $rtq->pengajar_santri }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{ $rtq->angkatan_santri }}
                                        </div>
                                    </td>

                                    <td>
                                        {{-- <button class="btn btn-danger  btn-sm"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-success  btn-sm"><i class="fa fa-pen"></i></button> --}}
                                        <div class="text-center">
                                            {!! $rtq->action_buttons !!}
                                            <a data-turbolinks="false" target="_blank" href="{{ route('admin.rtqs.prosesrapor') }}?id={{ $rtq->id }}&periode={{ request()->periode ?? $setperioderapor->id }}" class="btn btn-block btn-success btn-sm mt-2">Nilai Rapor</a>
                                        </div>
                                    </td>
                                </tr>
                            @php
                            $first  = $rtqs->firstItem();
                            $end    = $key + $rtqs->firstItem();
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
                    {{-- {!! $rtqs->count() !!} {{ trans_choice('backend_rtqs.table.total', $rtqs->count()) }} --}}

                    {!! $first !!} - {!! $end !!} Dari {!! $rtqs->total() !!} Data
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $rtqs->links() !!} --}}
                    {!! $rtqs->appends(request()->query())->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    {{-- @livewire('rtq.peserta') --}}
</div><!--card-->
@endsection
