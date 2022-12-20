@extends('auth.auth')

@section('title', 'Confirm Password')

@section('js')
    <script>
        $(function() {
            'use strict';
            var pageLoginForm = $('.auth-confirm-form');
            if (pageLoginForm.length) {
                var result = pageLoginForm.validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 8
                        }
                    }
                });
            }
        });

        // after submit form button loading
        $(document).on('submit', '.auth-confirm-form', function() {
            $('.button-confirm').prop('disabled', true);
            $('.button-confirm').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        });
    </script>
@endsection


@section('content')
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <h4 class="card-title mb-1">Confirm Password</h4>
                    <p class="card-text mb-2">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
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
                    <form class="auth-confirm-form mt-2" action="{{ route('password.confirm') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="register-password">Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" type="password" autofocus name="password" autocomplete="current-password" placeholder="Enter password" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <button type="submit" class="button-confirm btn btn-primary w-100" tabindex="4">{{ __('Confirm') }}</button>
                    </form>
                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection
