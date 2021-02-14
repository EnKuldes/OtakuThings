<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}"> {{-- To Change Shortcut Icon Here --}}
    <link href="{{ asset('assets/css/font-googleapis.css') }}" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/unslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/meteocons/style.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}"> {{-- To Change Backgorund Image of Login Page is Here, search "html body.bg-full-screen-image" then replace with images that needed --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/toastr.min.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/search.min.css') }}">
    @yield('extra-lib-css')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu 2-column   fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu" data-col="1-column">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top {{ config('myconfig.navbar_theme') }} {{ config('myconfig.navbar_color') }}">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu font-large-1"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="{{url('/')}}"><img class="brand-logo" alt="OtakuThings Logo" src="{{ asset('app-assets/images/logo/stack-logo.png') }}" width="30px">
                <h2 class="brand-text">{{ config('app.name', 'Laravel') }}</h2></a></li>
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        {{-- <div class="navbar-container">
          <div class="collapse navbar-toggleable-sm justify-content-end" id="navbar-mobile">
            <ul class="nav navbar-nav">
              <li class="nav-item"><a class="nav-link mr-2 nav-link-label" href="{{ url()->previous() }}"><i class="ficon feather icon-arrow-left"></i></a></li>
            </ul>
          </div>
        </div> --}}
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="#"><i class="feather icon-menu"></i></a></li>
                           
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- END: Header-->

    {{-- BEGIN: Main Menu --}}
    <div class="main-menu menu-fixed menu-accordion menu-shadow {{ config('myconfig.menu_color') }} {{ config('myconfig.navigation_layout') }}" data-scroll-to-active="true"> {{-- To change menu item scheme colors --}}
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" navigation-header">
            <span>Menu</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Menu"></i>
        </li>
        @php
        foreach ($menu_list as $menu) {
            echo '<li class=" nav-item ';
            if (url()->current() == url($menu->menu_link)) {
              echo 'active';
            }
            if ($menu->menu_child == 1) {
              echo "has-sub";
            }
            echo '"><a href="'.url($menu->menu_link).'"><i class="'.$menu->menu_icon.'"></i><span class="menu-title" data-i18n="'.$menu->menu_name.'">'.$menu->menu_name.'</span></a>';
            if ($menu->menu_child == 1) {
                echo '<ul class="menu-content">';
                foreach ($menu->sub_child as $child_menu) {
                    echo '<li ';
                    if (url()->current() == url($child_menu->menu_link)) {
                        echo 'class="active"';
                    }
                    echo '><a class="menu-item" href="'.url($child_menu->menu_link).'" data-i18n="'.$child_menu->menu_name.'">'.$child_menu->menu_name.'</a></li>';
                }
                echo '</ul>';
            }
            echo '</li>';
        }
        @endphp
        </ul>
       </div>
    </div>
{{-- END: Main Menu --}}

    <!-- BEGIN: Content-->
    <div class="app-content content">
      @yield('content')
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    <footer class="footer fixed-bottom footer-dark navbar-border">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; 2021 <a class="text-bold-800 grey darken-2" href="https://github.com/EnKuldes" target="_blank">Farhan Muzaki</a></span><span class="float-md-right d-none d-lg-block">Mangats <i class="feather icon-heart pink"></i></span></p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
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
        @if (session()->has('message'))
        toastr_me({{ Session::get(0) }}, {{ Session::get(1) }}, {{ Session::get(2) }});
        @endif
    </script>

  </body>
  <!-- END: Body-->
</html>