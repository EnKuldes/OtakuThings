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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="{{ asset('assets/css/font-googleapis.css') }}" rel="stylesheet">
    {{-- BEGIN: Vendor CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/unslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/meteocons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/morris.css') }}">
    {{-- BEGIN: Theme CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/toastr.min.css') }}">
    
    {{-- Extra CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.min.css') }}">
    @yield('extra-lib-css')

    {{-- BEGIN: Custom CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    
    

</head>
<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
    {{-- Header --}}
    @extends('layouts.header')
    {{-- Main Menu --}}
    @extends('layouts.main-menu')
    {{-- Content --}}
    <div class="app-content content">
    @yield('content')
    </div>

    {{-- Customizer --}}
    {{-- @extends('layouts.customizer') --}}

    {{-- Footer --}}
    @extends('layouts.footer')

    {{-- Main Scripts --}}
    {{-- BEGIN: Vendor JS --}}
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>

    {{-- Extra JS --}}
    @yield('extra-lib-js')
    
    {{-- BEGIN: Theme JS --}}
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/js/scripts/customizer.min.js')}}"></script> --}}
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/js/scripts/extensions/toastr.min.js') }}"></script> --}}

    {{-- Extra Scripts --}}
    @yield('extra-script')
    <script type="text/javascript">
        function toastr_me(condition, title, messages) {
            toastr[condition](title, messages, {
                showMethod: "slideDown",
                hideMethod: "slideUp",
                timeOut: 2e3,
                progressBar: !0
            })
        }
    </script>
    
</body>
</html>
