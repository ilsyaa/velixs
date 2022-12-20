@extends('auth.auth')

@section('title', 'Reset Password')

@section('js')
    <script>
        $(function() {
            'use strict';
            var pageLoginForm = $('.auth-reset-form');
            if (pageLoginForm.length) {
                var result = pageLoginForm.validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 8
                        },
                        'password_confirmation': {
                            required: true,
                            minlength: 8,
                            equalTo: '#password'
                        },
                        messages: {
                            password: {
                                required: 'Enter new password',
                                minlength: 'Enter at least 8 characters'
                            },
                            'password_confirmation': {
                                required: 'Please confirm new password',
                                minlength: 'Enter at least 8 characters',
                                equalTo: 'The password and its confirm are not the same'
                            }
                        }
                    }
                });
            }
        });

        // after submit form button loading
        $(document).on('submit', '.auth-reset-form', function() {
            $('.button-reset').prop('disabled', true);
            $('.button-reset').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
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

                    <h4 class="card-title mb-1">Reset Password</h4>
                    <p class="card-text mb-2">{{ __('Use a combination of uppercase numbers and symbols for secure passwords.') }}</p>
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
                    <form class="auth-reset-form mt-2" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

                        <div class="mb-1">
                            <label class="form-label" for="register-password">New Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password" type="password" name="password" autocomplete="new-password" placeholder="Enter new password" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="register-password">Confirm Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Repeat password" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <button type="submit" class="button-reset btn btn-primary w-100" tabindex="4">{{ __('Reset Password') }}</button>
                    </form>
                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection
