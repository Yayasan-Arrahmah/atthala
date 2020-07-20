@extends('frontend.user.layout')

@section('user')
{{-- {{ \GeniusTS\HijriDate\Hijri::setDefaultAdjustment(-1) }} --}}
@php
    $tanggalan = \Carbon\Carbon::now();
@endphp
<div class="row" >
    <div class="col-md-12">
        <ol class="breadcrumb" style="padding: .3rem .3rem;">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Amal Yaumiah</li>
        </ol>
    </div>
</div>

<div class="row" style="padding-bottom: 30px">
    <div class="col">
        <div class="" style="font-size: 24px">
            Ahlan Wa Sahlan, {{ $logged_in_user->first_name }}
        </div>
    </div><!--col-md-6-->
</div><!--row-->

{{-- <div class="row" style="padding-bottom: 20px">
    <div class="col">
        <img src="{{ asset('img/banner-1.png') }}" class="img-fluid" />
    </div>
</div> --}}

{{-- <div class="row mt-4 mb-4">
    <div class="col-md-3">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="card-title mb-0 text-center">
                    @php
                    $totalpeserta = DB::table('users')->where('last_name', '=', 'KARYAWAN')->orWhere('last_name', '=', 'PENGAJAR')->orWhere('last_name', '=', 'SANTRI')->count();
                    @endphp
                    Peserta
                </h6>
            </div><!--col-->
        </div>
        <br />
        <div class="chart-wrapper">
            <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                </div>
                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                </div>
            </div>
            <canvas id="jenis-peserta" width="500" height="400" class="chartjs-render-monitor" style="display: block; width: 300px; height: 265px;"></canvas>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="card-title mb-0 text-center">
                    @php
                    $totalpeserta = DB::table('users')->where('last_name', '=', 'KARYAWAN')->orWhere('last_name', '=', 'PENGAJAR')->orWhere('last_name', '=', 'SANTRI')->count();
                    @endphp
                    Total Peserta : {{ $totalpeserta }}
                </h6>
            </div><!--col-->
        </div>
        <br />
        <div class="chart-wrapper">
            <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                </div>
                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                </div>
            </div>
            <canvas id="total-peserta" width="500" height="400" class="chartjs-render-monitor" style="display: block; width: 300px; height: 265px;"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="col">
            <div class="table-responsive" style="font-size: 12px">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th width="50" style="text-align: center">No.</th>
                            <th>Nama Amalan</th>
                            <th style="text-align: center">Total Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $amalan_lists = DB::table('amalans_lists')->where('id_amalan', '=', 1)->paginate(100);

                        $first  = 0;
                        $end    = 0;
                        $number = 1;
                        @endphp
                        @foreach($amalan_lists as $key=> $amalan_list)
                        <tr>
                            <td style="text-align: center">{{  $key+ $amalan_lists->firstItem() }}</a></td>
                            <td>{{ $amalan_list->nama_amalan_list }}</td>
                            <td style="text-align: center">
                                @php
                                $amalan_list_absens = DB::table('amalans_lists_absens')->where('id_amalan_list', '=', $amalan_list->id)->count();
                                @endphp
                                {{ $amalan_list_absens }}
                            </td>
                        </tr>
                        @php
                        $first  = $amalan_lists->firstItem();
                        $end    = $key + $amalan_lists->firstItem();
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--col-->
    </div>
</div> --}}

<div class="row">
    <div class="col">
        <div class="text-center" style="font-size: 20px; weight:500">
            Amal Yaumiah
        </div>
        <div class="text-center text-muted">
            Program Ar-Rahmah Balikpapan
        </div>
    </div><!--col-md-6-->
</div><!--row-->

<div class="row" style="padding-top:20px">
    <div class="col">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center" style="font-weight: 800; padding-bottom: 20px ">
                        @php
                        $hari_ = array(
                        "Ahad",
                        "Senin",
                        "Selasa",
                        "Rabu",
                        "Kamis",
                        "Jum'at",
                        "Sabtu"
                        );

                        $bulan_ = array(
                        "NAMA BULAN",
                        "Januari",
                        "Februari",
                        "Maret",
                        "April",
                        "Mei",
                        "Juni",
                        "Juli",
                        "Agustus",
                        "September",
                        "Oktober",
                        "November",
                        "Desember"
                        );

                        // $tanggal_hijriyah   = 30;
                        // $bulan_hijriyah     = 9;
                        // $tahun_hijriyah     = 1441;

                        // $tgl = !empty(request('tgl')) ? request('tgl') : intval($tanggal_hijriyah);

                        // $masehi_select = \GeniusTS\HijriDate\Hijri::convertToGregorian($tgl, $bulan_hijriyah, $tahun_hijriyah);
                        // $hijriyah_select = \GeniusTS\HijriDate\Hijri::convertToHijri($masehi_select->format('o-m-d'));

                        @endphp
                        {{-- <div class="tgl">
                            <select class="tglselect" id="tgl" name="tanggal" required>
                                <option value="{{ $tgl }}">
                                    {{ $hari_[$masehi_select->format('w')] }}, {{ $hijriyah_select->format('d F o') }}
                                </option>
                                <option>-------------------</option>
                                @for ($i = 30 ; $i >= 1; $i--)
                                @php
                                $masehi_ = \GeniusTS\HijriDate\Hijri::convertToGregorian($i, $bulan_hijriyah, $tahun_hijriyah);
                                $hijriyah_ = \GeniusTS\HijriDate\Hijri::convertToHijri($masehi_->format('o-m-d'));
                                @endphp
                                <option value="{{ intval($hijriyah_->format('d')) }}">
                                    {{ $hari_[$masehi_->format('w')] }}, {{ $hijriyah_->format('d F o') }}
                                </option>
                                @endfor
                            </select>
                            <div id="txt"></div>
                        </div> --}}
                        <div class="">
                            <form action="/amal-yaumiah" method="get">
                                <div class="text-center">
                                    Tanggal :
                                </div>
                                <div class="row">
                                    <select name="tanggal" class="col-3 form-control" onchange='if(this.value != 0) { this.form.submit(); }'>
                                        <option value="{{ !empty(request('tanggal')) ? request('tanggal') : $tanggalan->day }}">{{ !empty(request('tanggal')) ? request('tanggal') : $tanggalan->day }}</option>
                                        <option value="">-----</option>
                                        @for ($i = $tanggalan->endOfMonth()->day ; $i >= 1; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select class="col-5 form-control" onchange='if(this.value != 0) { this.form.submit(); }'>
                                        <option value="{{ !empty(request('bulan')) ? request('bulan') : $tanggalan->month }}">{{ !empty(request('bulan')) ? $bulan_[request('bulan')] : $bulan_[$tanggalan->month] }}</option>
                                        {{-- <option value="">-----</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option> --}}
                                    </select>
                                    <select class="col-4 form-control">
                                        <option value="2020">2020</option>
                                        {{-- <option value="{{ !empty(request('tahun')) ? request('tahun') : $tanggalan->year }}">{{ !empty(request('tahun')) ? request('tahun') : $tanggalan->year }}</option>
                                        <option value="">-----</option>
                                        @for ($j = $tanggalan->year ; $j >= 2020; $j--)
                                            <option value="{{ $j }}">{{ $j }}</option>
                                        @endfor --}}
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table-bordered text-center">
                        <thead>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @php
                            $tanggalan_ = \Carbon\Carbon::now();
                            $amalan_tanggal = !empty(request('tanggal')) ? request('tanggal') : $tanggalan_->day;
                            $amalan_lists = DB::table('amalans_lists')->where('id_amalan', '=', '1')->paginate(100);
                            @endphp
                            @foreach($amalan_lists as $key=> $amalan_list)
                            <form action="{{ route('frontend.amalans.tambahabsen') }}" method="post">
                                <tr>
                                    <td class="align-middle">{{ $amalan_list->nama_amalan_list }}</td>
                                    @php
                                    $amalan_list_absen = DB::table('amalans_lists_absens')
                                    ->where('id_amalan_list', '=', $amalan_list->id)
                                    ->where('user_amalan_list', '=', $logged_in_user->id)
                                    ->where('tanggal_amalan_list', '=', $amalan_tanggal)
                                    ->first();
                                    @endphp

                                    @if ( empty($amalan_list_absen->tanggal_amalan_list) )
                                        @csrf
                                        <td>
                                            <select name="ket_amalan_list" class="form-control">
                                                <option value=" ">-</option>
                                                <option value="SAKIT">Sakit</option>
                                                @if ($logged_in_user->jenis == 'AKHWAT')
                                                <option value="HAID">Haid</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <input hidden="hidden" name="id_amalan_list" value="{{ $amalan_list->id }}">
                                            <input hidden="hidden" name="user_amalan_list" value="{{ $logged_in_user->id }}">
                                            <input hidden="hidden" name="waktu_amalan_list" value="{{ !empty(request('bulan')) ? $bulan_[request('bulan')] : $bulan_[$tanggalan_->month] }}-{{ !empty(request('tahun')) ? request('tahun') : $tanggalan_->year }}">
                                            <input hidden="hidden" name="tanggal_amalan_list" value="{{ !empty(request('tanggal')) ? request('tanggal') : $tanggalan_->day }}">
                                            <input hidden="hidden" name="bulan_amalan_list" value="{{ !empty(request('bulan')) ? request('bulan') : $tanggalan_->month }}">
                                            <button class="btn btn-light btn-sm" style="font-size:14px; padding: 0px 15px 0px 15px; margin: 5px 20px 5px 20px;"><i class="fas fa-check"></i></button>
                                        </td>
                                    @else
                                    <td></td>
                                    <td>
                                        <button disabled class="btn btn-primary btn-sm" style="font-size:14px; padding: 0px 15px 0px 15px; margin: 5px 20px 5px 20px;"><i class="fas fa-check"></i></button>
                                    </td>
                                    @endif
                                </tr>
                            </form>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>

                <div class="ab" >
                    <table class="table table-bordered table-striped table-sm" style="min-width: 800px; margin: 5px">
                        <thead >
                            <tr>
                                <th width="200" class="text-center">{{ $bulan_[$tanggalan_->month] }}</th>
                                @for ($i = 1; $i <= $tanggalan_->endOfMonth()->format('d'); $i++)
                                <th width="200" class="text-center">{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($amalan_lists as $key=> $amalan_list)
                            <tr>
                                <td style="z-index: 50;">{{ $amalan_list->nama_amalan_list }}</td>
                                @for ($i = 1; $i <= $tanggalan_->endOfMonth()->format('d'); $i++)
                                @php
                                $amalan_list_absen = DB::table('amalans_lists_absens')
                                ->where('id_amalan_list', '=', $amalan_list->id)
                                ->where('user_amalan_list', '=', $logged_in_user->id)
                                ->where('tanggal_amalan_list', '=', $i)
                                ->first();

                                if (isset($amalan_list_absen->tanggal_amalan_list)) {
                                    $check = $amalan_list_absen->tanggal_amalan_list;
                                } else {
                                    $check = '';
                                }

                                @endphp

                                @if ($check == $i || is_null($check) )
                                <td>
                                    <form action="{{ route('frontend.amalans.hapusabsen') }}" onsubmit="return confirm('{{ $amalan_list->nama_amalan_list }} Tanggal {{ $i }}, Apakah anda yakin untuk menghapusnya?');" method="post">
                                        @csrf
                                        <input hidden="hidden" name="id" value="{{ $amalan_list_absen->id }}" />
                                        <center>
                                            @if ($amalan_list_absen->ket_amalan_list == "HAID")
                                            <button type="submit" class="btn" style="color: rgb(255, 56, 156); border: 0px; padding: 0px;">
                                                <i class="fas fa-venus"></i>
                                            </button>
                                            @elseif ($amalan_list_absen->ket_amalan_list == "SAKIT")
                                            <button type="submit" class="btn" style="color: rgb(83, 163, 28); border: 0px; padding: 0px;">
                                                <i class="fas fa-user-times"></i>
                                            </button>
                                            @else
                                            <button type="submit" class="btn" style="color: rgb(0, 184, 255); border: 0px; padding: 0px;">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                            @endif
                                        </center>

                                    </form>
                                </td>
                                @else
                                <td></td>
                                @endif

                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--card-body-->
        </div><!--card-->
    </div><!--col-md-6-->
</div><!--row-->
@php
$karyawan = DB::table('users')->where('last_name', '=', 'KARYAWAN')->count();
$pengajar = DB::table('users')->where('last_name', '=', 'PENGAJAR')->count();
$santri   = DB::table('users')->where('last_name', '=', 'SANTRI')->count();
$ikhwan   = DB::table('users')->where('jenis', '=', 'IKHWAN')->count();
$akhwat   = DB::table('users')->where('jenis', '=', 'AKHWAT')->count();
@endphp
@stack('before-scripts')
{!! script('https://cdn.jsdelivr.net/npm/chart.js@2.8.0') !!}
<script type="text/javascript">
    $( document ).ready(function() {
        $("#open").focus();
    });

    var pieChart = new Chart($('#total-peserta'), {
        type: 'pie',
        data: {
            labels: ['Karyawan - {!! $karyawan !!}','Pengajar - {!! $pengajar !!}', 'Santri - {!! $santri !!}', ],
            datasets: [{
                data: [ {!! $karyawan !!}, {!! $pengajar !!}, {!! $santri !!} ],
                backgroundColor: ['#FF6384', '#4DBD74', '#FFCE56'],
                // hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#52c0c0']
            }]
        },
        options: {
            responsive: true
        }
    });

    var doughnutChart = new Chart($('#jenis-peserta'), {
        type: 'bar',
        data: {
            labels: ['Ikhwan - {!! $ikhwan !!}', 'Akhwat - {!! $akhwat !!}'],
            datasets: [{
                label: 'Ikhwan',
                data: [{!! $ikhwan !!}],
                backgroundColor: ['#36A2EB'],
            },{
                label: 'Akhwat',
                data: [{!! $akhwat !!}],
                backgroundColor: ['#E83E8C'],
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

</script>
{{-- <script type="text/javascript">
    $(function() {
        $('.tglselect').on('change', function (){
            var url = "{{ request()->url() }}";
            if($("#tgl").val()!="{{ $tgl }}") {
                url_ = url+'?tgl='+$("#tgl").val();
                window.location=url_;
            }
        });
    });
</script> --}}
@stack('after-scripts')
@endsection
