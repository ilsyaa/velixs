<nav id="navigation-widget-mobile" class="navigation-widget navigation-widget-mobile sidebar left hidden" data-simplebar>
    @if (auth()->check())
        <div class="navigation-widget-close-button">
            <svg class="navigation-widget-close-button-icon icon-back-arrow">
                <use xlink:href="#svg-back-arrow"></use>
            </svg>
        </div>
        <div class="navigation-widget-info-wrap">
            <div class="navigation-widget-info">
                <a class="user-avatar small no-outline" href="{{ route('front.profile.index', $auth_user->username) }}">
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
                <p class="navigation-widget-info-title"><a href="{{ route('front.profile.index', $auth_user->username) }}">{{ $auth_user->name }}</a></p>
                <p class="navigation-widget-info-text">Welcome Back!</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="navigation-widget-info-button button small secondary" type="submit"><i class="me-50" data-feather="power"></i> {{ __('Log Out') }}</button>
            </form>
        </div>
    @else
        <div class="navigation-widget-close-button">
            <svg class="navigation-widget-close-button-icon icon-back-arrow">
                <use xlink:href="#svg-back-arrow"></use>
            </svg>
        </div>
        <div class="navigation-widget-info-wrap">
            <div class="navigation-widget-info">
                <a class="user-avatar small no-outline" href="{{ route('login') }}">
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
                <p class="navigation-widget-info-title"><a href="{{ route('login') }}">Guest</a></p>
                <p class="navigation-widget-info-text">Login or register!</p>
            </div>
        </div>
    @endif

    <p class="navigation-widget-section-title">Main Menu</p>
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
    @if ($auth_user)
        <p class="navigation-widget-section-title">My Profile</p>
        <a class="navigation-widget-section-link" href="{{ route('front.profile.index', $auth_user->username) }}">Profile Info</a>
        <a class="navigation-widget-section-link" href="{{ route('front.library.index') }}">Library</a>
        <a class="navigation-widget-section-link" href="{{ route('front.profile.settings') }}">Settings</a>
    @endif
    <p class="navigation-widget-section-title">Other Menu</p>
    <a class="navigation-widget-section-link" href="{{ route('front.license.index') }}">Claim License</a>
    <a class="navigation-widget-section-link" href="{{ route('policy.show') }}">Privacy Policy</a>
</nav>
