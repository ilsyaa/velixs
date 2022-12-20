@extends('admin.layouts.main')

@section('title', 'WebMaster')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">WebMaster</h2>
                            <div class="breadcrumb-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                </div>
            </div>
            <div class="content-body">


                <section id="faq-tabs">
                    <!-- vertical tab pill -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="faq-navigation d-flex justify-content-between flex-column mb-2 mb-md-0">
                                <!-- pill tabs navigation -->
                                <ul class="nav nav-pills nav-left flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ $tab == 'general' ? 'active' : '' }}" data-bs-toggle="pill" href="#general" aria-expanded="false" role="tab">
                                            <i data-feather="settings" class="font-medium-3 me-1"></i>
                                            <span class="fw-bold">General</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ $tab == 'smtp' ? 'active' : '' }}" data-bs-toggle="pill" href="#smtp" aria-expanded="false" role="tab">
                                            <i data-feather="mail" class="font-medium-3 me-1"></i>
                                            <span class="fw-bold">SMTP</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ $tab == 'payment' ? 'active' : '' }}" data-bs-toggle="pill" href="#payment" aria-expanded="false" role="tab">
                                            <i data-feather="credit-card" class="font-medium-3 me-1"></i>
                                            <span class="fw-bold">Payment</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <div class="col-lg-9 col-md-8 col-sm-12">

                            <div class="tab-content">
                                <div class="tab-pane {{ $tab == 'general' ? 'active' : '' }}" id="general" role="tabpanel">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-tag bg-light-primary me-1">
                                            <i data-feather="settings" class="font-medium-4"></i>
                                        </div>
                                        <div>
                                            <h4 class="mb-0">General</h4>
                                            <span>General Webmaster</span>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-margin mt-2">
                                        <div class="card pt-1">
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>General</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('webmaster.general') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="tab" value="general">
                                                    <div class="row">
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">Admin Path</label>
                                                                <input class="form-control" type="text" name="admin_path" value="{{ old('admin_path') ? old('admin_path') : config('app.admin_path') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">Thumbnail size</label>
                                                                <input class="form-control" type="text" name="thumbnail_size" value="{{ old('thumbnail_size') ? old('thumbnail_size') : config('app.thumbnail_width') . 'x' . config('app.thumbnail_height') }}" placeholder="widthxheight" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">Active User Interval</label>
                                                                <input class="form-control" type="number" name="active_user_interval" value="{{ old('active_user_interval') ? old('active_user_interval') : config('app.active_user_interval') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">Prefix License</label>
                                                                <input class="form-control" type="text" name="prefix_license" value="{{ old('prefix_license') ? old('prefix_license') : config('app.prefix_license') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">Proudcts Perpage</label>
                                                                <input class="form-control" type="number" name="product_perpage" value="{{ old('product_perpage') ? old('product_perpage') : config('app.product_page') }}" placeholder="interval user active" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">Blogs Perpage</label>
                                                                <input class="form-control" type="number" name="blog_perpage" value="{{ old('blog_perpage') ? old('blog_perpage') : config('app.blog_page') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-1 text-end">
                                                        <button class="btn btn-primary" type="submit"><i data-feather="save" class="me-25"></i> Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane {{ $tab == 'smtp' ? 'active' : '' }}" id="smtp" role="tabpanel">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-tag bg-light-primary me-1">
                                            <i data-feather="mail" class="font-medium-4"></i>
                                        </div>
                                        <div>
                                            <h4 class="mb-0">SMTP</h4>
                                            <span>SMTP Configuration</span>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-margin mt-2">
                                        <div class="card pt-1">
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>SMTP Mail</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('webmaster.smtp') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="tab" value="smtp">
                                                    <div class="row">
                                                        <div class="col-12 col-xl-4 col-lg-4">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="MAIL DRIVER">MAIL DRIVER</label>
                                                                <select class="form-select" name="mail_driver">
                                                                    <option value="smtp">SMTP</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">MAIL HOST</label>
                                                                <input class="form-control" type="text" name="mail_host" value="{{ old('mail_host') ? old('mail_host') : config('mail.mailers.smtp.host') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-2 col-lg-2">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">MAIL PORT</label>
                                                                <input class="form-control" type="number" name="mail_port" value="{{ old('mail_port') ? old('mail_port') : config('mail.mailers.smtp.port') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">MAIL USERNAME</label>
                                                                <input class="form-control" type="text" name="mail_username" value="{{ old('mail_username') ? old('mail_username') : config('mail.mailers.smtp.username') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">MAIL PASSWORD</label>
                                                                <input class="form-control" type="text" name="mail_password" value="{{ old('mail_password') ? old('mail_password') : config('mail.mailers.smtp.password') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="MAIL DRIVER">MAIL ENCRYPTION</label>
                                                                <select class="form-select" name="mail_encryption">
                                                                    <option value="tls" {{ config('mail.mailers.smtp.encryption') == 'tls' ? 'selected' : '' }}>TLS</option>
                                                                    <option value="ssl" {{ config('mail.mailers.smtp.encryption') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="meta_title">MAIL FROM</label>
                                                                <input class="form-control" type="text" name="mail_from_address" value="{{ old('mail_from_address') ? old('mail_from_address') : config('mail.from.address') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-1 text-end">
                                                        <a href="{{ route('webmaster.test.smtp') }}" class="btn btn-success"><i data-feather="mail" class="me-25"></i> Send Test Email</a>
                                                        <button class="btn btn-primary" type="submit"><i data-feather="save" class="me-25"></i> Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane {{ $tab == 'payment' ? 'active' : '' }}" id="payment" role="tabpanel">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-tag bg-light-primary me-1">
                                            <i data-feather="credit-card" class="font-medium-4"></i>
                                        </div>
                                        <div>
                                            <h4 class="mb-0">Payment</h4>
                                            <span>Settings payment system.</span>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-margin mt-2">
                                        <form action="{{ route('webmaster.payment') }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="card pt-2">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Payment Whatsapp Direct</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-1">
                                                        <label class="form-label">Whatsapp Number</label><br><small>don't fill in the number if you want to disable whatsapp payments</small>
                                                        <input class="form-control" type="text" name="whatsapp" value="{{ old('whatsapp') ? old('whatsapp') : $webmaster->payment_whatsapp }}" placeholder="code region ex(62)" />
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label">Message</label>
                                                        <textarea class="form-control" name="whatsapp_message" rows="7">{!! old('whatsapp_message') ? old('whatsapp_message') : $webmaster->payment_whatsapp_message !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Paypal Gateway</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label">PayPal Status</label>
                                                                <select class="form-select" name="paypal_status">
                                                                    <option {{ $webmaster->paypal_status == 'active' ? 'selected' : '' }} value="active">Active</option>
                                                                    <option {{ $webmaster->paypal_status == 'inactive' ? 'selected' : '' }} value="inactive">InActive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label">PayPal Mode</label>
                                                                <select class="form-select" name="paypal_mode">
                                                                    <option {{ $webmaster->paypal_mode == 'sandbox' ? 'selected' : '' }} value="sandbox">Sandbox</option>
                                                                    <option {{ $webmaster->paypal_mode == 'live' ? 'selected' : '' }} value="live">Live</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label">SANDBOX CLIENT ID</label>
                                                                <input class="form-control" type="text" name="sandbox_client_id" value="{!! old('sandbox_client_id') ? old('sandbox_client_id') : $webmaster->paypal_sandbox_client_id !!}" autocomplete="off" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label">SANDBOX CLIENT SECRET</label>
                                                                <input class="form-control" type="text" name="sandbox_client_secret" value="{!! old('sandbox_client_secret') ? old('sandbox_client_secret') : $webmaster->paypal_sandbox_client_secret !!}" autocomplete="off" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label">LIVE CLIENT ID</label>
                                                                <input class="form-control" type="text" name="live_client_id" value="{!! old('live_client_id') ? old('live_client_id') : $webmaster->paypal_live_client_id !!}" autocomplete="off" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 col-lg-6">
                                                            <div class="mb-1">
                                                                <label class="form-label">LIVE CLIENT SECRET</label>
                                                                <input class="form-control" type="text" name="live_client_secret" value="{!! old('live_client_secret') ? old('live_client_secret') : $webmaster->paypal_live_client_secret !!}" autocomplete="off" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-1 text-end">
                                                        <button class="btn btn-primary" type="submit"><i data-feather="save" class="me-25"></i> Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
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
    <script src="{{ asset('adminpanel') }}/js/scripts/forms/form-select2.js"></script>
@endsection
