@extends('frontend.layouts.landing')

@section('content')
    @include('frontend.profile.inc_header')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col col-12 col-xl-10">
                <div class="row">
                    <div class="col col-12 col-xl-4">
                        <div class="card border-0 shadow mb-3">
                            <div class="card-body rounded">
                                <small>
                                    <table>
                                        <tr>
                                            <td class="text-muted pe-3 pb-2">Username</td>
                                            <td>{{ $me->username }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted pe-3 pb-2">Role</td>
                                            <td class="text-success">{{ $me->role }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted pe-3 pb-2">Member Since</td>
                                            <td>{{ $me->created_at->format('d M Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted pe-3 pb-2">Last Active</td>
                                            <td>{!! $me->last_activity() == 'online' ? '<span style="color: #4ff461;">Online</span>' : $me->last_activity() !!}</td>
                                        </tr>
                                    </table>
                                </small>
                            </div>
                            <div class="card-footer py-1 d-flex">
                                <div class="me-auto text-muted">
                                    <small id="indicator-loading">Me</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow">
                            <div class="card-body rounded">
                                {!! $about_md !!}
                            </div>
                            <div class="card-footer py-1 d-flex">
                                <div class="me-auto text-muted">
                                    <small>About</small>
                                </div>
                                @if ($auth_user)
                                    @if ($me->id == $auth_user->id)
                                        <small><a class="href" href="{!! route('front.profile.settings') !!}"><i class="bi bi-gear"></i></a></small>
                                    @endif
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
