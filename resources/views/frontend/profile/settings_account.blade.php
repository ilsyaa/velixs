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
                                <form action="{!! route('front.profile.settings.update', 'info') !!}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="text-muted small">Full Name</label>
                                        <input type="text" name="name" class="form-control" required value="{{ $me->name }}" autocomplete="off">
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-xl-6 col-lg-6">
                                            <div class="mb-3">
                                                <label class="text-muted small">Email</label>
                                                <input type="email" name="email" class="form-control" required value="{{ $me->email }}" autocomplete="off">
                                                <span style="font-size: 12px" class="text-muted">Changing the email will require re-verification of the new email.</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 col-lg-6">
                                            <div class="mb-3">
                                                <label class="text-muted small">Username</label>
                                                <input type="text" class="form-control" name="username" required value="{{ $me->username }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small">Username</label>
                                        <textarea rows="4" class="form-control" name="about" autocomplete="off">{{ $me->about }}</textarea>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary btn-sm"><i style="font-size: 14px" class="bi bi-save"></i> Save Changes!</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer py-1 text-end">
                                <small class="text-muted">Account Info</small>
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
        $(document).on('keyup', 'input[name="username"]', function() {
            var username = $(this).val();
            $(this).val(username.toLowerCase().replace(/[^a-zA-Z0-9_-]/g, ''));
        });
    </script>
@endpush
