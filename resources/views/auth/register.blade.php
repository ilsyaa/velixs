@extends('auth.auth')

@section('title', 'Register Account')

@section('content')

    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <a class="brand-logo" href="{{ route('index') }}">
                <img src="{{ $websetting->logo() }}" alt="{{ $websetting->meta_title }}">
            </a>

            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{ asset('adminpanel') }}/images/pages/register-v2.svg" alt="Register V2" /></div>
            </div>

            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Create your account</h2>
                    <p class="card-text mb-2">Enter your personal details to create account</p>
                    @if (session('status'))
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body d-flex align-items-center">
                                <span>{{ session('status') }}</span>
                            </div>
                        </div>
                    @endif
                    <form class="auth-form mt-2" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="register-username">Full Name</label>
                            <input class="form-control" type="text" name="name" autofocus placeholder="Enter your name" value="{{ old('name') }}">
                            @error('name')
                                <small>
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                </small>
                            @enderror
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 col-xl-6 col-lg-6">
                                <div class="mb-1">
                                    <label class="form-label" for="register-username">Username</label>
                                    <input class="form-control" type="text" name="username" value="{{ old('username') }}" placeholder="Enter your username" />
                                    @error('username')
                                        <small>
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 col-lg-6">
                                <div class="mb-1">
                                    <label class="form-label" for="register-email">Email Address</label>
                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" />
                                    @error('email')
                                        <small>
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="register-password">Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="Enter password" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                            @error('password')
                                <small>
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                </small>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="register-password">Confirm Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" type="password" name="password_confirmation" placeholder="Repeat Password" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                @error('password_confirmation')
                                    <small>
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" name="terms" type="checkbox" tabindex="4" checked />
                                <label class="form-check-label" for="register-privacy-policy">I agree to<a href="{{ route('policy.show') }}" target="_blank">&nbsp;privacy policy</a> & <a href="{{ route('terms.show') }}" target="_blank">terms</a></label>
                            </div>
                        </div>
                        <button type="submit" class="button-fm btn btn-primary w-100" tabindex="5">Register</button>
                    </form>
                    <p class="text-center mt-2"><span>Already have an account?</span><a href="{{ route('login') }}"><span>&nbsp;Log in</span></a></p>
                </div>
            </div>
            <!-- /Register-->
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function() {
            'use strict';
            var pageLoginForm = $('.auth-form');
            if (pageLoginForm.length) {
                var result = pageLoginForm.validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 5
                        },
                        username: {
                            required: true,
                            minlength: 5,
                            alpa_dash: true
                        },
                        email: {
                            required: true
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        'password_confirmation': {
                            required: true,
                            minlength: 8,
                            equalTo: '#password'
                        },
                        terms: {
                            required: true
                        }
                    },
                    messages: {
                        password: {
                            required: 'Enter new password',
                            minlength: 'Enter at least 8 characters'
                        },
                        'confirm-password': {
                            required: 'Please confirm new password',
                            minlength: 'Enter at least 8 characters',
                            equalTo: 'The password and its confirm are not the same'
                        },
                        'terms': {
                            required: 'Please accept our terms'
                        }
                    }

                });
            }
        });

        $(document).on('submit', '.auth-form', function() {
            $('.button-fm').prop('disabled', true);
            $('.button-fm').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        });

        $(document).on('keyup', 'input[name="username"]', function() {
            var username = $(this).val();
            $(this).val(username.toLowerCase().replace(/[^a-zA-Z0-9_-]/g, ''));
        });
    </script>
@endsection
