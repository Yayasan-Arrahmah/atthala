<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Ar-Rahmah Balikpapan')">
    <meta name="author" content="@yield('meta_author', 'rimbaborne')">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}
    {{-- {{ style('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap') }} --}}
    {{-- {{ style('https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.15.0/css/mdb.min.css') }} --}}
    @livewireStyles


    <style>
    .card {
        border-radius: .45rem;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    }
    .sidebar .nav-link:hover {
        color: #fff;
        background: rgb(83, 163, 28);
    }

    .sidebar .nav-link.active .nav-icon {
        color: rgb(83, 163, 28);
    }

    a {
        color: rgb(83, 163, 28);
    }

    .switch-primary .switch-input:checked+.switch-slider {
        background-color: rgb(83, 163, 28);
        border-color: rgb(83, 163, 28);
    }

    .switch-primary .switch-input:checked+.switch-slider:before {
        border-color: rgb(83, 163, 28);
    }

    .table td, .table th {
        vertical-align: inherit;
    }

    .card-header:first-child {
        border-top: 1px solid #c8ced3;
    }

    .form-control-label {
        padding-top: calc(0.375rem + 1px);
    }

    .collapsing {
        -webkit-transition: none;
        transition: none;
        display: none;
    }

    .kotak {
        border: #e4e7e9 solid 1px;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
    .kotak:hover {
        border: rgb(83, 163, 28) solid 1px;
    }

    .kotak-atas {
        padding: 10px;
        background-color: #e4e7e9;
        border-radius: 5px;
        margin-bottom: 4px;
    }

    </style>

    {{ style('//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}

    @stack('after-styles')
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    @stack('after-scripts')

</head>

<body class="{{ config('backend.body_classes') }}">
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.demo')
            @include('includes.partials.logged-in-as')
            {!! Breadcrumbs::render() !!}

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
    </div><!--app-body-->

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    @livewireScripts
    {!! script('https://coreui.io/demo/2.0/vendors/chart.js/js/Chart.min.js') !!}

    {!! script('https://coreui.io/demo/2.0/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js') !!}
    {!! script('https://coreui.io/demo/2.0/js/charts.js') !!}

    {!! script('//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') !!}
    {!! script('//cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js') !!}

    <script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $(document).on('submit', '[id^=form]', function (e) {
    e.preventDefault();
    var data = $(this).serialize();
    swal({
        title: "Apakah Nominal Sudah Benar ?",
        text: "Konfirmasi Pembayaran",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, send it!",
        cancelButtonText: "No, cancel pls!",
    }).then(function () {
        $('#form').submit();
    });
    return false;
    });
    </script>

    <script type="text/javascript">

    $('input.nominal').on('blur', function() {
        // const rupiah = this.value;
        // rupiah.addEventListener('keyup', function(e){
        //     // tambahkan 'Rp.' pada saat form di ketik
        //     // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        //     rupiah.value = formatRupiah(this.value, 'Rp. ');
        // });

        const value = this.value.replace(/,/g, '');
        this.value = formatRupiah(value, 'Rp. ');

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    });
    </script>



    <script>
        $(document).ready( function () {
            $('#pengajartahsin').DataTable({
                "pageLength": 15,
                "scrollX": true,
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    total2 = api
                        .column( 3 )
                        .data()
                        .reduce( function (c, d) {
                            return intVal(c) + intVal(d);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    pageTotal2 = api
                        .column( 3, { page: 'current'} )
                        .data()
                        .reduce( function (c, d) {
                            return intVal(c) + intVal(d);
                        }, 0 );

                    // Update footer
                    $( api.column( 2 ).footer() ).html(
                        pageTotal +' ( Total : '+ total +' ) Kelas'
                    );
                    $( api.column( 3 ).footer() ).html(
                        pageTotal2 +' ( Total : '+ total2 +' ) Peserta'
                    );
                }
            });

            $('#jadwaltahsin thead tr').clone(true).appendTo( '#jadwaltahsin thead' );
            $('#jadwaltahsin thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Cari '+title+'" />' );

                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
            var table = $('#jadwaltahsin').DataTable({
                "pageLength": 15,
                "scrollX": true,
                "orderCellsTop": true,
                "fixedHeader": true,
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 3, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 3 ).footer() ).html(
                        pageTotal +' ( Total : '+ total +' ) Peserta'
                    );
                }
            });
        } );
    </script>

    @stack('after-scripts')
</body>
</html>
