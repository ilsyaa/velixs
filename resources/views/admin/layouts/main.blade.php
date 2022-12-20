<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="{{ $websetting->meta_description }}">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="apple-touch-icon" href="{{ $websetting->meta_favicon() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $websetting->meta_favicon() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/extensions/sweetalert2.min.css">
    @yield('vendorcss')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/pages/authentication.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/plugins/extensions/ext-component-sweet-alerts.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/core/menu/menu-types/vertical-menu.css">
    @yield('css')
    @method('css')

</head>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-framework="laravel" data-open="click" data-menu="vertical-menu-modern" data-col="">

    @include('admin.layouts.header')

    @include('admin.layouts.sidebar')

    @yield('content')

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <script src="{{ asset('adminpanel') }}/vendors/js/vendors.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/extensions/sweetalert2.all.min.js"></script>
    @yield('vendorjs')
    <script src="{{ asset('adminpanel') }}/js/core/app-menu.js"></script>
    <script src="{{ asset('adminpanel') }}/js/core/app.js?"></script>
    @yield('js')

    @stack('js')

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3500,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        @endif

        // any error
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                text: '{{ $errors->first() }}',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        @endif

        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>


</body>

</html>
