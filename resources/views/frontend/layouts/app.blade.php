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

    <style>
        body{
            background-image: url('img/back.jpeg');
        }
    </style>

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

    @stack('after-styles')
</head>
<body>
    @include('includes.partials.demo')

    <div id="app">
        {{-- @include('includes.partials.logged-in-as')
        @include('frontend.includes.nav') --}}

        <div class="container">
            <br>
            <br>
            <br>
            <br>
            @include('includes.partials.messages')
            @yield('content')
        </div><!-- container -->
    </div><!-- #app -->

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/frontend.js')) !!}
    @stack('after-scripts')

    @include('includes.partials.ga')
</body>
</html>
