<div class="bg-head">
    <div class="text-light" style="background-image: linear-gradient(164deg, #040cff14 0%, #0b1120e6 50%);">
        <div class="container py-5">
            <div class="row">
                <div class="col"></div>
                <div class="col col-12 col-xl-10">
                    <div class="card border-0 shadow">
                        <div class="card-body rounded card-profile-me">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-change-profile" class="hover-change-profile">
                                <div class="profilepic">
                                    <img class="profilepic__image " src="{{ $me->avatar() }}" alt="{{ $me->username }}" />
                                    <div class="profilepic__content">
                                        <span class="profilepic__icon"><i class="bi bi-camera"></i></span>
                                        <span class="profilepic__text">Change Avatar</span>
                                    </div>
                                </div>
                            </a>
                            <div class="d-block margin-title__asu_terserah">
                                <h4 class="fw-bold text-slow">{{ $me->name }} {!! $me->IsVerify('font-size: 20px;') !!}</h4>
                                <h6 class="text-slow">{{ $me->username }}</h6>
                            </div>
                        </div>
                        <div class="card-footer py-1 d-flex">
                            <div class="me-auto text-muted">
                                <small id="indicator-loading">Profile</small>
                            </div>
                            @if ($auth_user)
                                @if ($me->id == $auth_user->id)
                                    <button type="submit" style="background: none; border:none;"><small class="text-muted"><i class="bi bi-gear"></i></small></button>
                                @endif
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
</div>

<div class="sub-head py-3 mb-0">
    <div class="container d-flex align-items-center">
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <div class="col"></div>
        <div class="col col-12 col-xl-10">
            @if ($auth_user)
                @if ($auth_user->id == $me->id)
                    <div class="card menu-profile shadow mb-3">
                        <a href="{{ route('front.profile.index', $me->username) }}" class="{{ Route::is('front.profile.index') ? 'active' : '' }} btn rounded-0 px-4 m-1 btn-menu-profile text-light"><i class="icon-profile bi bi-person-circle"></i></a>
                        <a href="{{ route('front.library.index') }}" class="{{ Route::is('front.library.index') ? 'active' : '' }} btn rounded-0 px-4 m-1 btn-menu-profile text-light"><i class="icon-profile bi bi-wallet2"></i></a>
                        <a href="{{ route('front.profile.settings') }}" class="{{ Route::is('front.profile.settings*') ? 'active' : '' }} btn rounded-0 px-4 m-1 btn-menu-profile text-light"><i class="icon-profile bi bi-gear"></i></a>
                    </div>
                @endif
            @endif
        </div>
        <div class="col"></div>
    </div>
</div>

<div class="modal fade" id="modal-change-profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-dark">
            <div class="modal-header">

            </div>
            <form action="{!! route('front.profile.settings.update', 'avatar') !!}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-0 border-0">
                    <div class="text-center py-5">
                        <div class="profilepic">
                            <img class="profilepic__image live-preview" src="{{ $me->avatar() }}" />
                            <div class="profilepic__content">
                                <span class="profilepic__icon"><i class="bi bi-cloud-arrow-up"></i></span>
                                <span class="profilepic__text">Upload</span>
                            </div>
                            <input type="file" name="avatar" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer footer-search">
                    <div class="me-auto">
                        <span class="text-muted" style="margin-right: 5px;"><i class="bi bi-person-circle"></i> Change Avatar</span>
                    </div>
                    <button type="submit" class="btn btn-dark btn-sm">Change Avatar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        var input = document.querySelector('input[name=avatar]');
        var preview = document.querySelector('.live-preview');
        input.onchange = evt => {
            const [file] = input.files
            if (!file.type.startsWith('image/')) {
                input.value = null
                return siiimpleToast.message('<i class="bi bi-exclamation-circle"></i> The file must be an image.', {
                    position: "bottom|left",
                    margin: 12,
                    delay: 0,
                    duration: 5000,
                });
            }
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
