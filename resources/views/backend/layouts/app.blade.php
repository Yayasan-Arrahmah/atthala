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
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}

    <style>
    .card {
        border-radius: .45rem;
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

    </style>

    {{ style('//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}

    @stack('after-styles')
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
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}

    {!! script('//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') !!}
    {!! script('//cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js') !!}

    <script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
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
