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
            <li class="breadcrumb-item"><a href="/amal-yaumiah">Amal Yaumiah</a></li>
            <li class="breadcrumb-item active">Peserta</li>
        </ol>
    </div>
</div>

<div class="row" style="padding-top:20px">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Amal Yaumiah Santri
                            <br>
                            <small class="text-muted" style="font-size: 12px"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <div class="row mt-4 mb-4">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="card-title mb-0 text-center">
                                    @php
                                    $totalpeserta = DB::table('users')->where('last_name', '=', 'SANTRI')->count();
                                    @endphp
                                    Peserta
                                    <div class="text-muted">
                                        Total Peserta : {{ $totalpeserta }}
                                    </div>
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
                </div>

                <hr />

                <div class="row mt-4 mb-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="card-title mb-0 text-center">
                                    Total Peserta & Jumlah Amalan
                                </h6>
                            </div><!--col-->
                        </div>
                        <br />
                        <div class="table-responsive " style="font-size: 13px">
                            <table id="amalan" class="table table-hover table-sm nowarp" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th width="50" style="text-align: center">No.</th>
                                        <th>Nama Peserta</th>
                                        <th>Jenis</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Shalat Wajib Tetap Waktu">1</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Dzikir Pagi">2</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Shalat Dhuha minimal 4 rakaat">3</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Tilawah Minimal 1 juz">4</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Infaq">5</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Al Kahfi Jum'at">6</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Dzikir Sore">7</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Tarawih">8</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Qiyamul Lail">9</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Puasa Sunnah">10</th>
                                        <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Olahraga">11</th>
                                        <th style="text-align: center">Jumlah</th>
                                    </tr>
                                </thead>
                                @php
                                $pesertas = DB::table('users')->where('last_name', '=', 'KARYAWAN')->orWhere('last_name', '=', 'PENGAJAR')->orWhere('last_name', '=', 'SANTRI')->paginate(200);
                                @endphp
                                <tbody>
                                    @foreach($pesertas as $key=> $peserta)
                                    <tr>
                                        <td style="text-align: center">{{  $key+ $pesertas->firstItem() }}</a></td>
                                        <td>{{ $peserta->first_name }}</td>
                                        <td>{{ $peserta->jenis }}</td>
                                        <td style="text-align: center">
                                            @php
                                            $a = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '1')->count();
                                            @endphp
                                            {{ $a }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $b = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '2')->count();
                                            @endphp
                                            {{ $b }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $c = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '3')->count();
                                            @endphp
                                            {{ $c }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $d = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '4')->count();
                                            @endphp
                                            {{ $d }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $e = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '5')->count();
                                            @endphp
                                            {{ $e }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $f = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '6')->count();
                                            @endphp
                                            {{ $f }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $g = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '7')->count();
                                            @endphp
                                            {{ $g }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $h = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '8')->count();
                                            @endphp
                                            {{ $h }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $i = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '9')->count();
                                            @endphp
                                            {{ $i }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $j = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '10')->count();
                                            @endphp
                                            {{ $j }}
                                        </td>
                                        <td style="text-align: center">
                                            @php
                                            $k = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', '11')->count();
                                            @endphp
                                            {{ $k }}
                                        </td>
                                        <td style="text-align: center">
                                            {{ $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
