@extends('frontend.layouts.landing')

@section('content')
    @if ($content_type == 'tutorial')
        @include('frontend.blogs.head_tutorial')
    @else
        @include('frontend.blogs.head_article')
    @endif

    <div class="sub-head py-3 mb-0">
        <div class="container d-flex align-items-center">
            <div class="me-auto">
                <a href="{!! route('index') !!}" class="sub-title">{{ $websetting->app_title }} <i class="bi bi-chevron-right"></i></a>
                <a href="{!! route('front.tutorial.index') !!}" class="sub-title d-none d-lg-inline d-md-inline">Tutorial <i class="bi bi-chevron-right"></i></a>
                <span class="sub-title text-muted">{{ $req_category ? $req_category : 'Latest' }}</span>
            </div>
        </div>
    </div>

    <section class="mt-5">
        <div class="container mb-5">
            <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-4 row-cols-md-2" id="content">
                @foreach ($blogs as $lb)
                    <div class="col">
                        <div class="card border-0 mb-4 fades">
                            <a href="{!! route('front.' . $content_type . '.detail', $lb->slug) !!}"><img class="thumbnial-blog w-100" src="{!! $lb->_thumbnail() !!}" alt=""></a>
                            <div class="card-body ">
                                <a href="{!! route('front.' . $content_type . '.detail', $lb->slug) !!}" class="judul-blog">{{ $lb->title }}</a>
                                <div class="d-flex align-items-center tag-blog my-1">
                                    @if ($content_type == 'article')
                                        <div class="circle"></div> <a class="href" href="{!! route('front.article.index', 'category=' . $lb->category->slug . '') !!}">{{ $lb->category->title }}</a>
                                    @elseif($content_type == 'tutorial')
                                        <div class="circle"></div> <a class="href" href="{!! route('front.topics.index', $lb->category->slug) !!}">{{ $lb->category->title }}</a>
                                    @endif
                                </div>
                                <small class="text-muted sort-blog">
                                    {{ $lb->meta_description }}
                                </small>
                            </div>
                            <div class="card-footer blog-footer py-1">
                                <img class="avatar" src="{!! $lb->author->avatar() !!}" alt="">
                                <a href="{!! route('front.profile.index', $lb->author->username) !!}" class="d-block href">
                                    <div class="text-muted m-0">Posted by</div>
                                    <div>{{ $lb->author->name }}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (!count($blogs))
                <blockquote style="background-color: #121c2c;">
                    <div class="text-center">
                        <h4 class="text-muted">404</h4>
                        <h6 class="text-muted">No content yet.</h6>
                    </div>
                </blockquote>
            @endif

            {{ $blogs->appends(request()->query())->links('vendor.pagination.landing') }}

        </div>
    </section>
@endsection

@push('css')
    <style>
        .fades {
            opacity: 1;
            animation: fadeIn 2s;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        btn_paagin = document.getElementsByClassName('pagin-item');
        for (let i = 0; i < btn_paagin.length; i++) {
            btn_paagin[i].addEventListener('click', function() {
                document.getElementById('pagin-title').style.display = 'none';
                document.getElementById('pagin-loading').style.display = 'block';

            });
        }
    </script>
@endpush
