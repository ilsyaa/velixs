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
                    <div class="col-xl-6 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <div class="row">
                                    <h4 class="card-title mb-1">Today's earnings</h4>
                                    <div class="font-small-2">USD & IDR</div>
                                    <h5 class="mb-1" style="font-size: 21px;">${{ $product_income_usd_today }} <br> Rp.{{ number_format($product_income_idr_today, 2, '.', '.') }}</h5>
                                    <p class="card-text text-muted font-small-2">
                                        <span class="fw-bolder">USD and IDR </span><span>display revenue from all products.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <div class="row">
                                    <h4 class="card-title mb-1">Earnings</h4>
                                    <div class="font-small-2">USD & IDR</div>
                                    <h5 class="mb-1" style="font-size: 21px;">${{ $product_income_usd }} <br> Rp.{{ number_format($product_income_idr, 2, '.', '.') }}</h5>
                                    <p class="card-text text-muted font-small-2">
                                        <span class="fw-bolder">USD and IDR </span><span>display revenue from all products.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-company-table">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Income in usd</th>
                                        <th>Income in usd</th>
                                        <th>Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product_income as $inc)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="fw-bolder"><a target="_blank" href="{{ route('front.product.detail', $inc->product_slug) }}">{{ $inc->product_name }}</a></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bolder mb-25">${{ $inc->total_usd }}</span>
                                                    <span class="font-small-2 text-muted">nominal in usd</span>
                                                </div>
                                            </td>
                                            <td class="text-nowrap">
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bolder mb-25">Rp.{{ number_format($inc->total_idr, 0, '.', '.') }}</span>
                                                    <span class="font-small-2 text-muted">nominal in idr</span>
                                                </div>
                                            </td>
                                            <td><a href="{{ route('product.license.index', ['product' => $inc->product_id]) }}">{{ number_format($inc->total_sales, 0, '.', '.') }} Items</a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
