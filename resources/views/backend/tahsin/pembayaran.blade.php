@extends('backend.layouts.app')

@section('title', app_name() . ' | Peserta ' . __('backend_tahsins.labels.management'))

@section('breadcrumb-links')
@include('backend.tahsin.includes.breadcrumb-links')
@endsection

@section('content')
{{-- <div class="card">
    @include('backend.tahsin.includes.cari')
</div> --}}
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <div class="text-muted" style="font-size: 13px">
                Income : <strong>Rp. {{ number_format( ($nominal1*100000)+($nominal2*200000)+($nominal3*300000)+($nominal4*400000), 0, '.', '.') }} </strong>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0 text-center">
                        Statistik Nominal Pembayaran
                    </h4>
                </div><!--col-->
            </div>
            <div class="chart-wrapper">
                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <canvas id="nominal-pembayaran" width="500" height="265" class="chartjs-render-monitor" style="display: block; width: 300px; height: 265px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0 text-center">
                        Status Pembayaran
                    </h4>
                </div><!--col-->
            </div>
            <div class="chart-wrapper">
                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <canvas id="status-pembayaran" width="500" height="265" class="chartjs-render-monitor" style="display: block; width: 300px; height: 265px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card" style="min-width: 800px;">
    @livewire('tahsin.pembayaran')
</div><!--card-->

@stack('before-scripts')
{!! script('https://cdn.jsdelivr.net/npm/chart.js@2.8.0') !!}
{{-- {!! script('https://coreui.io/demo/2.0/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js') !!} --}}
{{-- {!! script('https://coreui.io/demo/2.0/js/charts.js') !!} --}}
<script type="text/javascript">
    $( document ).ready(function() {
        $("#open").focus();
    });

    var pieChart = new Chart($('#nominal-pembayaran'), {
        type: 'pie',
        data: {
            labels: ['Rp. 0','Rp. 100.000', 'Rp. 200.000', 'Rp. 300.000', 'Rp. 400.000'],
            datasets: [{
                data: [ {!! $nominal0 !!}, {!! $nominal1 !!}, {!! $nominal2 !!}, {!! $nominal3 !!}, {!! $nominal4 !!}],
                backgroundColor: ['#aaaaaa','#FF6384', '#36A2EB', '#FFCE56', '#52c0c0'],
                // hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#52c0c0']
            }]
        },
        options: {
            responsive: true
        }
    });

    var doughnutChart = new Chart($('#status-pembayaran'), {
        type: 'doughnut',
        data: {
            labels: ['Belum Lunas', 'Lunas'],
            datasets: [{
                data: [{!! $belumlunas !!}, {!! $lunas !!}],
                backgroundColor: ['#FF6384', '#36A2EB'],
                hoverBackgroundColor: ['#FF6384', '#36A2EB']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@stack('after-scripts')
@endsection

