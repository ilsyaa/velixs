@extends('auth.auth')

@section('title', 'Verify Email')

@section('js')
    <script>
        // after submit form button loading
        $(document).on('submit', '.auth-resend-form', function() {
            $('.button-resend').prop('disabled', true);
            $('.button-resend').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/core/menu/menu-types/vertical-menu.css">
@endsection

@section('navbar')
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow container-xxl rounded">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <img style="height: 30px" src="{{ $websetting->logo() }}" alt="logo" />
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ Auth::user()->name }}</span>
                            <span class="user-status">{{ Auth::user()->username }}</span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{ Auth::user()->avatar() }}" alt="avatar" height="40" width="40">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('front.profile.settings') }}"><i class="me-50" data-feather="settings"></i> Settings</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" style="width: 100%;" type="submit"><i class="me-50" data-feather="power"></i> {{ __('Log Out') }}</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
@endsection


@section('content')
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <h4 class="card-title mb-1">Account Unverify</h4>
                    <p class="card-text mb-2">{{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body d-flex align-items-center">
                                <span>{{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}</span>
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-body d-flex align-items-center">
                                <span>
                                    <ul style="list-style-type: none; padding: 0; margin: 0;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </span>
                            </div>
                        </div>
                    @endif
                    <form class="auth-resend-form mt-2" action="{{ route('verification.send') }}" method="POST">
                        @csrf
                        <button type="submit" class="button-resend btn btn-primary w-100" tabindex="4">{{ __('Resend Verification Email') }}</button>
                    </form>

                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection
