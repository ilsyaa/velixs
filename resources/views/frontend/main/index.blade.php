@extends('frontend.layouts.landing')

@section('content')
    <div class="bg-head">
        <div class="content-head text-light p-5">
            <div class="container py-5 text-slow">
                <h1 class="display-5 fw-bold">{!! $websetting->app_title !!}</h1>
                <h1 class="display-6 text-muted fw-bold">A Place for Various Web App and Template needs.</h1>
                <p class="text-secondary">Place all your programming needs, such as free program tutorials. provides source code, templates, and much more.</p>
                <a href="{!! route('front.product.index') !!}" class="btn btn-primary btn-sm rounded-5 px-3 mb-2"><i class="bi bi-caret-right"></i> Digital Products</a>
                <a href="{!! route('front.tutorial.index') !!}" class="btn btn-dark btn-sm rounded-5 px-3 mb-2"><i class="bi bi-journal-text"></i> Tutorial</a>
            </div>
        </div>
    </div>

    <div class="sub-head py-3 mb-5">
        <div class="container d-flex align-items-center">
            <div class="me-auto">
                <a href="{!! route('index') !!}" class="sub-title">{{ $websetting->app_title }} <i class="bi bi-chevron-right"></i></a>
                <span class="sub-title text-muted">Home</span>
            </div>
        </div>
    </div>

    <section>
        <div class="container mb-5">
            <h6 class="text-light fw-bold mb-0">Latest Tutorials</h6>
            <div class="d-flex">
                <div class="me-auto">
                    <p class="text-muted">This is a list of the latest tutorials.</p>
                </div>
                <div class="tutorial-slider-controls mb-2">
                    <a href="javascript:void(0)" class="href text-muted"><i class="bi bi-caret-left"></i></a>
                    <a href="javascript:void(0)" class="href text-muted"><i class="bi bi-caret-right"></i></a>
                </div>
            </div>
            <div class="tutorial row row-cols-1 row-cols-xl-4 row-cols-lg-4 row-cols-md-2" id="content">
                @foreach ($latest_tutorial as $lt)
                    <div class="col">
                        <div class="card card-item mb-3">
                            <a href="{!! route('front.tutorial.detail', $lt->slug) !!}">
                                <img class="card-img" src="{!! $lt->_thumbnail() !!}" alt="{!! $lt->title !!}">
                            </a>
                            <div class="card-body-item">
                                <img class="author" src="{!! $lt->author->avatar() !!}">
                                <div class="text">
                                    <a href="{!! route('front.tutorial.detail', $lt->slug) !!}" class="title-item">{{ $lt->title }}</a>
                                    <div class="title-author">{{ $lt->author->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a class="btn btn-dark btn-sm" href="{!! route('front.tutorial.index') !!}">Load More</a>
            </div>
        </div>
    </section>

    <section class="mt-5 mb-5 bg-head">
        <div class="shadow" style="background-image: linear-gradient(110deg, #04070f7d 10%, #0b1120 50%);">
            <div class="container" style="padding-top: 100px;padding-bottom: 100px;">
                <div class="d-flex justify-content-center text-center">
                    <div class="author-container">
                        <h3 class="text-light fw-bold">Start By Choosing a Programming Language</h3>
                        <p class="text-light">If you are confused about which topic to choose, you can see a list of programming languages that have been grouped into certain topics.</p>
                    </div>

                </div>

                <div class="text-center">
                    <a href="{!! route('front.topics.index', 'html') !!}" class="btn btn-dark mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M20 4l-2 14.5l-6 2l-6 -2l-2 -14.5z"></path>
                            <path d="M15.5 8h-7l.5 4h6l-.5 3.5l-2.5 .75l-2.5 -.75l-.1 -.5"></path>
                        </svg>
                    </a>
                    <a href="{!! route('front.topics.index', 'php') !!}"class="btn btn-dark mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <ellipse cx="12" cy="12" rx="10" ry="9"></ellipse>
                            <path d="M5.5 15l.395 -1.974l.605 -3.026h1.32a1 1 0 0 1 .986 1.164l-.167 1a1 1 0 0 1 -.986 .836h-1.653"></path>
                            <path d="M15.5 15l.395 -1.974l.605 -3.026h1.32a1 1 0 0 1 .986 1.164l-.167 1a1 1 0 0 1 -.986 .836h-1.653"></path>
                            <path d="M12 7.5l-1 5.5"></path>
                            <path d="M11.6 10h2.4l-.5 3"></path>
                        </svg>
                    </a>
                    <a href="{!! route('front.topics.index', 'laravel') !!}" class="btn btn-dark mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-red-500" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 17l8 5l7 -4v-8l-4 -2.5l4 -2.5l4 2.5v4l-11 6.5l-4 -2.5v-7.5l-4 -2.5z"></path>
                            <path d="M11 18v4"></path>
                            <path d="M7 15.5l7 -4"></path>
                            <path d="M14 7.5v4"></path>
                            <path d="M14 11.5l4 2.5"></path>
                            <path d="M11 13v-7.5l-4 -2.5l-4 2.5"></path>
                            <path d="M7 8l4 -2.5"></path>
                            <path d="M18 10l4 -2.5"></path>
                        </svg>
                    </a>
                    <a href="{!! route('front.topics.index', 'bootstrap') !!}" class="btn btn-dark mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo-500" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M2 12a2 2 0 0 0 2 -2v-4a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4a2 2 0 0 0 2 2"></path>
                            <path d="M2 12a2 2 0 0 1 2 2v4a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-4a2 2 0 0 1 2 -2"></path>
                            <path d="M9 16v-8h3.5a2 2 0 1 1 0 4h-3.5h4a2 2 0 1 1 0 4h-4z"></path>
                        </svg>
                    </a>
                    <a href="{!! route('front.topics.index', 'js') !!}" class="btn btn-dark mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-400" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M20 4l-2 14.5l-6 2l-6 -2l-2 -14.5z"></path>
                            <path d="M7.5 8h3v8l-2 -1"></path>
                            <path d="M16.5 8h-2.5a0.5 .5 0 0 0 -.5 .5v3a0.5 .5 0 0 0 .5 .5h1.423a0.5 .5 0 0 1 .495 .57l-.418 2.93l-2 .5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container mb-5">
            <div class="text-center">
                <h2 class="text-slow text-light fw-bold mb-0">Latest Articles</h2>
                <p class="text-muted">kami telah menyediakan Anda beberapa artikel yang mungkin bermanfaat.</p>
            </div>
            <div class="text-end">
                <div class="articles-slider-controls mb-2">
                    <a href="javascript:void(0)" class="href text-muted"><i class="bi bi-caret-left"></i></a>
                    <a href="javascript:void(0)" class="href text-muted"><i class="bi bi-caret-right"></i></a>
                </div>
            </div>
            <div class="articles row row-cols-1 row-cols-xl-4 row-cols-lg-4 row-cols-md-2" id="content">
                @foreach ($latest_article as $lt)
                    <div class="col">
                        <div class="card card-item mb-3">
                            <a href="{!! route('front.article.detail', $lt->slug) !!}">
                                <img class="card-img" src="{!! $lt->_thumbnail() !!}" alt="{!! $lt->title !!}">
                            </a>
                            <div class="card-body-item">
                                <img class="author" src="{!! $lt->author->avatar() !!}">
                                <div class="text">
                                    <a href="{!! route('front.article.detail', $lt->slug) !!}" class="title-item">{{ $lt->title }}</a>
                                    <div class="title-author">{{ $lt->author->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a class="btn btn-dark btn-sm" href="{!! route('front.tutorial.index') !!}">Load More</a>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{!! asset('frontend/landing/vendor/tinyslider/tiny-slider.css') !!}">
@endpush

@push('js')
    <script src="{!! asset('frontend/landing/vendor/tinyslider/tiny-slider.js') !!}"></script>
    <script>
        tns({
            container: '.tutorial',
            fixedWidth: 315,
            gutter: 16,
            nav: false,
            autoplay: true,
            autoplayButtonOutput: false,
            controlsContainer: '.tutorial-slider-controls',
        });

        tns({
            container: '.articles',
            fixedWidth: 315,
            gutter: 16,
            nav: false,
            autoplay: true,
            autoplayButtonOutput: false,
            controlsContainer: '.articles-slider-controls'
        });
    </script>
@endpush
