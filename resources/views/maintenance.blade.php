{{-- SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK
    SABAR YA ADICK ADICK --}}
<!DOCTYPE html>
<html class="dark-layout loaded" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Maintenance</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/pages/page-misc.css">

</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="misc-wrapper">
                    <div class="misc-inner p-2 p-sm-3">
                        {!! $websetting->maintenance_message !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
