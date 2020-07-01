@extends('layouts.auth')

@section('extra-lib-css')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/timeline.min.css') }}">
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
    <div class="card-header border-0">
        <div class="card-title text-center">
        <img src="{{ asset('app-assets/images/logo/stack-logo-dark.png') }}" alt="branding logo">
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form-horizontal" action="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/html/ltr/vertical-menu-template/index.html" novalidate>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="text" class="form-control" id="user-perner" placeholder="Perner Anda"
                    required name="perner">
                    <div class="form-control-position">
                        <i class="feather icon-user"></i>
                    </div>
                </fieldset>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" class="form-control" id="user-password"
                    placeholder="Password Anda" required name="password">
                    <div class="form-control-position">
                        <i class="fa fa-key"></i>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-outline-primary btn-block"><i
                class="feather icon-unlock"></i> Login</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
