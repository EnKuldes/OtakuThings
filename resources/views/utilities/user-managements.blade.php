@extends('layouts.app')

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
<script src="{{ asset('app-assets/vendors/js/charts/raphael-min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/charts/morris.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/unslider-min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/timeline/horizontal-timeline.js') }}"></script>
@endsection
@section('extra-script')
@endsection

@section('content')

<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        Ini User Management Page

    </div>
</div>
@endsection
