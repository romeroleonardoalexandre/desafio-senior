<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/chartist-js/chartist.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/chartist-js/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/sweetalert/sweetalert.css') }}">
    <!-- END: VENDOR CSS-->

    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/vertical-modern-menu-template/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/intro.css') }}">


    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom/custom.css') }}">
@yield('styles')
    <!-- END: Custom CSS-->
</head>

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns  " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

@include('layouts.shared.admin.header')

@include('layouts.shared.admin.menu')

@yield('content')

@include('layouts.shared.admin.footer')
<script>
    var baseUrl = '{{ config('app.url') }}';
</script>
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('app-assets/js/vendors.min.js') }}" type="text/javascript"></script>

<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('app-assets/vendors/chartjs/chart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/chartist-js/chartist.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/chartist-js/chartist-plugin-tooltip.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/maskedInput/jquery.maskedinput.js') }}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('app-assets/js/plugins.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/custom/custom-script.js') }}" type="text/javascript"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
@yield('scripts')
@include('layouts.shared.toastr')
{{--<script src="{{ asset('app-assets/js/scripts/intro.js') }}" type="text/javascript"></script>--}}
<!-- END PAGE LEVEL JS-->
</body>