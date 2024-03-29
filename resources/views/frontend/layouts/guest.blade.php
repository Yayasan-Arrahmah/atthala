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
    <!-- Alpine Plugins -->
    <script defer src="https://unpkg.com/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Core -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style('css/backend.css') }}

    <style>
        body{
            background-color: #f3f8fd;
        }
    </style>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <style>
    body {
        font-family: "Nunito", sans-serif;
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
        .filepond--media-preview-wrapper {
            position: relative;
        }

    </style>

    @stack('after-styles')

    @stack('before-scripts')

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script src="/js/jquery.priceformat.js"></script> --}}
    {!! script('js/manifest.js') !!}
    {!! script('js/vendor.js') !!}
    {!! script('js/backend.js') !!}
    {{-- {!! script('js/app.js') !!} --}}

    @stack('after-scripts')

</head>
<body>
    {{-- <body onload="startTime()"> --}}
    @include('includes.partials.demo')

    <div id="app">
        {{-- @include('includes.partials.logged-in-as') --}}
        {{-- @include('frontend.includes.nav') --}}

        <div class="container" style="margin-top: 30px">
            @include('includes.partials.messages')
            {{-- @include('includes.partials.notif') --}}

            @yield('content')
            <div class="row justify-content-center align-items-center">
                <div class="col col-lg-4 align-self-center">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="text-justify">
                                Dukung dakwah Al Qur'an dengan Subscribe Channel kami.
                            </p>
                            <script src="https://apis.google.com/js/platform.js"></script>
                            <div class="g-ytsubscribe" data-channelid="UCelv_sHe1XX0M62VaaG_GCA" data-layout="full" data-count="hidden"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- container -->
        <center style="color: #697477; padding-bottom: 20px">LTTQ Ar-Rahmah Balikpapan &copy; {{ date('Y') }}</center>

    </div><!-- #app -->

    @include('includes.partials.ga')
    {{-- @livewireScripts --}}

</body>
</html>
