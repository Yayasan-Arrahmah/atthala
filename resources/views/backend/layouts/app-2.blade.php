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
    {{ style('css/backend.css')  }}
    {{-- {{ style('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap') }} --}}
    {{-- {{ style('https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.15.0/css/mdb.min.css') }} --}}
    {{ style('//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}
    {{ style('css/bootstrap-editable.css') }}
    {{-- {{ style('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css') }} --}}

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
        position: absolute;
        -ms-transform: scale(13); /* IE 9 */
        -webkit-transform: scale(13); /* Safari 3-8 */
        transform: scale(13);
        z-index: 9999;
    }

    .ktp {
            position: relative;
        }
    .ktp:hover {
        position: absolute;
        -ms-transform: scale(6); /* IE 9 */
        -webkit-transform: scale(6); /* Safari 3-8 */
        transform: scale(6);
        z-index: 9999;
        right: 100%;
    }

    .sidebar .nav-link.active {
        color: #fff;
        background: rgb(83, 163, 28);
    }

    .circle-icon {
        background: rgb(83, 163, 28);
        width: 100px;
        height: 100px;
        border-radius: 50%;
        text-align: center;
        line-height: 100px;
        vertical-align: middle;
        padding: 30px;
    }

    </style>
    <style>
        #loading {
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0.7;
            background-color: #fff;
            z-index: 99;
        }

        #loading-image {
            z-index: 100;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <style>
    body {
      font-family: "Nunito", sans-serif;
    }
    </style>

    @stack('after-styles')
    @livewireStyles

    @stack('before-scripts')
    {!! script('js/manifest.js') !!}
    {!! script('js/vendor.js') !!}
    {!! script('js/backend.js') !!}
    {{-- {!! script('https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js') !!} --}}
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.3/dist/lazyload.min.js"></script>
    @stack('after-scripts')

</head>

<body class="{{ config('backend.body_classes') }}">
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.demo')
            @include('includes.partials.logged-in-as')
            <div class="p-3"></div>
            {{-- {!! Breadcrumbs::render() !!} --}}

            <div id="loading">
                <div class="text-center">
                    <div id="loading-image" class="spinner-border text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>

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

    {!! script('https://coreui.io/demo/2.0/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js') !!}
    {!! script('https://coreui.io/demo/2.0/js/charts.js') !!}


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
        window.addEventListener( "pageshow", function ( event ) {
        var historyTraversal = event.persisted ||
                                ( typeof window.performance != "undefined" &&
                                    window.performance.navigation.type === 2 );
        if ( historyTraversal ) {
            // Handle page restore.
            window.location.reload();
        }
        });
    </script>
    <script>
        $(window).on('load', function () {
        $('#loading').hide();
        })
    </script>

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('.pembayaran').select2();
        });
    </script> --}}
    @stack('after-scripts')
</body>
</html>
