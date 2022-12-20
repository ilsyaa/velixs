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
                                <div class="id">
                                    @if (!$me->whatsapp)
                                        <p>Untuk integrasi <span class="text-success">{{ $websetting->app_title }}</span> yang mudah dengan whatsapp, Anda cukup mengetikkan kode ini di bot <a class="href text-success" target="_blank" href="{!! $webmaster->whatsapp_integration("$me->username-" . hash('ripemd160', $me->username . $me->password)) !!}">whatsapp resmi kami</a>.</p>
                                        <pre class="language-javascript"><code>WHATSAPP BOT : 6285745876650
Command : /verify admin-479337b84fc4ba0ab4a4399fe68d658c5c07ab5b</code></pre>
                                        <p>Anda dapat mengirimkan perintah ke nomor bot whatsapp di atas atau Anda dapat menekan tombol Connect To Whatsapp yang berwarna hijau.</p>
                                    @else
                                        <div class="text-center">
                                            <p class="btn btn-outline-success btn-sm"><i class="bi bi-link-45deg"></i> WhatsApp is connected {{ $me->whatsapp }}</p>
                                        </div>
                                        <p>Untuk memutuskan whatsapp dari akun Anda, cukup kirimkan perintah bot seperti di bawah ini atau tekan tombol Disconnect from whatsapp.</p>
                                        <pre class="language-javascript"><code>WHATSAPP BOT : 6285745876650
Command : /unverify yourpassword</code></pre>
                                    @endif
                                </div>
                                <div class="en">
                                    @if (!$me->whatsapp)
                                        <p>For easy integration of <span class="text-success">{{ $websetting->app_title }}</span> with whatsapp you can simply type this code in our <a class="href text-success" target="_blank" href="{!! $webmaster->whatsapp_integration("$me->username-" . hash('ripemd160', $me->username . $me->password)) !!}">official whatsapp bot</a> .</p>
                                        <pre class="language-javascript"><code>WHATSAPP BOT : 6285745876650
Command : /verify admin-479337b84fc4ba0ab4a4399fe68d658c5c07ab5b</code></pre>
                                        <p>You can send the command to the whatsapp bot number above or you can press the green Connect To Whatsapp button.</p>
                                    @else
                                        <div class="text-center">
                                            <p class="btn btn-outline-success btn-sm"><i class="bi bi-link-45deg"></i> WhatsApp is connected {{ $me->whatsapp }}</p>
                                        </div>
                                        <p>To disconnect whatsapp from your account, just send the bot command as below or press the button Disconnect from whatsapp.</p>
                                        <pre class="language-javascript"><code>WHATSAPP BOT : 6285745876650
Command : /unverify yourpassword</code></pre>
                                    @endif
                                </div>
                                <form action="{!! route('front.profile.settings.update', 'whatsapp') !!}" method="post">
                                    @csrf
                                    <div class="text-end">
                                        @if (!$me->whatsapp)
                                            <a target="_blank" href="{!! $webmaster->whatsapp_integration("$me->username-" . hash('ripemd160', $me->username . $me->password)) !!}" class="btn btn-success shadow"><i style="font-size: 14px" class="bi bi-whatsapp"></i> Connect To Whatsapp</a>
                                        @else
                                            <button type="submit" class="btn btn-dark shadow"><i style="font-size: 14px" class="bi bi-wifi-off"></i> Disconnect From Whatsapp</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer py-1 d-flex">
                                <div class="me-auto"><a href="javascript:void(0)" class="bahasa href text-muted">EN</a></div>
                                <small class="text-muted">Whatsapp Integration</small>
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
    <link rel="stylesheet" href="{{ asset('frontend') }}/vendor/highlight/styles/base16/dracula.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/vendor/highlight/highlightjs-copy.min.css" />
    <style>
        .btn-setting-profile:hover {
            margin-left: 10px;
            color: rgb(30, 255, 0);
        }

        .btn-setting-profile {
            transition: 0.5s;
            font-size: 15px;
        }

        .hljs {
            background: #0b1120;
            border: 1px solid #1e293b;
            border-radius: 5px
        }
    </style>
@endpush

@push('js')
    <script src="{!! asset('frontend/landing/vendor/jquery.min.js') !!}"></script>
    <script src="{{ asset('frontend') }}/vendor/highlight/highlight.min.js"></script>
    <script src="{{ asset('frontend') }}/vendor/highlight/highlightjs-copy.min.js"></script>
    <script>
        hljs.highlightAll();
        hljs.addPlugin(new CopyButtonPlugin());

        var btn_change_lang = $('.bahasa');
        var text_id = $('.id');
        var text_en = $('.en');

        text_en.show();
        text_id.hide();

        btn_change_lang.click(function() {
            if (btn_change_lang.hasClass('lol')) {
                btn_change_lang.removeClass('lol');
                btn_change_lang.addClass('lol2');
                btn_change_lang.text('EN');
                text_en.show();
                text_id.hide();
            } else {
                btn_change_lang.removeClass('lol2');
                btn_change_lang.addClass('lol');
                btn_change_lang.text('ID');
                text_en.hide();
                text_id.show();
            }
        });
    </script>
@endpush
