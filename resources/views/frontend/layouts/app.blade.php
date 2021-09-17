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
    <meta name="description" content="@yield('meta_description', 'Arrahmah Balikpapan')">
    <meta name="author" content="@yield('meta_author', 'rimbaborne')">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}
    {{-- {{ style('css/bootstrap-datepicker.css') }} --}}
    {{-- {{ style('https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/jquery-editable/jquery-ui-datepicker/css/redmond/jquery-ui-1.10.3.custom.min.css')  }} --}}

    {{-- {{ style('//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }} --}}

    {{-- {{ style('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css') }} --}}

    {{-- {{ style('css/bootstrap-editable.css') }} --}}

    {{-- {{ style('https://fonts.googleapis.com/css2?family=Baloo+Bhaina+2&display=swap') }} --}}
    {{-- <link rel="stylesheet" href="/css/bootstrap-editable.css"/> --}}
    <style>
        body{
            background-image: url('/img/back.jpeg');

            /* font-family: 'Baloo Bhaina 2'; */
        }
    </style>

    <style>
        .ab {
            overflow-x: scroll;
            width: 100%;
            margin: 0 auto;
        }
        .ab td {
            padding: 2px 3px 2px 5px;
        }
        .ab th, td {
            white-space: nowrap;
        }
        .first-col {
            position: absolute;
            width: 5em;
            /* margin-left: -5em; */
        }
        .tgl select {
            max-height: calc(0.5em + 20px);
            height: calc(0.5em + 20px);
            background: #fff;
        }
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

        .info-absen {
            font-weight: 700;
        }

    </style>
    {{ style('//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}
    {{-- {{ style('https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css') }} --}}

    @stack('after-styles')

    @stack('before-scripts')


    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    {{-- {!! script('js/bootstrap-datepicker.js') !!} --}}
    {{-- {!! script('//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') !!} --}}
    {{-- {!! script('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') !!}
    {!! script('https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js') !!}
    {!! script('https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js') !!} --}}

    {{-- {!! script('https://vitalets.github.io/x-editable/assets/jquery/jquery-1.9.1.min.js') !!}
    {!! script('https://vitalets.github.io/x-editable/assets/mockjax/jquery.mockjax.js') !!} --}}
    {{-- {!! script('https://vitalets.github.io/x-editable/assets/mockjax/jquery.mockjax.js') !!} --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}

    {{-- <script src="/js/bootstrap-editable.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/js/bootstrap-editable.min.js" integrity="sha512-u2P0FelsRQD/z5EkW5vRp8RRm9oe23rKSqvHBFAXnnES8tPRVIl6oBexyBE1WaOA4rPhXf035iKWU/DCbzRftw==" crossorigin="anonymous"></script> --}}
    {{-- {!! script('https://code.jquery.com/jquery-2.0.3.min.js') !!} --}}
    {{-- {!! script('https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/css/bootstrap-editable.css') !!} --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#jadwal').DataTable();
            $('#absen').DataTable({
                "searching": false,
                "paging":   false,
                "ordering": false,
                "info":     false,
                "drawCallback": function( settings ) {
                    var api = this.api();

                    $('.username', api.table().body()).editable({
                        url: "/",
                        mode: "inline"
                    });
                }
            });
            $('#amalan').DataTable({
                "pageLength": 15,
                "scrollX": true,
            });

            $('.datepicker').datepicker();


        });
    </script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> --}}

    {{-- {!! script('https://printjs-4de6.kxcdn.com/print.min.js') !!} --}}
    {{-- {!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.min.js') !!} --}}
    {{-- {!! script('js/bootstrap-editable.min.js') !!} --}}

    {{-- <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('uploads').innerHTML = h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    </script> --}}
    @stack('after-scripts')
    {{-- @livewireStyles --}}

</head>
<body>
    {{-- <body onload="startTime()"> --}}
    @include('includes.partials.demo')

    <div id="app">
        @include('includes.partials.logged-in-as')
        {{-- @include('frontend.includes.nav') --}}

        <div class="container">
            @auth
                @include('frontend.includes.nav-a')
            @endauth
            @include('includes.partials.messages')
            {{-- @include('includes.partials.notif') --}}

            @yield('content')
        </div><!-- container -->
        <center style="color: #fff; padding-bottom: 20px">Ar-Rahmah Balikpapan &copy; {{ date('Y') }}</center>

    </div><!-- #app -->

    @include('includes.partials.ga')
    {{-- @livewireScripts --}}

</body>
</html>
