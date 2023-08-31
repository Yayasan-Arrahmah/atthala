@extends('frontend.user.layout')

@section('user')
@stack('before-styles')
    {{-- <link href="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"> --}}
@stack('after-styles')
<div class="row" >
    <div class="col-md-12">
        <ol class="breadcrumb" style="padding: .3rem .3rem;">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/absen/tahsin">Absen</a></li>
            <li class="breadcrumb-item active">Tahsin - {{ $level }} {{ $waktu }}</li>
        </ol>
    </div>
</div>
<div class="row" style="padding-bottom: 30px">
    <div class="col">
        <div class="text-center" style="font-size: 19px; font-weight: 600">
            Absensi Tahsin
        </div>
    </div><!--col-md-6-->
</div><!--row-->
<div class="row mb-4" style="font-size: 13px; font-weight: 500">
    <div class="col-md-6">
        <div class="row">
            <div class="col-4">Jenis Absen</div>
            <div class="col-8 info-absen">: {{ $jenis }}</div>
        </div>
        <div class="row">
            <div class="col-4">Angkatan</div>
            <div class="col-8 info-absen">: {{ $angkatan }}</div>
        </div>
        <div class="row">
            <div class="col-4">Periode</div>
            <div class="col-8 info-absen">: -</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-4">Pengajar</div>
            <div class="col-8 info-absen">: {{ $userpengajar }}</div>
        </div>
        <div class="row">
            <div class="col-4">Level</div>
            <div class="col-8 info-absen">: {{ $level }}</div>
        </div>
        <div class="row">
            <div class="col-4">Waktu</div>
            <div class="col-8 info-absen">: {{ $waktu }}</div>
        </div>
    </div>
</div>
<div id="spinner" class="row" style=" text-align: end; display: none;">
    <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 9999; background: rgba(0,0,0,.3); margin: 0 1; ">
        <div style=" position: relative; border-radius: .3125em; font-family: inherit; top: 50%; left: 50%; transform: translate(-100%, 100%); color: #fff; ">
            <span class="spinner-border" role="status" aria-hidden="true"></span>
        </div>
        <div style=" position: relative; border-radius: .3125em; font-family: inherit; top: 50%; left: 60%; transform: translate(-100%, 100%); color: #fff; ">
            <label class="small">
                Sedang Menyimpan Data ...
            </label>
        </div>
    </div>
</div>
<div class="row" style="font-size: 13px; font-weight: 500; text-align: center; padding-bottom: 8px">
    <div class="mx-auto">
        <form action="{{ route('frontend.user.absentahsinkelas') }}" method="get">
            <input name="waktu" value="{{ $waktu }}" hidden>
            <input name="jenis" value="{{ $jenis }}" hidden>
            <input name="level" value="{{ $level }}" hidden>
            <label>Tampilkan pertemuan ke :</label>
            <select id="ke" name="ke" onchange='if(this.value != 0) { this.form.submit(); }' style="font-size: 15px; font-weight: 600; padding: 2px 5px">
                {{-- @isset($pertemuanke)
                    <option value="{{ $pertemuanke }}">{{ $pertemuanke }}</option>
                    <option>-----</option>
                @endisset --}}
                <option value="semua">Semua</option>

                @for ($i = 1; $i <= 16; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor

                <option value="level">Level Hasil Ujian</option>
            </select>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center" style="font-weight: 600; padding-bottom: 20px ">
                <div class="ab" >
                    @if($pertemuanke == 'semua')
                        @include('frontend.user.absen.tahsin-kelas-rekap')
                    @elseif ($pertemuanke == 'level')
                        @include('frontend.user.absen.tahsin-kelas-hasil-ujian')
                    @elseif ($pertemuanke > 0 && $pertemuanke < 17)
                        @include('frontend.user.absen.tahsin-kelas-pertemuan')
                    @else
                    TERJADI KESALAHAN DATA
                    @endif
                </div>
            </div>
        </div>
    </div>
</div><!--row-->
{{-- @livewire('absen-tahsin') --}}
@stack('before-scripts')
<script type="text/javascript">
    $(document).ready(function(){
            $("#ke").val("{!! $pertemuanke !!}");
    });
</script>
{{-- <script type="text/javascript">
    $( document ).ready(function() {
        $('#username').editable({
            type: 'text',
            pk: 1,
            url: '/post',
            title: 'Enter username'
        });
    });
</script> --}}

@stack('after-scripts')
@endsection
