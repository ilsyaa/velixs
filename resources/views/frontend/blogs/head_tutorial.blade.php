<div class="bg-head">
    <div class="text-light" style="background-image: linear-gradient(184deg, rgb(0 8 250 / 6%) 3%, #0b1120 50%);">
        <div class="container py-5">
            <div class="row">
                <div class="col col-xl-8">
                    <div class="desc py-5">
                        <div class="pb-5">
                            @if (!$req_category)
                                <h1 class="display-5 fw-bold title-item-detail">Tutorial Bahasa Pemogramman.</h1>
                                <p class="text-muted h6 fw-bold">Belajar pemrograman web, web design & mobile app lengkap dari dasar untuk pemula sampai mahir, tersedia tutorial dengan studi kasus.</p>
                                <h6 class="text-muted">Bingung mulai darimana, coba pilih topik berikut.</h6>
                            @else
                                <h1 class="display-5 fw-bold title-item-detail">{!! $meta['title'] !!}</h1>
                                <p class="text-muted h6 fw-bold">{!! $meta['meta_description'] !!}</p>
                            @endif
                        </div>
                        <div class="mt-4">
                            <a href="{!! route('front.topics.index', 'html') !!}" class="btn btn-dark mb-2" style="{!! $req_category == 'html' ? 'color: #ff8600;' : '' !!}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 4l-2 14.5l-6 2l-6 -2l-2 -14.5z"></path>
                                    <path d="M15.5 8h-7l.5 4h6l-.5 3.5l-2.5 .75l-2.5 -.75l-.1 -.5"></path>
                                </svg>
                            </a>
                            <a href="{!! route('front.topics.index', 'php') !!}"class="btn btn-dark mb-2 {{ $req_category == 'php' ? 'text-primary' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <ellipse cx="12" cy="12" rx="10" ry="9"></ellipse>
                                    <path d="M5.5 15l.395 -1.974l.605 -3.026h1.32a1 1 0 0 1 .986 1.164l-.167 1a1 1 0 0 1 -.986 .836h-1.653"></path>
                                    <path d="M15.5 15l.395 -1.974l.605 -3.026h1.32a1 1 0 0 1 .986 1.164l-.167 1a1 1 0 0 1 -.986 .836h-1.653"></path>
                                    <path d="M12 7.5l-1 5.5"></path>
                                    <path d="M11.6 10h2.4l-.5 3"></path>
                                </svg>
                            </a>
                            <a href="{!! route('front.topics.index', 'laravel') !!}" class="btn btn-dark mb-2 {{ $req_category == 'laravel' ? 'text-danger' : '' }}">
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
                            <a href="{!! route('front.topics.index', 'bootstrap') !!}" class="btn btn-dark mb-2 {{ $req_category == 'bootstrap' ? 'text-primary' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo-500" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M2 12a2 2 0 0 0 2 -2v-4a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4a2 2 0 0 0 2 2"></path>
                                    <path d="M2 12a2 2 0 0 1 2 2v4a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-4a2 2 0 0 1 2 -2"></path>
                                    <path d="M9 16v-8h3.5a2 2 0 1 1 0 4h-3.5h4a2 2 0 1 1 0 4h-4z"></path>
                                </svg>
                            </a>
                            <a href="{!! route('front.topics.index', 'js') !!}" class="btn btn-dark mb-2 {{ $req_category == 'js' ? 'text-warning' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-400" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 4l-2 14.5l-6 2l-6 -2l-2 -14.5z"></path>
                                    <path d="M7.5 8h3v8l-2 -1"></path>
                                    <path d="M16.5 8h-2.5a0.5 .5 0 0 0 -.5 .5v3a0.5 .5 0 0 0 .5 .5h1.423a0.5 .5 0 0 1 .495 .57l-.418 2.93l-2 .5"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </div>
</div>
