<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/styles.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/vendor/simplebar.css">
    <link href="{{ asset('frontend') }}/vendor/toastjing/style.css" rel="stylesheet">
    @include('frontend.layouts.inc.meta')
    @stack('css')
</head>

<body>
    <div class="page-loader">
        <div class="page-loader-decoration" style="background-color: unset;">
            <div class="page-loader-indicator loader-bars">
                <div class="loader-bar"></div>
                <div class="loader-bar"></div>
                <div class="loader-bar"></div>
            </div>
        </div>
        <div class="page-loader-info">
            <p class="page-loader-info-text">Metavis Loading</p>
        </div>
    </div>

    @include('frontend.layouts.inc.sider_desktop')
    @include('frontend.layouts.inc.sider_mobile')
    <!-- CHAT WIDGET -->
    <aside id="chat-widget-messages" class="chat-widget closed sidebar right">
        <div class="chat-widget-messages" data-simplebar>
            @foreach ($user_active as $ua)
                <a href="{{ route('front.profile.index', $ua->username) }}">
                    <div class="chat-widget-message">
                        <div class="user-status">
                            <div class="user-status-avatar">
                                <div class="user-avatar small no-outline online">
                                    <div class="user-avatar-content">
                                        <div class="hexagon-image-30-32" data-src="{{ $ua->avatar() }}"></div>
                                    </div>
                                    <div class="user-avatar-progress">
                                        <div class="hexagon-progress-40-44"></div>
                                    </div>
                                    <div class="user-avatar-progress-border">
                                        <div class="hexagon-border-40-44"></div>
                                    </div>
                                    {!! $ua->star() !!}
                                </div>
                            </div>
                            <p class="user-status-title"><span class="bold">{{ $ua->name }}</span></p>
                            <p class="user-status-text small" style="color:#40d04f">Online</p>
                        </div>
                    </div>
                </a>
            @endforeach

            @foreach ($user_list as $ul)
                <a href="{{ route('front.profile.index', $ul->username) }}">
                    <div class="chat-widget-message">
                        <div class="user-status">
                            <div class="user-status-avatar">
                                <div class="user-avatar small no-outline">
                                    <div class="user-avatar-content">
                                        <div class="hexagon-image-30-32" data-src="{{ $ul->avatar() }}"></div>
                                    </div>
                                    <div class="user-avatar-progress">
                                        <div class="hexagon-progress-40-44"></div>
                                    </div>
                                    <div class="user-avatar-progress-border">
                                        <div class="hexagon-border-40-44"></div>
                                    </div>
                                    {!! $ul->star() !!}
                                </div>
                            </div>
                            <p class="user-status-title"><span class="bold">{{ $ul->name }}</span></p>
                            <p class="user-status-text small">{{ $ul->last_seen->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <form class="chat-widget-form">
            <div class="interactive-input small">
                <input type="text" id="chat-widget-search" name="search" placeholder="Search User..." autocomplete="off">
                <div class="interactive-input-icon-wrap">
                    <svg class="interactive-input-icon icon-magnifying-glass">
                        <use xlink:href="#svg-magnifying-glass"></use>
                    </svg>
                </div>
                <div class="interactive-input-action">
                    <svg class="interactive-input-action-icon icon-cross-thin">
                        <use xlink:href="#svg-cross-thin"></use>
                    </svg>
                </div>
            </div>
        </form>
        <div class="chat-widget-button">
            <div class="chat-widget-button-icon">
                <div class="burger-icon">
                    <div class="burger-icon-bar"></div>
                    <div class="burger-icon-bar"></div>
                    <div class="burger-icon-bar"></div>
                </div>
            </div>
            <p class="chat-widget-button-text">Users Active</p>
        </div>
    </aside>

    <header class="header" style="background-color: #21293d;">
        <div class="header-actions">
            <div class="header-brand">
                <div class="logo">
                    <img style="height: 36px" src="{{ $websetting->logo() }}" alt="logo">
                </div>
            </div>
        </div>
        <div class="header-actions">
            <div class="sidemenu-trigger navigation-widget-trigger">
                <svg class="icon-grid">
                    <use xlink:href="#svg-grid"></use>
                </svg>
            </div>
            <div class="mobilemenu-trigger navigation-widget-mobile-trigger">
                <div class="burger-icon inverted">
                    <div class="burger-icon-bar"></div>
                    <div class="burger-icon-bar"></div>
                    <div class="burger-icon-bar"></div>
                </div>
            </div>

            <!-- NAVIGATION -->
            <nav class="navigation">
                <ul class="menu-main">
                    <li class="menu-main-item">
                        <a class="menu-main-item-link" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="menu-main-item">
                        <a class="menu-main-item-link" href="{!! route('front.license.index') !!}">License</a>
                    </li>
                    <li class="menu-main-item">
                        <a class="menu-main-item-link" href="#">Tools</a>
                    </li>
                    <li class="menu-main-item">
                        <p class="menu-main-item-link">
                            <svg class="icon-dots">
                                <use xlink:href="#svg-dots"></use>
                            </svg>
                        </p>
                        <ul class="menu-main" style="background-color: #202635;">
                            <li class="menu-main-item">
                                <a class="menu-main-item-link" href="#">About Us</a>
                            </li>
                            <li class="menu-main-item">
                                <a class="menu-main-item-link" href="">Our Blog</a>
                            </li>
                            <li class="menu-main-item">
                                <a class="menu-main-item-link" href="#">Contact Us</a>
                            </li>
                            <li class="menu-main-item">
                                <a class="menu-main-item-link" href="{{ route('policy.show') }}">Privacy Policy</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>
        <!-- /HEADER ACTIONS -->

        <!-- HEADER ACTIONS -->
        <div class="header-actions search-bar">
            <div class="interactive-input dark">
                <input type="text" id="search-main" name="search_main" autocomplete="off" placeholder="Search here for people or groups" style="background-color: #1c212d;">
                <div class="interactive-input-icon-wrap">
                    <svg class="interactive-input-icon icon-magnifying-glass">
                        <use xlink:href="#svg-magnifying-glass"></use>
                    </svg>
                </div>
                <div class="interactive-input-action">
                    <svg class="interactive-input-action-icon icon-cross-thin">
                        <use xlink:href="#svg-cross-thin"></use>
                    </svg>
                </div>
            </div>
        </div>
        <!-- /HEADER ACTIONS -->

        <!-- HEADER ACTIONS -->
        <div class="header-actions">
            <div class="progress-stat">
                <div class="bar-progress-wrap">
                    <p class="bar-progress-info">Next: <span class="bar-progress-text"></span></p>
                </div>
                <div id="logged-user-level" class="progress-stat-bar"></div>
            </div>
        </div>
        <div class="header-actions">
            <div class="action-list dark">
                <div class="action-list-item-wrap">
                    <a href="{!! route('front.library.index') !!}" class="action-list-item ">
                        <svg class="action-list-item-icon icon-wallet">
                            <use xlink:href="#svg-wallet"></use>
                        </svg>
                    </a>
                </div>
                <div class="action-list-item-wrap">
                    <div class="action-list-item unread header-dropdown-trigger">
                        <svg class="action-list-item-icon icon-notification">
                            <use xlink:href="#svg-notification"></use>
                        </svg>
                    </div>
                    <div class="dropdown-box header-dropdown">
                        <div class="dropdown-box-header">
                            <p class="dropdown-box-header-title">Notifications</p>
                            <div class="dropdown-box-header-actions">
                                <p class="dropdown-box-header-action">Mark all as Read</p>
                                <p class="dropdown-box-header-action">Settings</p>
                            </div>
                        </div>
                        <div class="dropdown-box-list" data-simplebar>
                            <div class="dropdown-box-list-item unread">

                            </div>
                        </div>
                        <a class="dropdown-box-button secondary" href="#">View all Notifications</a>
                    </div>
                </div>
            </div>
            <div class="action-item-wrap">
                <div class="action-item dark header-settings-dropdown-trigger">
                    <svg class="action-item-icon icon-profile">
                        <use xlink:href="#svg-profile"></use>
                    </svg>
                </div>
                @if ($auth_user)
                    <div class="dropdown-navigation header-settings-dropdown">
                        <div class="dropdown-navigation-header">
                            <div class="user-status">
                                <a class="user-status-avatar" href="{{ route('front.profile.index', $auth_user->username) }}">
                                    <div class="user-avatar small no-outline">
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
                                    </div>
                                </a>
                                <p class="user-status-title"><span class="bold">Hi {{ $auth_user->name }}!</span></p>
                                <p class="user-status-text small"><a href="{{ route('front.profile.index', $auth_user->username) }}">{{ "@$auth_user->username" }}</a></p>
                            </div>
                        </div>
                        @if ($auth_user->role == 'admin')
                            <p class="dropdown-navigation-category">Admin</p>
                            <a class="dropdown-navigation-link" href="{{ route('dashboards') }}">Dashboards</a>
                            <a class="dropdown-navigation-link" href="{{ route('license.index') }}">License Manage</a>
                        @endif
                        <p class="dropdown-navigation-category">My Profile</p>
                        <a class="dropdown-navigation-link" href="{{ route('front.profile.index', $auth_user->username) }}">Profile Info</a>
                        <a class="dropdown-navigation-link" href="{{ route('front.library.index') }}">Library</a>
                        <a class="dropdown-navigation-link" href="#">Notification</a>
                        <p class="dropdown-navigation-category">Account</p>
                        <a class="dropdown-navigation-link" href="{{ route('front.profile.settings.changepassword') }}">Change Password</a>
                        <a class="dropdown-navigation-link" href="{{ route('front.profile.settings') }}">Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="navigation-widget-info-button button small secondary mt-3" type="submit"><i class="me-50" data-feather="power"></i> {{ __('Log Out') }}</button>
                        </form>
                    </div>
                @else
                    <div class="dropdown-navigation header-settings-dropdown">
                        <div class="dropdown-navigation-header">
                            <div class="user-status">
                                <a class="user-status-avatar" href="javascript:void()">
                                    <div class="user-avatar small no-outline">
                                        <div class="user-avatar-content">
                                            <div class="hexagon-image-30-32" data-src="{{ asset('storage/avatar/default.jpg') }}"></div>
                                        </div>
                                        <div class="user-avatar-progress">
                                            <div class="hexagon-progress-40-44"></div>
                                        </div>
                                        <div class="user-avatar-progress-border">
                                            <div class="hexagon-border-40-44"></div>
                                        </div>
                                    </div>
                                </a>
                                <p class="user-status-title"><span class="bold">Hi Guest!</span></p>
                                <p class="user-status-text small"><a href="{{ route('login') }}">guest</a></p>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="dropdown-navigation-button button small primary">Login</a>
                        <a href="{{ route('register') }}" class="dropdown-navigation-button button small secondary">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <aside class="floaty-bar">
        <div class="bar-actions">
            <div class="progress-stat">
                <div class="bar-progress-wrap">
                    <p class="bar-progress-info">Next: <span class="bar-progress-text"></span></p>
                </div>
                <div id="logged-user-level-cp" class="progress-stat-bar"></div>
            </div>
        </div>
        <div class="bar-actions">
            <div class="action-list dark">
                <a class="action-list-item" href="{!! route('front.product.index') !!}">
                    <svg class="action-list-item-icon icon-marketplace">
                        <use xlink:href="#svg-marketplace"></use>
                    </svg>
                </a>
                <a class="action-list-item" href="{{ route('front.article.index') }}">
                    <svg class="action-list-item-icon icon-newsfeed">
                        <use xlink:href="#svg-newsfeed"></use>
                    </svg>
                </a>
                <a class="action-list-item" href="#">
                    <svg class="action-list-item-icon icon-messages">
                        <use xlink:href="#svg-messages"></use>
                    </svg>
                </a>
                <a class="action-list-item unread" href="{{ route('front.library.index') }}">
                    <svg class="action-list-item-icon icon-wallet">
                        <use xlink:href="#svg-wallet"></use>
                    </svg>
                </a>
            </div>
            @if ($auth_user)
                <a class="action-item-wrap" href="{!! route('front.profile.index', $auth_user->username) !!}">
                    <div class="action-item dark">
                        <svg class="action-item-icon icon-profile">
                            <use xlink:href="#svg-profile"></use>
                        </svg>
                    </div>
                </a>
            @else
                <a class="action-item-wrap" href="{!! route('login') !!}">
                    <div class="action-item dark">
                        <svg class="action-item-icon icon-profile">
                            <use xlink:href="#svg-profile"></use>
                        </svg>
                    </div>
                </a>
            @endif
        </div>
    </aside>

    @yield('content')

    <script src="{{ asset('frontend') }}/js/utils/app.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/xm_plugins.min.js"></script>
    <script src="{{ asset('frontend') }}/js/main.metavis.js"></script>
    <script src="{{ asset('frontend') }}/js/utils/svg-loader.js"></script>
    <script src="{{ asset('frontend') }}/vendor/toastjing/siiimple-toast.min.js"></script>
    @if (session('success'))
        <script>
            siiimpleToast.message("{!! session('success') !!}", {
                margin: 15,
                duration: 5000,
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            siiimpleToast.message("{!! session('error') !!}", {
                margin: 15,
                duration: 5000,
            });
        </script>
    @endif
    @stack('js')
</body>

</html>
