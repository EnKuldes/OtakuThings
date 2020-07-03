<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loading" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Main CSS --}}
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}"> <!-- Source: Icons made by <a href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
    <link href="{{ asset('assets/css/font-googleapis.css') }}" rel="stylesheet">
    {{-- BEGIN: Vendor CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/unslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/meteocons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/morris.css') }}">
    {{-- BEGIN: Theme CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
    {{-- BEGIN: Custom CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    
    {{-- Main Scripts --}}
    {{-- BEGIN: Vendor JS --}}
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    {{-- BEGIN: Theme JS --}}
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>

    {{-- Extra CSS --}}
    @yield('extra-lib-css')
    

    {{-- Extra JS --}}
    @yield('extra-lib-js')

</head>
<body class="vertical-layout vertical-menu 1-column   blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 p-0">
                            <div class="card-header bg-transparent border-0">
                                <h2 class="error-code text-center mb-2">
                                    @yield('code')
                                </h2>
                                <h3 class="text-uppercase text-center">
                                    @yield('message')
                                </h3>
                            </div>
                            <div class="card-content">
                                <div class="row py-2">
                                    <div class="col-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3 mb-1">
                                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-block"><i class="feather icon-corner-down-left"></i> Kembali</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="row">
                                    <p class="text-muted text-center col-12 py-1">© <span class="year"></span> <a href="https://github.com/SquidFoxDev">SquidFoxDev </a></p>
                                    {{-- <div class="col-12 text-center">
                                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span class="fa fa-twitter"></span></a>
                                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span class="fa fa-linkedin font-medium-4"></span></a>
                                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-github"><span class="fa fa-github font-medium-4"></span></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    {{-- Extra Scripts --}}
    @yield('extra-script')
    
</body>
</html>
