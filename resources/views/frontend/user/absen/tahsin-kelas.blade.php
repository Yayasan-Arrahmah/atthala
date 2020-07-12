@extends('frontend.user.layout')

@section('user')

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
            <div class="col-8 info-absen">: Juli - November 2020</div>
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
<div class="row" style="font-size: 13px; font-weight: 500; text-align: center; padding-bottom: 8px">
    <div class="mx-auto">
        <form action="{{ route('frontend.user.absentahsinkelas') }}" method="get">
            <input name="waktu" value="{{ $waktu }}" hidden>
            <input name="jenis" value="{{ $jenis }}" hidden>
            <input name="level" value="{{ $level }}" hidden>
            <label>Tampilkan pertemuan ke :</label>
            <select name="ke" onchange='if(this.value != 0) { this.form.submit(); }' style="font-size: 15px; font-weight: 600; padding: 2px 5px">
                @isset($pertemuanke)
                <option value="{{ $pertemuanke }}">{{ $pertemuanke }}</option>
                <option>-----</option>
                @endisset
                <option value="semua">Semua</option>
                @for ($i = 1; $i <= 15; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center" style="font-weight: 600; padding-bottom: 20px ">
                <div class="ab" >
                    <table id="absen" class="table table-striped table-sm">
                        <thead >
                            <tr>
                                <th style="vertical-align: middle;">Peserta</th>
                                @if($pertemuanke == 'semua' || !isset($pertemuanke))
                                @for ($i = 1; $i <= 15; $i++)
                                <th class="text-center" style="padding: 4px 25px 4px 25px;">{{ $i }}
                                    @php
                                    $cektanggal = $absen->where('user_create_absen', auth()->user()->id)
                                    ->where('pertemuan_ke_absen', $i)
                                    ->where('angkatan_absen', $angkatan)
                                    ->where('waktu_kelas_absen', $waktu)
                                    ->where('level_kelas_absen', $level)
                                    ->where('jenis_kelas_absen', $jenis)
                                    ->first()
                                    @endphp
                                    @isset($cektanggal)
                                    <div class="text-muted" style="font-size: 10px">
                                        {{ $cektanggal->created_at->format('d-m-Y') }}
                                    </div>
                                    @endisset
                                </th>
                                @endfor
                                @elseif(isset($pertemuanke))
                                <th class="text-center" style="padding: 4px 25px 4px 25px;">{{ $pertemuanke }}
                                    @php
                                    $cektanggal = $absen->where('user_create_absen', auth()->user()->id)
                                    ->where('pertemuan_ke_absen', $pertemuanke)
                                    ->where('angkatan_absen', $angkatan)
                                    ->where('waktu_kelas_absen', $waktu)
                                    ->where('level_kelas_absen', $level)
                                    ->where('jenis_kelas_absen', $jenis)
                                    ->first()
                                    @endphp
                                    @isset($cektanggal)
                                    <div class="text-muted" style="font-size: 10px">
                                        {{ $cektanggal->created_at->format('d-m-Y') }}
                                    </div>
                                    @endisset
                                </th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $datapeserta as $peserta )
                            <tr>
                                <td class="text-left">
                                    <div style="text-transform: uppercase;">{{ $peserta->nama_peserta }}</div>
                                    <div class="small text-muted">
                                        {{ $peserta->no_tahsin }} | {{ $peserta->nohp_peserta }}
                                    </div>
                                </td>
                                @if($pertemuanke == 'semua' || !isset($pertemuanke))
                                @for ($i = 1; $i <= 15; $i++)
                                <td class="text-center">
                                    <form action="{{ route('frontend.user.absentahsininput') }}" method="post">
                                        @csrf
                                        <input name="peserta" value="{{ $peserta->id  }}" hidden>
                                        <input name="pertemuan" value="{{ $i }}" hidden>
                                        <input name="waktu" value="{{ $waktu }}" hidden>
                                        <input name="jenis" value="{{ $jenis }}" hidden>
                                        <input name="level" value="{{ $level }}" hidden>
                                        <select style="font-size: .65rem; font-weight: 600; width: auto;" class="form-control" id="{{ $peserta->id  }}-{{ $i }}" name="keteranganabsen" onchange='if(this.value != 0) { this.form.submit(); }'>
                                            @php
                                            $cek = $absen->where('id_peserta', $peserta->id )->where('pertemuan_ke_absen', $i)->where('angkatan_absen', $angkatan)->first()
                                            @endphp
                                            @isset($cek)
                                            <option value="{{ $cek->keterangan_absen }}">{{ $cek->keterangan_absen }}</option>
                                            @endisset
                                            <option value="0">-</option>
                                            <option value="HADIR">HADIR</option>
                                            <option value="TIDAK HADIR">TIDAK HADIR</option>
                                            <option value="IZIN">IZIN</option>
                                            <option value="SAKIT">SAKIT</option>
                                        </select>
                                        <input name="idabsen" value="{{ $cek->id ?? ''}}" hidden>
                                    </form>
                                </td>
                                @endfor
                                @elseif(isset($pertemuanke))
                                <td class="text-center">
                                    <form action="{{ route('frontend.user.absentahsininput') }}" method="post">
                                        @csrf
                                        <input name="peserta" value="{{ $peserta->id  }}" hidden>
                                        <input name="pertemuan" value="{{ $pertemuanke }}" hidden>
                                        <input name="waktu" value="{{ $waktu }}" hidden>
                                        <input name="jenis" value="{{ $jenis }}" hidden>
                                        <input name="level" value="{{ $level }}" hidden>
                                        <select style="font-weight: 700;" class="form-control" id="{{ $peserta->id  }}-{{ $pertemuanke }}" name="keteranganabsen" onchange='if(this.value != 0) { this.form.submit(); }'>
                                            @php
                                            $cek = $absen->where('id_peserta', $peserta->id )->where('pertemuan_ke_absen', $pertemuanke)->where('angkatan_absen', $angkatan)->first()
                                            @endphp
                                            @isset($cek)
                                            <option value="{{ $cek->keterangan_absen }}">{{ $cek->keterangan_absen }}</option>
                                            @endisset
                                            <option value="0">-</option>
                                            <option value="HADIR">HADIR</option>
                                            <option value="TIDAK HADIR">TIDAK HADIR</option>
                                            <option value="IZIN">IZIN</option>
                                            <option value="SAKIT">SAKIT</option>
                                        </select>
                                        <input name="idabsen" value="{{ $cek->id ?? '' }}" hidden>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!--row-->
{{-- @livewire('absen-tahsin') --}}
@endsection
