@extends('admin.layouts.main')

@section('title', $title)

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{ $title }}</h2>
                            <div class="breadcrumb-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <div class="row">
                                    <h4 class="card-title mb-1">Product Revenue</h4>
                                    <div class="font-small-2">USD & IDR</div>
                                    <h5 class="mb-1" style="font-size: 21px;">${{ $product_income_usd }} <br> Rp.{{ number_format($product_income_idr, 2, '.', '.') }}</h5>
                                    <p class="card-text text-muted font-small-2">
                                        <span class="fw-bolder">USD and IDR </span><span>display revenue from all products.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-6 col-12">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">Total Content</h4>
                            </div>
                            <div class="card-body statistics-body">
                                <div class="row">

                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-primary me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="shopping-cart" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{ number_format($product_count, 0, '.', '.') }}</h4>
                                                <p class="card-text font-small-3 mb-0">Products</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-info me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="list" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{ number_format($blog_count, 0, '.', '.') }}</h4>
                                                <p class="card-text font-small-3 mb-0">Blogs</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-danger me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="layers" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{ number_format($page_count, 0, '.', '.') }}</h4>
                                                <p class="card-text font-small-3 mb-0">Bages</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-success me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="sidebar" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{ $daily_visitor }}</h4>
                                                <p class="card-text font-small-3 mb-0">Daily Visitors</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <section id="apexchart">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                                    <div>
                                        <h4 class="card-title">Visitor</h4>
                                        <span class="card-subtitle text-muted">Visitor {{ date('M Y') }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="metavisitor"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                        <div class="card card-browser-states">
                            <div class="card-header">
                                <div>
                                    <h4 class="card-title">Browser States</h4>
                                    <p class="card-text font-small-2">Counter Every Time</p>
                                </div>
                                <div class="dropdown chart-dropdown">
                                    <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Last Days</a>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                        <a class="dropdown-item" href="#">Last Year</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($browser as $brow)
                                    <div class="browser-states">
                                        <div class="d-flex">
                                            @if ($brow->browser == 'Chrome')
                                                <img src="{{ asset('adminpanel') }}/images/browser/google-chrome.png" class="rounded me-1" height="30" alt="Google Chrome" />
                                                <h6 class="align-self-center mb-0">{{ $brow->browser }}</h6>
                                            @elseif($brow->browser == 'Safari')
                                                <img src="{{ asset('adminpanel') }}/images/browser/apple-safari.png" class="rounded me-1" height="30" alt="Apple Safari" />
                                                <h6 class="align-self-center mb-0">{{ $brow->browser }}</h6>
                                            @elseif($brow->browser == 'Firefox')
                                                <img src="{{ asset('adminpanel') }}/images/browser/mozila-firefox.png" class="rounded me-1" height="30" alt="Mozila Firefox" />
                                                <h6 class="align-self-center mb-0">{{ $brow->browser }}</h6>
                                            @elseif($brow->browser == 'Mozilla')
                                                <img src="{{ asset('adminpanel') }}/images/browser/mozila-firefox.png" class="rounded me-1" height="30" alt="Mozila Firefox" />
                                                <h6 class="align-self-center mb-0">{{ $brow->browser }}</h6>
                                            @elseif($brow->browser == 'Edge' || $brow->browser == 'IE')
                                                <img src="{{ asset('adminpanel') }}/images/browser/internet-explorer.png" class="rounded me-1" height="30" alt="Internet Explorer" />
                                                <h6 class="align-self-center mb-0">{{ $brow->browser }}</h6>
                                            @elseif($brow->browser == 'Opera')
                                                <img src="{{ asset('adminpanel') }}/images/browser/opera.png" class="rounded me-1" height="30" alt="Opera Mini" />
                                                <h6 class="align-self-center mb-0">{{ $brow->browser }}</h6>
                                            @else
                                                <img src="{{ asset('adminpanel') }}/images/browser/internet.png" class="rounded me-1" height="30" alt="Internet Explorer" />
                                                <h6 class="align-self-center mb-0">Unknown Browser</h6>
                                            @endif

                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold text-body-heading me-1">{{ $brow->total }}</div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 col-lg-8 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                                <div>
                                    <p class="card-subtitle text-muted mb-25">Visitors By Country</p>
                                    <h4 class="card-title fw-bolder">Counter Every Time</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="country-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var areaChartEl = document.querySelector('#metavisitor'),
            areaChartConfig = {
                chart: {
                    height: 400,
                    type: 'area',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: true
                    }
                },
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    show: false,
                    curve: 'straight'
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'start'
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                colors: ['#2bdac7', '#a4f8cd'],
                series: [{
                    name: 'Main',
                    data: {!! $visitorperday_master !!}
                }, {
                    name: 'Page',
                    data: {!! $visitorperday_page !!}
                }],
                xaxis: {
                    categories: {!! $daysinmonth !!}
                },
                fill: {
                    opacity: 0.8,
                    type: 'solid'
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + " Visitor";
                            }
                            return y;
                        }
                    }
                },
            };
        if (typeof areaChartEl !== undefined && areaChartEl !== null) {
            var areaChart = new ApexCharts(areaChartEl, areaChartConfig);
            areaChart.render();
        }

        var barChartEl = document.querySelector('#country-chart'),
            barChartConfig = {
                chart: {
                    height: 400,
                    type: 'bar',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        barHeight: '30%',
                        endingShape: 'rounded'
                    }
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    padding: {
                        top: -15,
                        bottom: -10
                    }
                },
                colors: window.colors.solid.info,
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Visitors',
                    data: {!! $visitorcountrycount !!}
                }],
                xaxis: {
                    categories: {!! $visitorcountry !!}

                },
            };
        if (typeof barChartEl !== undefined && barChartEl !== null) {
            var barChart = new ApexCharts(barChartEl, barChartConfig);
            barChart.render();
        }
    </script>
@endpush

@section('vendorcss')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/plugins/charts/chart-apex.css">
@endsection

@section('vendorjs')
    <script src="{{ asset('adminpanel') }}/vendors/js/charts/apexcharts.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
@endsection
