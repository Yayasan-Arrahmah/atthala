@extends('backend.layouts.app-2')

@section('title', app_name() . '| Tahsin')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<style>
    .graphic-container {
        min-height: 320px;
        max-height: 320px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9">
                        <h4 class="m-0">
                            Dashboard Administrasi Tahsin
                        </h4>
                    </div>
                    <div class="col-3">
                        <form action="{{ Request::fullUrl() }}" class="row">
                            <div class="col-md-8 text-muted text-right pt-1">
                                Angkatan
                            </div>
                            <div class="col-md-4">
                                <select class="form-control form-control-sm" name="angkatan" onchange='if(this.value != 0) { this.form.submit(); }'>
                                    @foreach($dataangkatan as $angkatan)
                                    <option value="{{ $angkatan->angkatan_peserta }}" {{ request()->angkatan == $angkatan->angkatan_peserta ? 'selected' : '' }}>{{ $angkatan->angkatan_peserta }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

            </div><!--card-header-->
        </div><!--card-->
    </div><!--col-->
</div><!--row-->

<div class="row ">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var options = {
        series: [
        {
            name: 'Jumlah Peserta',
            type: 'line',
            data: {{ json_encode(data_get($statistik_utama, 'total_peserta')) }}
        },
        {
            name: 'Daftar Ulang',
            type: 'area',
            data: {{ json_encode(data_get($statistik_utama, 'total_peserta_daftar_ulang')) }}
        },
        {
            name: 'Daftar Baru',
            type: 'area',
            data: {{ json_encode(data_get($statistik_utama, 'total_peserta_daftar_baru')) }}
        },
        {
            name: 'Ikhwan',
            type: 'line',
            data: {{ json_encode(data_get($statistik_utama, 'total_peserta_ikhwan')) }}
        },
        {
            name: 'Akhwat',
            type: 'line',
            data: {{ json_encode(data_get($statistik_utama, 'total_peserta_akhwat')) }}
        }
        ,
        {
            name: 'Al-Haq',
            type: 'line',
            data: {{ json_encode(data_get($statistik_utama, 'total_peserta_alhaq')) }}
        }
        ],
        chart: {
            type: 'line',
            height: 400,
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true
            }
        },
        colors: ['#5bd706','#f8cb00','#63c2de','#006bd8', '#e83e8c','#ff0200'],
        dataLabels: {
          enabled: true,
          enabledOnSeries: [0,1,2,5]
        },
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 0
            },
        },
        xaxis: {
            categories: {{ json_encode(data_get($statistik_utama, 'total_angkatan')) }},
            title: {
                text: 'Angkatan',
            }
        },
        legend: {
            position: 'top',
        },
        stroke: {
          curve: 'smooth',
          width: [4, 2, 2, 2, 2, 3],
          dashArray: [0,7,7,0,0],
        //   colors: ['#5bd706','transparent','#f8cb00','#20a8d8', '#e83e8c'],
        },
        fill: {
          type:'solid',
          opacity: [0.7, 0.3, 0.4, 1, 1],
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " Peserta"
            }
          }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
</script>

@endsection
