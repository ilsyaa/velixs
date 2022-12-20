@extends('auth.auth')

@section('title', 'Forgot Password')

@section('js')
    <script>
        $(function() {
            'use strict';
            var pageLoginForm = $('.auth-forgot-form');
            if (pageLoginForm.length) {
                var result = pageLoginForm.validate({
                    rules: {
                        'email': {
                            required: true
                        }
                    }
                });
            }
        });

        // after submit form button loading
        $(document).on('submit', '.auth-forgot-form', function() {
            $('.button-forgot').prop('disabled', true);
            $('.button-forgot').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        });
    </script>
@endsection


@section('content')
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="{{ route('index') }}" class="brand-logo">
                        <img src="{{ $websetting->logo() }}" alt="{{ $websetting->meta_title }}">
                    </a>

                    <h4 class="card-title mb-1">Forgot Password</h4>
                    <p class="card-text mb-2">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                    @if (session('status'))
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body d-flex align-items-center">
                                <span>{{ session('status') }}</span>
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
                    <form class="auth-forgot-form mt-2" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email account" tabindex="1" autofocus />
                        </div>
                        <button type="submit" class="button-forgot btn btn-primary w-100" tabindex="4">{{ __('Forgot Password') }}</button>
                    </form>

                    <p class="text-center mt-2">
                        <a href="{{ route('login') }}">
                            <span>Log in</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection
