@if ($main_blog)
    <div class="bg-head">
        <div class="text-light" style="background-image: linear-gradient(38deg, rgb(0 8 250 / 6%) 3%, #0b1120 50%);">
            <div class="container py-5 d-flex">
                <div class="desc">
                    <a href="{!! route('front.article.detail', $main_blog->slug) !!}">
                        <img class="thumbnails-ilsyaa-mobile d-block d-xl-none d-lg-none" src="{!! $main_blog->_image() !!}" alt="{{ $main_blog->title }}">
                    </a>
                    <h1 class="display-5 fw-bold title-item-detail"><a class="href" href="{!! route('front.article.detail', $main_blog->slug) !!}">{{ $main_blog->title }}</ac>
                    </h1>
                    <p class="text-muted h6 fw-bold text-slow d-none d-xl-block d-lg-block">{{ $main_blog->meta_description }}</p>
                    <div class="line-detail my-3"></div>
                    <div class="text-slow">
                        <div class="mb-1"><i class="bi bi-calendar-event"></i> Published on {{ $main_blog->published_at->format('d M Y') }}</div>
                        <div class="mb-1"><i class="bi bi-pen"></i> Written by <a style="text-decoration: none; color: #fff" href="{!! route('front.profile.index', $main_blog->author->username) !!}">{{ $main_blog->author->name }}</a></div>
                        <div class="mb-1"><i class="bi bi-bookmark"></i>
                            <a href="{!! route('front.article.index', 'category=' . $main_blog->category->slug) !!}" class="badge rounded-pill text-bg-darks" style="background: rgb(118 106 255);">{{ $main_blog->category->title }}</a>
                        </div>
                        <div class="mb-1"><i class="bi bi-tags"></i>
                            @foreach ($main_blog->tags as $tag)
                                <a href="{!! route('front.article.index', 'tags=' . $tag->slug) !!}" class="badge rounded-pill text-bg-darks">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a href="{!! route('front.article.detail', $main_blog->slug) !!}">
                    <img class="thumbnails-ilsyaa d-none d-xl-block d-lg-block" src="{!! $main_blog->_image() !!}" alt="{{ $main_blog->title }}">
                </a>
            </div>
        </div>
    </div>
@else
    <div class="bg-head">
        <div class="text-light" style="background-image: linear-gradient(38deg, rgb(0 8 250 / 6%) 3%, #0b1120 50%);">
            <div class="container py-5 d-flex">
                {{-- backquote --}}
                <div class="desc">
                    <h1 class="display-5 fw-bold title-item-detail"><a class="href" href="#">No Article</a></h1>
                    <p class="text-muted h6 fw-bold text-slow d-none d-xl-block d-lg-block">No Article</p>
                    <div class="line-detail my-3"></div>
                    <div class="text-slow">
                        <div class="mb-1"><i class="bi bi-calendar-event"></i> Published on 00-00-0000</div>
                        <div class="mb-1"><i class="bi bi-pen"></i> Written by <a style="text-decoration: none; color: #fff" href="#">No Article</a></div>
                        <div class="mb-1"><i class="bi bi-bookmark"></i>
                            <a href="#" class="badge rounded-pill text-bg-darks" style="background: rgb(118 106 255);">No Article</a>
                        </div>
                        <div class="mb-1"><i class="bi bi-tags"></i>
                            <a href="#" class="badge rounded-pill text-bg-darks">No Article</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
