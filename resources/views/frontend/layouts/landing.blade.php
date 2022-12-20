<!-- CEK CONSOLE LOG -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{!! asset('frontend/landing') !!}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{!! asset('frontend/landing') !!}/vendor/initoastdek/style.css" rel="stylesheet">
    <link href="{!! asset('frontend/landing') !!}/terserahgw/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('frontend/landing') !!}/vendor/bootstrap-icons/font/bootstrap-icons.css">
    @include('frontend.layouts.inc.meta')
    @livewireStyles
    @stack('css')
</head>

<body>
    <div class="nanobar" style="position: fixed;">
        <div class="bar"></div>
    </div>
    <div class="bacot-monyet">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark border-bottom border-secondary">
            <div class="container container-nav">
                <a class="navbar-brand" href="#"><img class="logo-ilsya" src="{!! $websetting->logo() !!}"></a>
                <div class="navbar-collapse d-none d-lg-block">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link {!! Route::is('index') ? 'active' : '' !!}" href="{!! route('index') !!}"> Home Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {!! Route::is('front.article.*') ? 'active' : '' !!}" href="{!! route('front.article.index') !!}">Article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {!! (Route::is('front.tutorial.*') ? 'active' : Route::is('front.topics.*')) ? 'active' : '' !!}" href="{!! route('front.tutorial.index') !!}">Tutorial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {!! Route::is('front.product.*') ? 'active' : '' !!}" href="{!! route('front.product.category') !!}">Digital Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {!! Route::is('front.license.*') ? 'active' : '' !!}" href="{!! route('front.license.index') !!}">License</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-dark" id="button-search" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-search">
                        <i class="bi bi-search" style="font-size: 14px;"></i>
                        <span class="d-none d-xl-inline">
                            Search anything...
                            <i class="bi bi-command"></i> + K
                        </span>
                    </button>
                    <div class="dropdown d-block d-lg-none">
                        <button type="button" class="btn btn-dark" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <i class="bi bi-list"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-navbar">
                            <li><a href="{!! route('index') !!}" class="dropdown-item"><i class="bi bi-house"></i> Home Page</a></li>
                            <li><a href="{!! route('front.article.index') !!}" class="dropdown-item"><i class="bi bi-tag"></i> Article</a></li>
                            <li><a href="{!! route('front.tutorial.index') !!}" class="dropdown-item"><i class="bi bi-journal-code"></i> Tutorial</a></li>
                            <li><a href="{!! route('front.product.category') !!}" class="dropdown-item"><i class="bi bi-bag"></i> Digital Products</a></li>
                            <li><a href="{!! route('front.license.index') !!}" class="dropdown-item"><i class="bi bi-window"></i> License</a></li>
                            @if ($auth_user)
                                @if ($auth_user->role == 'admin')
                                    <div class="line-nav"></div>
                                    <li><a href="{!! route('dashboards') !!}" class="dropdown-item"><i class="bi bi-terminal-dash"></i> Admin Dashboards</a></li>
                                    <li><a href="{!! route('license.index') !!}" class="dropdown-item"><i class="bi bi-hash"></i> Manage License </a></li>
                                @endif
                                <div class="line-nav"></div>
                                <li><a href="{!! route('front.profile.index', $auth_user->username) !!}" class="dropdown-item"><i class="bi bi-person"></i> Welcome, {{ explode(' ', $auth_user->name)[0] }}</a></li>
                                <li><a href="{!! route('front.library.index') !!}" class="dropdown-item"><i class="bi bi-wallet"></i> My Library</a></li>
                                <li><a href="{!! route('front.profile.settings') !!}" class="dropdown-item"><i class="bi bi-gear"></i> Settings</a></li>
                                <li>
                                    <form action="{!! route('logout') !!}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                    </form>
                                </li>
                            @else
                                <li><a href="{!! route('login') !!}" class="dropdown-item"><i class="bi bi-box-arrow-in-left"></i> Sign In</a></li>
                                <li><a href="{!! route('register') !!}" class="dropdown-item"><i class="bi bi-person"></i> Sign Up</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="d-none d-lg-inline">
                    @if ($auth_user)
                        <a href="javascript:void" data-bs-toggle="offcanvas" data-bs-target="#profile-offcanvas" aria-controls="offcanvasRight">
                            <img style="height: 37px; width: 37px;object-fit: cover; border-radius: 50%;margin-left: 10px;" src="{!! $auth_user->avatar() !!}" alt="{{ $auth_user->name }}">
                        </a>
                    @else
                        <a href="{!! route('login') !!}" class="btn btn-dark">Sign In</a>
                        <a href="{!! route('register') !!}" class="btn btn-dark">Sign Up</a>
                    @endif
                </div>
            </div>
        </nav>
        @yield('content')
        <div class="push"></div>
    </div>
    <div class="modal fade" id="modal-search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            @livewire('landing.search-anything')
        </div>
    </div>
    @if ($auth_user)
        <div class="offcanvas offcanvas-end text-light bg-glass" data-bs-backdrop="false" tabindex="-1" id="profile-offcanvas" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel"><i class="bi bi-app-indicator"></i></h5>
                <a href="javascript:void(0)" class="href" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x-circle"></i></a>
            </div>
            <div class="offcanvas-body">
                <div class="text-center">
                    <img style="height: 100px; width: 100px; object-fit: cover; border-radius: 50%;" src="{!! $auth_user->avatar() !!}" alt="{{ $auth_user->name }}">
                    <h5 class="mt-3 mb-0 fw-bold text-slow">{{ $auth_user->name }}</h5>
                    <p class="text-muted">{{ $auth_user->username }}</p>
                    <div class="line-nav"></div>
                    @if ($auth_user->role == 'admin')
                        <a class="w-100 mb-2 btn btn-dark" href="{!! route('dashboards') !!}"><i class="bi bi-terminal-dash"></i> Admin Dashboards</a>
                        <a class="w-100 mb-2 btn btn-dark" href="{!! route('license.index') !!}"><i class="bi bi-hash"></i> Manage License</a>
                    @endif
                    <div class="line-nav"></div>
                    <div class="d-block">
                        <a class="w-100 mb-2 btn btn-dark" href="{!! route('front.profile.index', $auth_user) !!}"><i class="bi bi-person"></i> Profile</a>
                        <a class="w-100 mb-2 btn btn-dark" href="{!! route('front.library.index') !!}"><i class="bi bi-wallet"></i> My Library</a>
                        <a class="w-100 mb-2 btn btn-dark" href="{!! route('front.profile.settings') !!}"><i class="bi bi-gear"></i> Settings</a>
                        <form action="{!! route('logout') !!}" method="POST">
                            @csrf
                            <button type="submit" class="w-100 mb-2 btn btn-dark"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endif
    <script src="{!! asset('frontend/landing') !!}/js/bootstrap.bundle.min.js"></script>
    <script src="{!! asset('frontend/landing') !!}/vendor/initoastdek/siiimple-toast.min.js"></script>
    <script src="{!! asset('frontend/landing') !!}/vendor/bar/nanobar.min.js"></script>
    <script src="{!! asset('frontend/landing/terserahgw/script.js') !!}"></script>
    @livewireScripts
    @stack('js')
    @if (session('success'))
        <script>
            siiimpleToast.message('{!! session('success') !!}', {
                position: "bottom|left",
                margin: 12,
                delay: 0,
                duration: 5000,
            });
        </script>
    @elseif (session('error'))
        <script>
            siiimpleToast.message('{!! session('error') !!}', {
                position: "bottom|left",
                margin: 12,
                delay: 0,
                duration: 5000,
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            siiimpleToast.message('<i class="bi bi-exclamation-circle"></i> {!! $errors->first() !!}', {
                position: "bottom|left",
                margin: 12,
                delay: 0,
                duration: 5000,
            });
        </script>
    @endif

</body>

</html>
