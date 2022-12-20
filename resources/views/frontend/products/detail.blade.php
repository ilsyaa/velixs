@extends('frontend.layouts.landing')

@section('content')
    @php
        $imagecount = $row->images()->count();
        $imageget = $row->images()->get();
    @endphp
    <div class="bg-head">
        <div class="content-head-2 text-light">
            <div class="container py-5">
                <div class="row">
                    <div class="col-12 col-xl-6 ">
                        <h1 class="display-5 fw-bold title-item-detail">{{ $row->name }}</h1>
                        <p class="text-muted h6 small noto__ d-none d-xl-block d-lg-block">{{ $row->meta_description }}</p>
                        <div class="line-detail my-3"></div>
                        <div class="small noto__">
                            <table>
                                @if ($row->product_type != 'free')
                                    <tr>
                                        <td><span class="text-muted"><i class="bi bi-cash-stack"></i> Price:</span></td>
                                        <td>
                                            <span class="currency-usd"><span class="text-success">$</span> {{ $row->price_usd }}</span>
                                            <span class="currency-idr"><span class="text-success">Rp</span> {{ number_format($row->price_idr, 0, '.', '.') }}</span>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="pe-3"><span class="text-muted"><i class="bi bi-arrow-repeat"></i> Last Update:</span></td>
                                    <td>{{ $row->updated_at->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td><span class="text-muted"><i class="bi bi-calendar-event"></i> Published:</span></td>
                                    <td>{{ $row->created_at->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td><span class="text-muted"><i class="bi bi-pen"></i> Author by:</span></td>
                                    <td><a style="text-decoration: none; color: #fff" href="{!! route('front.profile.index', $row->author->username) !!}">{{ $row->author->name }} {!! $row->author->IsVerify('font-size: 12px') !!}</a></td>
                                </tr>

                            </table>
                            <div class="mb-1"><span class="text-muted"><i class="bi bi-bookmark"></i></span>
                                <a href="{!! route('front.product.category', 'c=' . $row->category->slug) !!}" class="badge rounded-pill text-bg-darks" style="background: rgb(118 106 255);">{{ $row->category->title }}</a>
                            </div>
                            <div class="mb-1"><span class="text-muted"><i class="bi bi-tags"></i></span>
                                @foreach ($row->tags as $tag)
                                    <a href="{!! route('front.product.category', 'tags=' . $tag->slug) !!}" class="badge rounded-pill text-bg-darks">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col order-first order-xl-last">
                        <div id="slideimgilsyaa" class="carousel slide mb-3" data-bs-ride="true">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#slideimgilsyaa" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                @if ($imagecount > 0)
                                    @foreach ($imageget as $key => $image)
                                        <button type="button" data-bs-target="#slideimgilsyaa" data-bs-slide-to="{{ $key + 1 }}" aria-label="{{ $row->name }}"></button>
                                    @endforeach
                                @endif
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{!! $row->_image() !!}" class="d-block w-100 rounded" alt="{{ $row->name }}">
                                </div>
                                @if ($imagecount > 0)
                                    @foreach ($imageget as $img)
                                        <div class="carousel-item">
                                            <img src="{{ $img->image() }}" class="d-block w-100 rounded" alt="{{ $row->name }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#slideimgilsyaa" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#slideimgilsyaa" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="sub-head py-3 mb-0">
        <div class="container">
            <div class="d-flex" id="pills-tab" role="tablist">
                <button id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-desc" type="button" role="tab" aria-controls="pills-desc" aria-selected="true" class="rounded-1 btn btn-dark w-100 d-flex align-items-center justify-content-center active"><i class="bi bi-list-ul"></i> <span class="d-none d-xl-block d-lg-block d-md-block ms-2">Description</span></button>
                <button id="pills-docs-tab" data-bs-toggle="pill" data-bs-target="#pills-docs" type="button" role="tab" aria-controls="pills-docs" aria-selected="true" class="rounded-1 btn btn-dark w-100 d-flex align-items-center justify-content-center"><i class="bi bi-file-earmark-text"></i> <span class="d-none d-xl-block d-lg-block d-md-block ms-2">Documentation</span></button>
                <button id="pills-comments-tab" data-bs-toggle="pill" data-bs-target="#pills-comments" type="button" role="tab" aria-controls="pills-comments" aria-selected="true" class="rounded-1 btn btn-dark w-100 d-flex align-items-center justify-content-center"><i class="bi bi-chat-square-dots"></i> <span class="d-none d-xl-block d-lg-block d-md-block ms-2">Comments</span></button>
            </div>
        </div>
    </div>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <div class="content-share d-none d-xl-block">
                        <div class="heart">
                            <i class="bi bi-heart love-uwu"></i>
                        </div>
                        <div class="share-social">
                            <h5 class="title">SHARE</h5>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}" target="_blank" class="icon-share icon-facebook"><i class="bi bi-facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->full() }}" target="_blank" class="icon-share icon-twitter"><i class="bi bi-twitter"></i></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->full() }}" target="_blank" class="icon-share icon-linkedin"><i class="bi bi-linkedin"></i></a>
                            <a href="whatsapp://send?text={{ url()->full() }}" data-action="share/whatsapp/share" target="_blank" class="icon-share icon-whatsapp"><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8">
                    <div class="card card-content">
                        <div class="card-body body-content">
                            <div class="row row-cols-md-2 d-flex d-xl-none">
                                <div class="col">
                                    @if ($row->product_type == 'free')
                                        @if ($auth_user)
                                            @if ($row->isPurchased($row->id, $auth_user->id) > 0)
                                                <a href="{{ route('front.library.index') }}" class="m-0 btn btn-in-footer__ btn btn-primary__ w-100"><i class="bi bi-wallet2"></i> My Library</a>
                                            @else
                                                <a href="{{ route('front.library.add', $row->id) }}" class="m-0 btn btn-in-footer__ btn btn-primary__ w-100"><i class="bi bi-cart-plus"></i> Add Library</a>
                                            @endif
                                        @else
                                            <a href="{{ route('front.library.add', $row->id) }}" class="m-0 btn btn-in-footer__ btn btn-primary__ w-100"><i class="bi bi-cart-plus"></i> Add Library</a>
                                        @endif
                                    @else
                                        @if ($auth_user)
                                            @if ($row->isPurchased($row->id, $auth_user->id) > 0)
                                                <a href="{{ route('front.library.index') }}" class="m-0 btn btn-in-footer__ btn btn-primary__ w-100"><i class="bi bi-wallet2"></i> My Library</a>
                                            @else
                                                <button onclick="ilsyaa__payment____('{{ $row->id }}')" data-bs-toggle="modal" data-bs-target="#modal-payment" class="m-0 btn btn-in-footer__ btn btn-primary__ w-100"><i class="bi bi-cart2"></i> Buy Now</button>
                                            @endif
                                        @else
                                            <button onclick="ilsyaa__payment____('{{ $row->id }}')" data-bs-toggle="modal" data-bs-target="#modal-payment" class="m-0 btn btn-in-footer__ btn btn-primary__ w-100"><i class="bi bi-cart2"></i> Buy Now</button>
                                        @endif
                                    @endif
                                </div>
                                <div class="col">
                                    <a href="{!! $row->live_preview !!}" target="_blank" class="m-0 btn-in-footer__ btn btn-dark w-100"><i class="bi bi-code"></i> Live Preview</a>
                                </div>
                            </div>
                            <div class="line-nav my-3 d-flex d-xl-none"></div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-desc" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                    {!! $row->body !!}
                                    <div class="card mt-4 d-block d-xl-none">
                                        <div class="card-body text-center" style="background-color: #1e293b;">
                                            <div class="heart">
                                                <i class="bi bi-heart love-uwu"></i>
                                            </div>
                                            <h5 class="title" style="color: #38bdf8">Share on</h5>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}" target="_blank" class="btn btn-dark-gelap icon-share icon-facebook"><i class="bi bi-facebook"></i></a>
                                            <a href="https://twitter.com/intent/tweet?url={{ url()->full() }}" target="_blank" class="btn btn-dark-gelap icon-share icon-twitter"><i class="bi bi-twitter"></i></a>
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->full() }}" target="_blank" class="btn btn-dark-gelap icon-share icon-linkedin"><i class="bi bi-linkedin"></i></a>
                                            <a href="whatsapp://send?text={{ url()->full() }}" data-action="share/whatsapp/share" target="_blank" class="btn btn-dark-gelap icon-share icon-whatsapp"><i class="bi bi-whatsapp"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-docs" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0"> {!! $row->docs !!}</div>
                                <div class="tab-pane fade" id="pills-comments" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                                    @livewire('front.product.comments', ['product' => $row, 'auth_user' => $auth_user])
                                </div>
                            </div>
                            <div class="py-4 d-none d-xl-block"></div>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </section>

    <nav class="navbar fixed-bottom gw-gak-tau-namanya-bg-dark shadow ">
        <div class="container container-nav d-flex">
            <div class="me-auto">
                <div class="d-flex align-items-center">
                    <img style="height: 30px; width: 30px;object-fit: cover; border-radius: 50%;" src="{!! $row->author->avatar() !!}" alt="{{ $row->author->name }}">
                    <div class="m-0 p-0 ms-2">{{ $row->author->name }} {!! $row->author->IsVerify('font-size: 12px') !!}</div>
                    <span class="ms-4 small"><i class="text-muted bi bi-cart"></i> {{ number_format($row->library()->count(), 0, ',', '.') }} Sales</span>
                    <span class="ms-4 small"><i class="text-muted bi bi-eye"></i> {{ number_format($row->views()->count(), 0, ',', '.') }} Views</span>
                    @if ($row->product_type != 'free')
                        <span class="ms-4 small">
                            <span class="currency-usd"><span class="text-success">$</span> {{ $row->price_usd }}</span>
                            <span class="currency-idr"><span class="text-success">Rp</span> {{ number_format($row->price_idr, 0, '.', '.') }}</span>
                        </span>
                    @else
                        <span class="ms-4 small text-muted">
                            $ <span class="text-success">Free</span>
                        </span>
                    @endif
                </div>
            </div>
            <div class="d-none d-xl-block">
                @if ($row->product_type == 'free')
                    @if ($auth_user)
                        @if ($row->isPurchased($row->id, $auth_user->id) > 0)
                            <a href="{{ route('front.library.index') }}" class="btn btn-in-footer__ btn btn-primary__"><i class="bi bi-wallet2"></i> My Library</a>
                        @else
                            <a href="{{ route('front.library.add', $row->id) }}" class="btn btn-in-footer__ btn btn-primary__"><i class="bi bi-cart-plus"></i> Add Library</a>
                        @endif
                    @else
                        <a href="{{ route('front.library.add', $row->id) }}" class="btn btn-in-footer__ btn btn-primary__"><i class="bi bi-cart-plus"></i> Add Library</a>
                    @endif
                @else
                    @if ($auth_user)
                        @if ($row->isPurchased($row->id, $auth_user->id) > 0)
                            <a href="{{ route('front.library.index') }}" class="btn btn-in-footer__ btn btn-primary__"><i class="bi bi-wallet2"></i> My Library</a>
                        @else
                            <button onclick="ilsyaa__payment____('{{ $row->id }}')" data-bs-toggle="modal" data-bs-target="#modal-payment" class="btn btn-in-footer__ btn btn-primary__"><i class="bi bi-cart2"></i> Buy Now</button>
                        @endif
                    @else
                        <button onclick="ilsyaa__payment____('{{ $row->id }}')" data-bs-toggle="modal" data-bs-target="#modal-payment" class="btn btn-in-footer__ btn btn-primary__"><i class="bi bi-cart2"></i> Buy Now</button>
                    @endif
                @endif
                <a href="{!! $row->live_preview !!}" target="_blank" class="btn-in-footer__ btn btn-dark"><i class="bi bi-code"></i> Live Preview</a>
            </div>
        </div>
    </nav>
    <div class="container container-nav d-flex justify-content-end">
        <div id="change-currency" data-toggle="tooltip" data-placement="top" title="Change currency." class="currency detail-product">USD</div>
    </div>

    <div class="modal fade" id="modal-payment" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <small class="text-muted">Payment Method</small>
                </div>
                <div class="modal-body border-0" id="payment-body">

                </div>
                <div class="modal-footer d-flex text-muted noto__ py-0">
                    <small><span class="fw-bold">esc</span> exit</small>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('frontend') }}/vendor/highlight/highlight.min.js"></script>
    <script src="{{ asset('frontend') }}/vendor/highlight/highlightjs-copy.min.js"></script>
    <script src="{!! asset('frontend/landing/vendor/jquery.min.js') !!}"></script>
    <script>
        Livewire.on('toast', (data) => {
            var formReplys = document.getElementsByClassName('form-replys');
            for (var i = 0; i < formReplys.length; i++) {
                formReplys[i].style.display = 'none';
            }
            siiimpleToast.message("" + data['message'] + "", {
                position: "top|right",
                margin: 12,
                delay: 0,
                duration: 2000,
            });
        })
        hljs.highlightAll();
        hljs.addPlugin(new CopyButtonPlugin());

        function ilsyaa__payment____(id) {
            $('#payment-body').html('<div class="text-center my-5"><div class="spinner-grow" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            $.ajax({
                url: "{{ route('front.payment.method') }}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#payment-body').html(data);
                }
            });
        }
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend') }}/vendor/highlight/styles/base16/dracula.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/vendor/highlight/highlightjs-copy.min.css" />
    <style>
        .hljs {
            background: #0b1120;
            border: 1px solid #1e293b;
            border-radius: 5px
        }
    </style>
@endpush
