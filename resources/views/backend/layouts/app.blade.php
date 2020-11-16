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

    .noborder td, .noborder th, .noborder thead {
        border: none;
        font-size: 11px
    }

    .zoom {
            position: relative;
        }
    .zoom:hover {
        -ms-transform: scale(13); /* IE 9 */
        -webkit-transform: scale(13); /* Safari 3-8 */
        transform: scale(13);
        z-index: 999;
    }

    </style>

    @stack('after-styles')
    @livewireStyles

    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    @stack('after-scripts')

</head>

<body class="{{ config('backend.body_classes') }}">
    @include('backend.includes.header')

    <div class="app-body">
        @if (auth()->user()->last_name === 'Ekonomi')
            @include('backend.includes.sidebar-keuangan')
        @else
            @include('backend.includes.sidebar-keuangan')
        @endif

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
    @livewireScripts

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')

    @stack('after-scripts')
</body>
</html>
