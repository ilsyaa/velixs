@extends('frontend.layouts.landing')

@section('content')
    @livewire('product-category', ['perpage' => $perpage, 'auth_user' => $auth_user])
    <div class="container container-nav d-flex justify-content-end">
        <div id="change-currency" data-toggle="tooltip" data-placement="top" title="Change currency." class="currency">USD</div>
    </div>
@endsection

@push('js')
    <script src="{!! asset('frontend/landing/vendor/jquery.min.js') !!}"></script>
    <script>
        Livewire.on('refresh_pagination', () => {
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
            set_currency();
        })

        Livewire.on('refresh_render', () => {
            set_currency();
            nanobar.go(100);
        })

        function set_currency() {
            var current_set_forex = localStorage.getItem('current_currency');
            if (current_set_forex == 'USD') {
                show_usd()
                button_currency.innerHTML = "USD";
            } else if (current_set_forex == 'IDR') {
                show_idr()
                button_currency.innerHTML = "IDR";
            }
        }
    </script>
@endpush

@push('css')
    <style>
        .fades {
            opacity: 1;
            animation: fadeIn 2s;
        }

        .fades-load {
            opacity: 1;
            animation: fadeIn 0.7s;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
@endpush
