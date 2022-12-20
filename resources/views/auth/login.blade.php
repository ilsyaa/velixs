@extends('auth.auth')

@section('title', 'Log in Account')

@section('js')
    <script>
        $(function() {
            'use strict';
            var pageLoginForm = $('.auth-form');
            if (pageLoginForm.length) {
                pageLoginForm.validate({
                    rules: {
                        'email': {
                            required: true
                        },
                        'password': {
                            required: true
                        }
                    }
                });
            }
        });

        $(document).on('submit', '.auth-form', function() {
            $('.button-fm').prop('disabled', true);
            $('.button-fm').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        });
    </script>
@endsection

@section('content')
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href={{ route('index') }}" class="brand-logo">
                        <img src="{{ $websetting->logo() }}" alt="{{ $websetting->meta_title }}">
                    </a>

                    <h4 class="card-title mb-1">Log in Account</h4>
                    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>

                    {{-- show error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                <ul class="mb-0 p-0" style=" list-style-type: none;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- show session status --}}
                    @if (session('status'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ session('status') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="auth-form mt-2" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Email or username</label>
                            <input type="text" value="{{ old('email') }}" class="form-control" name="email" placeholder="Enter username or email" tabindex="1" autofocus />
                        </div>

                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">Password</label>
                                <a href="{{ route('password.request') }}">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" name="remember" type="checkbox" checked tabindex="3" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <button type="submit" class="button-fm btn btn-primary w-100" tabindex="4">Log in</button>
                    </form>

                    <p class="text-center mt-2">
                        <span>New on our platform?</span>
                        <a href="{{ route('register') }}">
                            <span>Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection
