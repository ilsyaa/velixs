@extends('frontend.layouts.landing')

@section('content')
    <!-- head -->
    <div class="bg-head">
        <div class="content-head-2 text-light">
            <div class="container py-5 d-flex">
                <div class="desc">
                    <img class="thumbnails-ilsyaa-mobile d-block d-xl-none d-lg-none" src="{!! $blog->_image() !!}" alt="{{ $blog->title }}">
                    <h1 class="display-5 fw-bold title-item-detail">{{ $blog->title }}</h1>
                    <p class="text-muted h6 fw-bold text-slow d-none d-xl-block d-lg-block">{{ $blog->meta_description }}</p>
                    <div class="line-detail my-3"></div>
                    <div class="text-slow">
                        <div class="mb-1"><i class="bi bi-calendar-event"></i> Published on {{ $blog->published_at->format('d M Y') }}</div>
                        <div class="mb-1"><i class="bi bi-pen"></i> Written by <a style="text-decoration: none; color: #fff" href="{!! route('front.profile.index', $blog->author->username) !!}">{{ $blog->author->name }}</a></div>
                        <div class="mb-1"><i class="bi bi-bookmark"></i>
                            @if ($blog->content_type == 'tutorial')
                                <a href="{!! route('front.topics.index', $blog->category->slug) !!}" class="badge rounded-pill text-bg-darks" style="background: rgb(118 106 255);">{{ $blog->category->title }}</a>
                            @else
                                <a href="{!! route('front.article.index', 'category=' . $blog->category->slug) !!}" class="badge rounded-pill text-bg-darks" style="background: rgb(118 106 255);">{{ $blog->category->title }}</a>
                            @endif
                        </div>
                        <div class="mb-1"><i class="bi bi-tags"></i>
                            @foreach ($blog->tags as $tag)
                                <a href="{!! route('front.' . $blog->content_type . '.index', 'tags=' . $tag->slug) !!}" class="badge rounded-pill text-bg-darks">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <img class="thumbnails-ilsyaa d-none d-xl-block d-lg-block" src="{!! $blog->_image() !!}" alt="{{ $blog->title }}">
            </div>
        </div>
    </div>

    <div class="sub-head py-3 mb-0">
        <div class="container d-flex align-items-center">
            <div class="me-auto">
                <a href="" class="sub-title">Metavis <i class="bi bi-chevron-right"></i></a>
                <a href="{!! route('front.' . $blog->content_type . '.index') !!}" class="sub-title d-none d-lg-inline d-md-inline">{{ Str::ucfirst($blog->content_type) }} <i class="bi bi-chevron-right"></i></a>
                <span class="sub-title text-muted">{{ $blog->title }}</span>
            </div>
        </div>
    </div>

    <!-- content -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <div class="content-share d-none d-xl-block">
                        <div class="heart">
                            <i class="bi bi-heart love-uwu"></i>
                            <span>3</span>
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
                            {!! $blog->body !!}
                            <div class="content-footer text-center d-flex justify-content-center">
                                <div class="author-container">
                                    <img class="avatar" src="{!! $blog->author->avatar() !!}" alt="{{ $blog->author->name }}">
                                    <h6 class="fw-bold mt-2">{{ $blog->author->name }} <small>{!! $blog->author->IsVerify() !!}</small></h6>
                                    <small>{{ $blog->author->about }}</small>
                                    <div class="donasinya-tuan mt-3">
                                        <a href="{!! route('front.profile.index', $blog->author->username) !!}" class="btn btn-dark"><i class="bi bi-person"></i> My Profile</a>
                                        <a href="#" class="btn btn-dark"><i class="text-danger bi bi-wallet2"></i> Donate</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-4 d-block d-xl-none">
                                <div class="card-body text-center" style="background-color: #1e293b;">
                                    <div class="heart">
                                        <i class="bi bi-heart love-uwu"></i>
                                        <h6>3</h6>
                                    </div>
                                    <h5 class="title" style="color: #38bdf8">Share on</h5>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}" target="_blank" class="btn btn-dark-gelap icon-share icon-facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ url()->full() }}" target="_blank" class="btn btn-dark-gelap icon-share icon-twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->full() }}" target="_blank" class="btn btn-dark-gelap icon-share icon-linkedin"><i class="bi bi-linkedin"></i></a>
                                    <a href="whatsapp://send?text={{ url()->full() }}" data-action="share/whatsapp/share" target="_blank" class="btn btn-dark-gelap icon-share icon-whatsapp"><i class="bi bi-whatsapp"></i></a>
                                </div>
                            </div>

                            <div class="line-nav my-3"></div>
                            @livewire('front.blog.comments', ['blog' => $blog, 'auth_user' => $auth_user])
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>

        </div>
    </section>
@endsection

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

@push('js')
    <script src="{{ asset('frontend') }}/vendor/highlight/highlight.min.js"></script>
    <script src="{{ asset('frontend') }}/vendor/highlight/highlightjs-copy.min.js"></script>
    <script>
        Livewire.on('toast', (data) => {
            var formReplys = document.getElementsByClassName('form-replys');
            for (var i = 0; i < formReplys.length; i++) {
                formReplys[i].style.display = 'none';
            }
            siiimpleToast.message("" + data['message'] + "", {
                position: "bottom|left",
                margin: 12,
                delay: 0,
                duration: 2000,
            });
        })
        hljs.highlightAll();
        hljs.addPlugin(new CopyButtonPlugin());
    </script>
@endpush
