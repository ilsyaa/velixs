@extends('frontend.layouts.landing')

@section('content')
    @include('frontend.profile.inc_header')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col col-12 col-xl-10">
                <div class="row">
                    <div class="col-12 col-xl-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="text-slow">
                                    <div class="d-block">
                                        <div><i class="bi bi-person-circle"></i> My Profile </div>
                                        <small class="text-muted">Change your avatar, name, password and more!</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-4 d-grid py-4">
                                @include('frontend.profile.inc_menu_settings')
                            </div>
                            <div class="card-footer py-1">
                                <small class="text-muted">{{ $websetting->app_title }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form action="{!! route('front.profile.settings.update', 'security') !!}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="text-muted small">Confirm Current Password</label>
                                        <input type="text" name="current_password" class="form-control" required autocomplete="off">
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-xl-6 col-lg-6">
                                            <div class="mb-3">
                                                <label class="text-muted small">New Password</label>
                                                <input type="text" name="new_password" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 col-lg-6">
                                            <div class="mb-3">
                                                <label class="text-muted small">Confirm New Password</label>
                                                <input type="text" class="form-control" name="new_password_confirmation" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary btn-sm"><i style="font-size: 14px" class="bi bi-key"></i> Change Password!</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer py-1 text-end">
                                <small class="text-muted">Security <small class="bi bi-chevron-right"></small> Change Password</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .btn-setting-profile:hover {
            margin-left: 10px;
            color: rgb(30, 255, 0);
        }

        .btn-setting-profile {
            transition: 0.5s;
            font-size: 15px;
        }
    </style>
@endpush

@push('js')
    <script src="{!! asset('frontend/landing/vendor/jquery.min.js') !!}"></script>
    <script>
        $('input[name="new_password_confirmation"]').on('keyup', function() {
            if ($('input[name="new_password"]').val() !== $(this).val()) {
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
    </script>
@endpush
