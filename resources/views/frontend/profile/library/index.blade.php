@extends('frontend.layouts.landing')

@section('content')
    @include('frontend.profile.inc_header')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col col-12 col-xl-10">

                @foreach ($library->get() as $row)
                    <div class="card mb-3 border-0 shadow">
                        <div class="card-body card-library rounded">
                            <img class="rounded me-3 image-library" src="{!! $row->product->_thumbnail() !!}">
                            <div class="d-block">
                                <h6>{{ $row->product->name }}</h6>
                                <div>
                                    <small class="text-muted">License <small class="text-success">{{ $row->license }}</small></small>
                                </div>
                                <div>
                                    <small class="text-muted">Payment
                                        <small class="text-light">
                                            @if ($row->payment_method() == 'license')
                                                LICENSE
                                            @elseif ($row->payment_method() == 'free')
                                                <span style="color: #07f832;">FREE</span>
                                            @else
                                                {{ Str::upper($row->payment_method()) }}
                                            @endif
                                        </small>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer footer-library d-flex">
                            <div class="me-auto">
                                <small class="text-muted">{{ $row->created_at->format('d M Y') }}</small>
                            </div>
                            <a href="{!! route('front.product.detail', $row->product->slug) !!}" class="href text-muted">view</a>
                            <small class="text-muted mx-2"></small>
                            <a href="javascript:void(0)" onclick="modaledit('{{ $row->id }}')" data-bs-toggle="modal" data-bs-target="#modal-download" class="href text-muted"><i class="bi bi-download"></i> Download</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col"></div>
        </div>
    </div>

    <div class="modal fade" id="modal-download" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-dark">
                <div id="content-download">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('frontend/landing/vendor/jquery.min.js') }}"></script>
    <script>
        var modal_download = document.getElementById('content-download');

        function modaledit(id) {
            modal_download.innerHTML = '<div class="modal-body p-0 border-0" style="max-height: 400px"><div class="text-center my-5"><i style="font-size: 40px" class="bi bi-app-indicator"></i><h6>Wait a moment...</h6></div></div><div class="modal-footer footer-search"><div class="me-auto"><span class="text-muted" style="margin-right: 5px;"><i class="bi bi-arrow-down-up"></i> <span id="keterangan-footer" >Checking Data</span></span></div><div class="spinner-grow" style="height: 10px; width: 10px" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            $.get('{{ route('front.library.download') }}?id=' + id, function(data) {
                modal_download.innerHTML = data;
            });
        }
    </script>
@endpush
