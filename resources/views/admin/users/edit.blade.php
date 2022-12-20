@extends('admin.layouts.main')

@section('title', 'Edit User "' . $user->name . '"')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Edit User</h2>
                            <div class="breadcrumb-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                </div>
            </div>
            <div class="content-body">
                <form class="submit-form auth-form" action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body p-1 text-end">
                            <button class="btn btn-primary" type="submit" name="btn" value="save only"><i data-feather="save" class="me-25"></i> Save</button>
                            <button class="btn btn-outline-primary" name="btn" value="save and edit" type="submit"><i data-feather="check" class="me-25"></i> Save & Edit</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-4 col-lg-4">
                            <div class="card card-profile">
                                <img src="{{ asset('adminpanel') }}/images/banner-user.jpg" class="img-fluid card-img-top" alt="Profile Cover Photo" />
                                <div class="card-body">
                                    <div class="profile-image-wrapper">
                                        <div class="profile-image">
                                            <div class="avatar">
                                                <img src="{{ $user->avatar() }}" id="account-upload-img" alt="{{ $user->name }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="account-upload" class="btn btn-sm btn-primary ">Upload</label>
                                        @if ($user->avatar)
                                            <a href="{{ route('users.remove.avatar', $user->id) }}" type="button" id="remove-avatar" class="btn btn-sm btn-outline-primary ">Remove</a>
                                        @endif
                                        <input type="file" name="avatar" id="account-upload" hidden accept="image/*" />
                                        <hr>
                                        <div class="info-container">
                                            <ul class="list-unstyled">
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Verify at:</span>
                                                    <span>{!! $user->email_verified_at ? date('d M Y', strtotime($user->email_verified_at)) : ' <span class="badge bg-light-warning">Unverify</span>' !!}</span>
                                                </li>
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Join:</span>
                                                    <span>{{ $user->created_at->format('d M Y') }}</span>
                                                </li>
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Role:</span>
                                                    {!! $user->role == 'admin' ? '<span class="badge bg-light-danger">Admin</span>' : '<span class="badge bg-light-primary">User</span>' !!}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-8 col-lg-8">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Personal Info</h4>
                                </div>
                                <div class="card-body py-2 my-25">
                                    <div class="row">
                                        <div class="col-12 col-xl-6 col-lg-6 mb-1">
                                            <label class="form-label" for="accountFirstName">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{ old('name') ? old('name') : $user->name }}" />
                                        </div>
                                        <div class="col-12 col-xl-6 col-lg-6 mb-1">
                                            <label class="form-label" for="accountLastName">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{ old('username') ? old('username') : $user->username }}" />
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label class="form-label" for="accountLastName">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') ? old('email') : $user->email }}" />
                                            <small>changing email will require re-verification of new email.</small>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label class="form-label" for="accountLastName">Role</label>
                                            <select class="form-select" name="role" required>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Security</h4>
                                </div>
                                <div class="card-body py-2 my-25">
                                    <div class="row">
                                        <p>Don't fill it if you don't want to change the password.</p>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="account-new-password">New Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" name="new_password" class="form-control" placeholder="Enter new password" autocomplete="new-password" />
                                                <div class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="account-retype-new-password">Retype New Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control" name="confirm-new-password" placeholder="Confirm your new password" autocomplete="new-password" />
                                                <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="fw-bolder">Password requirements:</p>
                                            <ul class="ps-1 ms-25">
                                                <li class="mb-50">Minimum 8 characters long - the more, the better</li>
                                                <li class="mb-50">At least one lowercase character</li>
                                                <li>At least one number, symbol, or whitespace character</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('vendorcss')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
@endsection

@section('vendorjs')
    <script src="{{ asset('adminpanel') }}/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
@endsection

@section('js')
    <script src="{{ asset('adminpanel') }}/tinymce/tinymce.min.js"></script>
    <script>
        $(function() {
            'use strict';

            var pageLoginForm = $('.auth-form');
            if (pageLoginForm.length) {
                pageLoginForm.validate({
                    rules: {
                        'username': {
                            required: true,
                        },
                        'email': {
                            required: true,
                            email: true,
                        },
                        'name': {
                            required: true,
                        },
                        'role': {
                            required: true,
                        },
                        'confirm-new-password': {
                            equalTo: '[name="new_password"]'
                        }
                    }
                });
            }
        });
    </script>
    <script src="{{ asset('adminpanel') }}/js/scripts/forms/form-select2.js"></script>
    <script src="{{ asset('adminpanel/js/byilhamganz.js') }}"></script>
@endsection
