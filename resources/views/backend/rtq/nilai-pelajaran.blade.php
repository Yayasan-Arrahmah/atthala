@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_rtqs.labels.management'))

@section('breadcrumb-links')
    @include('backend.rtq.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Nilai Mata Pelajaran Santri
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
            </div><!--col-->
        </div><!--row-->
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
                    {{-- @foreach ($perioderapor as $periode)
                        <option value="{{ $periode->id }}">{{ $periode->nama_periode }} - {{ $periode->tahun_ajaran }}</option>
                    @endforeach --}}
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
                    {{-- @foreach ($halaqoh as $hq)
                        <option value="{{ $hq->pengajar_santri }}">{{ $hq->pengajar_santri }}</option>
                    @endforeach --}}
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
                    {{-- @foreach ($halaqoh as $hq)
                        <option value="{{ $hq->pengajar_santri }}">{{ $hq->pengajar_santri }}</option>
                    @endforeach --}}
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
    </div>
</div>
<div class="card">
    <div class="card-body">


        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Perioda</th>
                            <th>@lang('backend_rtqs.table.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- @foreach($rtqs as $rtq)
                            <tr>
                                <td class="align-middle"><a href="/admin/rtqs/{{ $rtq->id }}">{{ $rtq->nama_santri }}</a></td>
                                <td class="align-middle">{!! $rtq->created_at !!}</td>
                                <td class="align-middle">{{ $rtq->updated_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $rtq->action_buttons !!}</td>
                            </tr>
                        @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{-- {!! $rtqs->count() !!} {{ trans_choice('backend_rtqs.table.total', $rtqs->count()) }} --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $rtqs->links() !!} --}}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
