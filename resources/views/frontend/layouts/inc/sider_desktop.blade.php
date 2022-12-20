<nav id="navigation-widget-small" class="navigation-widget navigation-widget-desktop closed sidebar left delayed">
    @if (auth()->check())
        <a class="user-avatar small no-outline online" href="{{ route('front.profile.index', $auth_user->username) }}">
            <div class="user-avatar-content">
                <div class="hexagon-image-30-32" data-src="{{ $auth_user->avatar() }}"></div>
            </div>
            <div class="user-avatar-progress">
                <div class="hexagon-progress-40-44"></div>
            </div>
            <div class="user-avatar-progress-border">
                <div class="hexagon-border-40-44"></div>
            </div>
            {!! $auth_user->star() !!}
        </a>
    @else
        <a class="user-avatar small no-outline online" href="{{ route('login') }}">
            <div class="user-avatar-content">
                <div class="hexagon-image-30-32" data-src="{{ asset('storage/avatar/default.jpg') }}"></div>
            </div>
            <div class="user-avatar-progress">
                <div class="hexagon-progress-40-44"></div>
            </div>
            <div class="user-avatar-progress-border">
                <div class="hexagon-border-40-44"></div>
            </div>
        </a>
    @endif
    <ul class="menu small">
        <li class="menu-item {{ Route::is('front.library.*') ? 'active' : '' }}">
            <a class="menu-item-link text-tooltip-tfr" href="{{ route('front.library.index') }}" data-title="Library">
                <svg class="menu-item-link-icon icon-wallet">
                    <use xlink:href="#svg-wallet"></use>
                </svg>
            </a>
        </li>
        <li class="menu-item {{ Route::is('front.product.*') ? 'active' : '' }}">
            <a class="menu-item-link text-tooltip-tfr" href="{{ route('front.product.index') }}" data-title="Products">
                <svg class="menu-item-link-icon icon-marketplace">
                    <use xlink:href="#svg-marketplace"></use>
                </svg>
            </a>
        </li>
        <li class="menu-item {{ Route::is('front.article.*') ? 'active' : '' }}">
            <a class="menu-item-link text-tooltip-tfr" href="{{ route('front.article.index') }}" data-title="Blog">
                <svg class="menu-item-link-icon icon-newsfeed">
                    <use xlink:href="#svg-newsfeed"></use>
                </svg>
            </a>
        </li>
    </ul>
</nav>

<nav id="navigation-widget" class="navigation-widget navigation-widget-desktop sidebar left hidden" data-simplebar>
    @if (auth()->check())
        <figure class="navigation-widget-cover liquid">
            <img src="" alt="">
        </figure>
        <div class="user-short-description">
            <a class="user-short-description-avatar user-avatar medium" href="{{ route('front.profile.index', $auth_user->username) }}">
                <div class="user-avatar-border">
                    <div class="hexagon-120-132"></div>
                </div>
                <div class="user-avatar-content">
                    <div class="hexagon-image-82-90" data-src="{{ $auth_user->avatar() }}"></div>
                </div>
                <div class="user-avatar-progress">
                    <div class="hexagon-progress-100-110"></div>
                </div>
                <div class="user-avatar-progress-border">
                    <div class="hexagon-border-100-110"></div>
                </div>
                @if ($auth_user->role == 'admin')
                    <div class="user-avatar-badge">
                        <div class="user-avatar-badge-border">
                            <div class="hexagon-32-36"></div>
                        </div>
                        <div class="user-avatar-badge-content">
                            <div class="hexagon-dark-26-28"></div>
                        </div>
                        <p class="user-avatar-badge-text">★</p>
                    </div>
                @endif
            </a>
            <p class="user-short-description-title"><a href="{{ route('front.profile.index', $auth_user->username) }}">{{ $auth_user->name }}</a></p>
            <p class="user-short-description-text"><a href="{{ route('front.profile.index', $auth_user->username) }}">{{ "@$auth_user->username" }}</a></p>
        </div>
    @else
        <figure class="navigation-widget-cover liquid">
            <img src="" alt="">
        </figure>
        <div class="user-short-description">
            <a class="user-short-description-avatar user-avatar medium" href="{{ route('login') }}">
                <div class="user-avatar-border">
                    <div class="hexagon-120-132"></div>
                </div>
                <div class="user-avatar-content">
                    <div class="hexagon-image-82-90" data-src="{{ asset('storage/avatar/default.jpg') }}"></div>
                </div>
                <div class="user-avatar-progress">
                    <div class="hexagon-progress-100-110"></div>
                </div>
                <div class="user-avatar-progress-border">
                    <div class="hexagon-border-100-110"></div>
                </div>
            </a>
            <p class="user-short-description-title"><a href="{{ route('login') }}">Guest</a></p>
        </div>
    @endif
    <ul class="menu">
        <li class="menu-item {{ Route::is('front.library.*') ? 'active' : '' }}">
            <a class="menu-item-link" href="{{ route('front.library.index') }}">
                <svg class="menu-item-link-icon icon-wallet">
                    <use xlink:href="#svg-wallet"></use>
                </svg>
                Library
            </a>
        </li>
        <li class="menu-item {{ Route::is('front.product.*') ? 'active' : '' }}">
            <a class="menu-item-link" href="{{ route('front.product.index') }}">
                <svg class="menu-item-link-icon icon-marketplace">
                    <use xlink:href="#svg-marketplace"></use>
                </svg>
                Products
            </a>
        </li>
        <li class="menu-item {{ Route::is('front.article.*') ? 'active' : '' }}">
            <a class="menu-item-link" href="{{ route('front.article.index') }}">
                <svg class="menu-item-link-icon icon-newsfeed">
                    <use xlink:href="#svg-newsfeed"></use>
                </svg>
                Blogs
            </a>
        </li>
    </ul>
</nav>
