@extends('layouts.auth')

@section('extra-lib-css')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/login-register.min.css') }}">
<!-- END: Page CSS-->
@endsection
@section('extra-lib-js')
{{-- BEGIN: Page Vendor JS --}}
<script src="{{ asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
{{-- BEGIN: Page JS --}}
<script src="{{ asset('app-assets/js/scripts/forms/form-login-register.min.js') }}"></script>
@endsection
@section('extra-script')
@endsection

@section('content')
<div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
<div class="card border-grey border-lighten-3 px-1 py-1 m-0">
    <div class="card-header border-0 pb-0">
        <div class="card-title text-center">
            <img src="{{ asset('app-assets/images/logo/stack-logo-dark.png') }}" alt="branding logo">
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('register') }}" novalidate>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="text" class="form-control" id="user-name" placeholder="User Name">
                    <div class="form-control-position">
                        <i class="feather icon-user"></i>
                    </div>
                </fieldset>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="email" class="form-control" id="user-email"
                        placeholder="Your Email Address" required>
                    <div class="form-control-position">
                        <i class="feather icon-mail"></i>
                    </div>
                </fieldset>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" class="form-control" id="user-password"
                        placeholder="Enter Password" required>
                    <div class="form-control-position">
                        <i class="fa fa-key"></i>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                        <fieldset>
                            <input type="checkbox" id="remember-me" class="chk-remember">
                            <label for="remember-me"> Remember Me</label>
                        </fieldset>
                    </div>
                    <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a
                            href="recover-password.html" class="card-link">Forgot Password?</a></div>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-block"><i
                        class="feather icon-user"></i> Register</button>
            </form>
            <a href="login-with-bg-image.html" class="btn btn-outline-danger btn-block mt-2"><i
                    class="feather icon-unlock"></i> Login</a>
        </div>
    </div>
</div>
</div>
@endsection
