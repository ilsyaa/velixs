@extends('frontend.layouts.landing')

@section('content')
    <div class="bg-head">
        <div class="text-light" style="background-image: linear-gradient(164deg, #040cff14 0%, #0b1120e6 50%);">
            <div class="container py-5">
                <div class="row">
                    <div class="col"></div>
                    <div class="col col-12 col-xl-8">
                        <div class="card border-0 shadow">
                            <form id="submit-license" method="POST" action="{!! route('front.license.search') !!}">
                                <div class="card-body rounded">
                                    @csrf
                                    <input type="text" required class="form-control" id="input-license" name="license" autocomplete="off" placeholder="{{ config('app.prefix_license') }}-XXXX-XXXXX-XXXX">
                                </div>
                                <div class="card-footer py-1 d-flex">
                                    <div class="me-auto text-muted">
                                        <small id="indicator-loading">Claim License</small>
                                    </div>
                                    <button type="submit" style="background: none; border:none;"><small class="text-muted"><i class="bi bi-arrow-return-left"></i> enter</small></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="sub-head py-3 mb-0">
        <div class="container d-flex align-items-center">
            <div class="me-auto">
                <a href="{!! route('index') !!}" class="sub-title">{{ $websetting->app_title }} <i class="bi bi-chevron-right"></i></a>
                <span class="sub-title text-muted">License</span>
            </div>
        </div>
    </div>

    <section class="py-5">
        <div class="container">
            @if ($page == 'detail')
                <div class="card border-0 shadow mb-4">
                    <div class="card-header py-1 text-muted">
                        Detail License
                    </div>
                    <div class="card-body rounded">
                        <div class="row" id="content">
                            <div class="col-12 col-xl-4 col-lg-4">
                                <div class="card border-0 mb-4 fades">
                                    <a class="mb-3" href="{!! route('front.product.detail', $license->item->slug) !!}">
                                        <img class="thumbnial-blog w-100" src="{!! $license->item->_thumbnail() !!}" alt="">
                                    </a>
                                    <form action="{!! route('front.license.claim') !!}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $license->id }}">
                                        <button type="submit" class="btn btn-dark shadow w-100 m-0">CLAIM</button>
                                    </form>

                                </div>
                            </div>
                            <div class="col">
                                @if ($auth_user)
                                    <p class="paragraph">
                                        Hi <a class="href text-success" href="{!! route('front.profile.index', $auth_user->username) !!}">{{ $auth_user->name }}</a>, Be careful if you want to post a screenshot on this page, there is some privacy data <span class="text-success">(url &amp; license)</span> please censor the data if you don't want your license to be claimed by others.
                                    </p>
                                @else
                                    <p class="paragraph">
                                        Hi <a class="href text-success" href="#">Guest</a>, Be careful if you want to post a screenshot on this page, there is some privacy data <span class="text-success">(url &amp; license)</span> please censor the data if you don't want your license to be claimed by others.
                                    </p>
                                @endif

                                <table>
                                    <tr>
                                        <td class="pb-2 pe-5 text-muted">License</td>
                                        <td class="pb-2"><small>{{ $license->license }}</small></td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2 pe-5 text-muted">Created at</td>
                                        <td class="pb-2"><small>{{ $license->created_at->format('d M Y') }}</small></td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2 pe-5 text-muted">License Type</td>
                                        <td class="pb-2"><small>{{ Str::ucfirst($license->type) }}</small></td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2 pe-5 text-muted">Item</td>
                                        <td class="pb-2"><small><a class="href text-success" href="{!! route('front.product.detail', $license->item->slug) !!}">{{ $license->item->name }}</a></small></td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2 pe-5 text-muted">Original Price</td>
                                        <td class="pb-2">
                                            <small class="currency-usd"><span class="text-success">$</span> {{ $license->item->price_usd }}</small>
                                            <small class="currency-idr"><span class="text-success">Rp.</span> {{ number_format($license->item->price_idr, 0, '.', '.') }}</small>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card border-0 shadow">
                <div class="card-body rounded">
                    @foreach ($license_activity as $la)
                        <div class="list-group list-search mb-1" style="background: #111828;">
                            <small class="list-group-search text-muted text-slow" style="white-space: normal;">
                                <p class="mb-1"><a class="href" href="{!! route('front.profile.index', $la->user->username) !!}">{{ $la->user->name }}</a> claims <a class="href text-primary" href="{!! route('front.product.detail', $la->product->slug) !!}">{{ $la->product->name }}</a> license</p>
                                <small>{{ $la->created_at->diffForHumans() }}</small>
                            </small>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer py-1 d-flex">
                    <small class="text-muted">Product License Activity</small>
                </div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col col-12 col-xl-8">

                </div>
                <div class="col"></div>
            </div>
        </div>
        <div class="container container-nav d-flex justify-content-end">
            <div id="change-currency" data-toggle="tooltip" data-placement="top" title="Change currency." class="currency">USD</div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        var submit_license = document.getElementById('submit-license');
        var input = document.getElementById('input-license');
        submit_license.addEventListener('submit', function() {
            document.getElementById('indicator-loading').innerHTML = '<div class="spinner-grow" style="height: 14px; width: 14px" role="status"><span class="visually-hidden">Loading...</span></div>';
        });

        input.addEventListener('keyup', function() {
            var value = input.value;
            document.getElementById('indicator-loading').innerHTML = '<div class="spinner-grow" style="height: 14px; width: 14px" role="status"><span class="visually-hidden">Loading...</span></div>';
            setTimeout(function() {
                if (value) {
                    if (value.match(/{{ config('app.prefix_license') }}-/)) {
                        document.getElementById('indicator-loading').innerHTML = 'Claim License';
                        input.classList.remove('is-invalid');
                    } else {
                        input.classList.add('is-invalid');
                        document.getElementById('indicator-loading').innerHTML = 'Format license is wrong';
                    }
                } else {
                    document.getElementById('indicator-loading').innerHTML = 'Claim License';
                    input.classList.remove('is-invalid');
                }
            }, 2000);
        });
    </script>
@endpush
