@extends('backend.layouts.app')

@section('title', ' Yayasan Arrahmah Balikpapan - Amal Yaumiah 2021')

@section('breadcrumb-links')
@include('backend.amalan.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ $amalan->nama_amalan }}
                    <br>
                    <small class="text-muted" style="font-size: 12px">{{ $amalan->deskripsi_amalan }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
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
                                $amalan_lists = DB::table('amalans_lists')->get();

                                $first  = 0;
                                $end    = 0;
                                $number = 1;
                                @endphp
                                @foreach($amalan_lists as $key => $amalan_list)
                                <tr>
                                    <td style="text-align: center">{{ $number++ }}</a></td>
                                    <td>{{ $amalan_list->nama_amalan_list }}</td>
                                    <td style="text-align: center">
                                        @php
                                        $amalan_list_absens = DB::table('amalans_lists_absens')->where('id_amalan_list', '=', $amalan_list->id)->count();
                                        @endphp
                                        {{ $amalan_list_absens }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div>
        </div>

        <hr />
        <form action="{{ Request::fullUrl() }}" class="row mt-4">
            <div class="col">
            </div>
            {{-- <div class="col-md-4">
                <div class="text-muted text-center" style="position: absolute">
                Tanggal
                 </div>
                 <div class="input-daterange input-group" id="datepicker">
                    <input type="text" class="input-sm form-control" name="start" />
                    <span class="input-group-addon">to</span>
                    <input type="text" class="input-sm form-control" name="end" />
                </div>
            </div> --}}
            <div class="col-md-2">
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

            <div class="col-md-3">
                <div class="pull-right input-group mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-search"></i> </span>
                    </div>
                    <input name="nama" class="form-control" type="text" placeholder="Cari Nama" autocomplete="password" width="100">
                </div>
            </div>
        </form>
        <div class="row mt-4 mb-4">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        <h6 class="card-title mb-0 text-center">
                            Total Peserta & Jumlah Amalan SANTRI RTQ
                        </h6>
                    </div><!--col-->
                </div>
                <br />
                <div class="table-responsive " style="font-size: 13px">
                    <table class="table table-hover table-sm nowarp" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="50" style="text-align: center">No.</th>
                                <th>Nama Peserta</th>
                                <th>Status</th>
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
                                <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Pusa Sunnah">10</th>
                                <th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Olahraga">11</th>
                                <th style="text-align: center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesertas as $key=> $peserta)
                            <tr>
                                <td style="text-align: center">{{  $key+ $pesertas->firstItem() }}</a></td>
                                <td>{{ $peserta->first_name }}</td>
                                <td>{{ $peserta->last_name }}</td>
                                <td>{{ $peserta->jenis }}</td>
                                @for ($i = 1; $i <= 11; $i++)
                                    <td style="text-align: center">
                                        {{ $data = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->where('id_amalan_list', '=', $i)->count() }}
                                    </td>
                                @endfor
                                <td style="text-align: center">
                                    {{ $data = DB::table('amalans_lists_absens')->where('user_amalan_list', '=', $peserta->id)->count()}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $first !!} - {!! $end !!} From {!! $pesertas->total() !!} Data
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $pesertas->appends(request()->query())->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    {{-- <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_amalans.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($amalan->created_at) }} ({{ $amalan->created_at->diffForHumans() }}),
                    <strong>@lang('backend_amalans.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($amalan->updated_at) }} ({{ $amalan->updated_at->diffForHumans() }})
                    @if($amalan->trashed())
                    <strong>@lang('backend_amalans.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($amalan->deleted_at) }} ({{ $amalan->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer--> --}}
</div><!--card-->
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
    $('.input-daterange').datepicker({
    });
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
@stack('after-scripts')
@endsection
