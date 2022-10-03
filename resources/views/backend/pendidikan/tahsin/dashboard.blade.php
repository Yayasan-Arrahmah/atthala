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
                    <div class="col">
                        <h4 class="m-0">
                            Dashboard Administrasi Tahsin
                        </h4>
                    </div>
                    {{-- <div class="col-3">
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
                    </div> --}}
                </div>

            </div><!--card-header-->
        </div><!--card-->
    </div><!--col-->
</div><!--row-->

{{-- <div class="row ">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="chart1"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="chart7"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="row ">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col text-center">
                        <form action="{{ Request::fullUrl() }}">
                            <h4>
                                Data Tahsin Angkatan
                            </h4>
                            <select class="form-control" style="display: inline;width: fit-content;" name="angkatan" onchange='if(this.value != 0) { this.form.submit(); }'>
                                @foreach($dataangkatan as $angkatan)
                                <option value="{{ $angkatan->angkatan_peserta }}" {{ request()->angkatan == $angkatan->angkatan_peserta ? 'selected' : '' }}>{{ $angkatan->angkatan_peserta }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <div id="chart4"></div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-12">
                                <div id="chart2"></div>
                            </div>
                            <div class="col-12">
                                <div id="chart6"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-12">
                                <div id="chart5"></div>
                            </div>
                            <div class="col-12">
                                <div id="chart3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div id="chart8"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CHART 1 - DATA SELURUH ANGKATAN--}}
{{-- <script>
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
            height: 350,
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
</script> --}}

{{-- CHART 2 - DATA JENIS PESERTA--}}
<script>
    var options = {
        series: [{{ json_encode(data_get($statistik, 'peserta_ikhwan')) }}, {{ json_encode(data_get($statistik, 'peserta_akhwat')) }}],
        chart: {
            height: 200,

            type: 'pie',
        },
        colors: ['#006bd8', '#e83e8c'],
        labels: ['Ikhwan', 'Akhwat'],
        title: {
            text: 'Data Jenis Peserta'
        },
        legend: {
            position: 'top'
        },
        fill: {
            type:'solid',
            opacity: [0.8, 0.8],
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '12px',
                colors: ["#111"]
            },
            dropShadow: {
                enabled: false
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'top'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();
</script>

{{-- CHART 3 - DATA KENAIKAN PESERTA--}}
<script>
    var options = {
        series: [{{ json_encode(data_get($statistik, 'peserta_naik_level')) }}, {{ json_encode(data_get($statistik, 'peserta_tidak_naik_level')) }}],
        chart: {
            height: 200,
            type: 'donut',
        },
        colors: ['#4dbd74', '#95f1b5'],
        labels: ['Naik Level', 'Tidak Naik Level'],
        title: {
            text: 'Data Kenaikan Level'
        },
        legend: {
            position: 'top'
        },
        fill: {
            type:'solid',
            opacity: [0.8, 0.8],
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '12px',
                colors: ["#111"]
            },
            dropShadow: {
                enabled: false
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'top'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart3"), options);
    chart.render();
</script>

{{-- CHART 4 - DATA LEVEL --}}
<script>
    var options = {
        series: [{
            name: 'Daftar Baru',
            data: [
            @foreach ($datalevel as $key_a => $level_a)
            {{ json_encode(data_get($statistik_level_daftar_baru[$key_a], $level_a->nama)) }},
            @endforeach
            ]
        }, {
            name: 'Daftar Ulang',
            data: [
            @foreach ($datalevel as $key_b => $level_b)
            {{ json_encode(data_get($statistik_level_daftar_ulang[$key_b], $level_b->nama)) }},
            @endforeach
            ]
        }
        ],
        colors: ['#63c2de', '#f8cb00'],
        chart: {
            type: 'bar',
            height: 400,
            stacked: true,
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 0,
        },
        grid: {
            show: true,
            xaxis: {
                lines: {
                    show: true
                }
            }
        },
        title: {
            text: 'Data Level'
        },
        xaxis: {
            categories: [
            @foreach ($datalevel as $key_c => $level_c)
            '{{ $level_c->nama_singkat }} : {{ (int)json_encode(data_get($statistik_level_daftar_baru[$key_c], $level_c->nama))+(int)json_encode(data_get($statistik_level_daftar_ulang[$key_c], $level_c->nama)) }}',
            @endforeach
            ]
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Peserta"
                }
            }
        },
        fill: {
            type:'solid',
            opacity: [0.9, 0.9],
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '10px',
                colors: ["#222"]
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: 40
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart4"), options);
    chart.render();

</script>

{{-- CHART 5 - DAFTAR ULANG PESERTA--}}
<script>
    var options = {
        series: [{{ json_encode(data_get($statistik, 'peserta_daftar_ulang')) }}, {{ json_encode(data_get($statistik, 'peserta_tidak_daftar_ulang')) }}],
        chart: {
            height: 200,
            type: 'donut',
        },
        colors: ['#f8cb00', '#ffe78e'],
        labels: ['Daftar Ulang', 'Tidak Daftar Ulang'],
        title: {
            text: 'Data Daftar Ulang Peserta'
        },
        legend: {
            position: 'top'
        },
        fill: {
            type:'solid',
            opacity: [0.8, 0.8],
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '12px',
                colors: ["#111"]
            },
            dropShadow: {
                enabled: false
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'top'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart5"), options);
    chart.render();
</script>

{{-- CHART 6 - DAFTAR UJIAN PESERTA--}}
<script>
    var options = {
        series: [{{ json_encode(data_get($statistik, 'peserta_ujian')) }}, {{ json_encode(data_get($statistik, 'peserta_tidak_ujian')) }}],
        chart: {
            height: 200,
            type: 'donut',
        },
        colors: ['#6f42c1', '#c3a3ff'],
        labels: ['Ujian', 'Tidak Ujian'],
        title: {
            text: 'Keikutsertaan Ujian'
        },
        legend: {
            position: 'top'
        },
        fill: {
            type:'solid',
            opacity: [0.8, 0.8],
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '12px',
                colors: ["#111"]
            },
            dropShadow: {
                enabled: false
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'top'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart6"), options);
    chart.render();
</script>

{{-- CHART 7 - DATA MARGIN SELURUH ANGKATAN--}}
{{-- <script>
    var options = {
        series: [
        {
            name: 'Tidak Daftar Ulang',
            data:  {{ json_encode(data_get($statistik_utama, 'total_peserta_tidak_daftar_ulang')) }}
        },
        {
            name: 'Tidak Ujian',
            data: {{ json_encode(data_get($statistik_utama, 'total_peserta_tidak_ujian')) }}
        },
        {
            name: 'Tidak Naik Level',
            data: {{ json_encode(data_get($statistik_utama, 'total_peserta_tidak_naik_level')) }}
        }
        ],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true
            }
        },
        legend: {
            position: 'top',
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '12px',
                colors: ["#444"]
            },
        },
        stroke: {
            show: true,
            width: 4,
            colors: ['transparent']
        },
        colors: ['#ffe78e', '#c3a3ff', '#95f1b5'],
        xaxis: {
            categories: {{ json_encode(data_get($statistik_utama, 'total_angkatan')) }},
            title: {
                text: 'Angkatan',
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Peserta"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart7"), options);
    chart.render();
</script> --}}

{{-- CHART 8 - DATA UMUR PESERTA--}}
<script>
    var options = {
        series: [{
            data: [
                {{ json_encode(data_get($statistik, 'peserta_umur_1')) }},
                {{ json_encode(data_get($statistik, 'peserta_umur_2')) }},
                {{ json_encode(data_get($statistik, 'peserta_umur_3')) }},
                {{ json_encode(data_get($statistik, 'peserta_umur_4')) }},
                {{ json_encode(data_get($statistik, 'peserta_umur_5')) }},
                {{ json_encode(data_get($statistik, 'peserta_umur_6')) }},
            ]
        }],
        grid: {
            show: true,
            strokeDashArray: 5,
            xaxis: {
                lines: {
                    show: true
                }
            }
        },
        chart: {
            type: 'bar',
            height: 400
        },
        title: {
            text: 'Data Umur Peserta'
        },
        dataLabels: {
            enabled: true,
        },
        plotOptions: {
            bar: {
                borderRadius: 0,
                horizontal: true,
            }
        },
        stroke: {
            width: 0,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Peserta"
                }
            }
        },
        xaxis: {
            categories: [
                '< 17 Tahun',
                '17 - 25 Tahun',
                '26 - 35 Tahun',
                '36 - 45 Tahun',
                '46 - 55 Tahun',
                '> 55 Tahun',
            ],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart8"), options);
    chart.render();

</script>

@endsection
