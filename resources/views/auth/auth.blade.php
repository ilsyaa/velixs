<!DOCTYPE html>
<html class="dark-layout loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="{{ $websetting->meta_description }}">
    <meta name="keywords" content="{{ $websetting->meta_keywords }}">
    <meta name="author" content="{{ $websetting->meta_author }}">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ $websetting->meta_favicon }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $websetting->meta_favicon }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/vendors.min.css">
    @yield('vendorcss')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/pages/authentication.css">
    @yield('css')
</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-framework="laravel" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    @yield('navbar')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('adminpanel') }}/vendors/js/vendors.min.js"></script>
    @yield('vendorjs')
    <script src="{{ asset('adminpanel') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="{{ asset('adminpanel') }}/js/core/app-menu.js"></script>
    <script src="{{ asset('adminpanel') }}/js/core/app.js"></script>
    @yield('js')

    <script>
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
