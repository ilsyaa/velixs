@extends('admin.layouts.main')

@section('title', 'Add New Product')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Add New Product</h2>
                            <div class="breadcrumb-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                </div>
            </div>
            <div class="content-body">
                <form class="submit-form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body p-1 text-end">
                            <button class="btn btn-primary" type="submit" name="btn" value="save only"><i data-feather="save" class="me-25"></i> Save</button>
                            <button class="btn btn-outline-primary" name="btn" value="save and edit" type="submit"><i data-feather="check" class="me-25"></i> Save & Edit</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-8 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="general-tab-fill" data-bs-toggle="tab" href="#general-fill" role="tab" aria-controls="general-fill" aria-selected="true">General</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="payment-tab-fill" data-bs-toggle="tab" href="#payment-fill" role="tab" aria-controls="payment-fill" aria-selected="true">Payment</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="meta-tab-fill" data-bs-toggle="tab" href="#meta-fill" role="tab" aria-controls="meta-fill" aria-selected="true">Meta</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content pt-1">

                                        <div class="tab-pane active" id="general-fill" role="tabpanel" aria-labelledby="general-tab-fill">
                                            <div class="mb-1">
                                                <label class="form-label" for="title">Name Product</label>
                                                <input class="form-control" type="text" name="name" value="{{ old('name') }}" autofocus />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="title">Slug</label>
                                                <input class="form-control" type="text" name="slug" value="{{ old('slug') }}" />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="title">live preview</label>
                                                <input class="form-control" type="text" name="live_preview" value="{{ old('live_preview') }}" placeholder="url demo" />
                                            </div>

                                            <div class="mb-1">
                                                <textarea name="body" id="body"></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="payment-fill" role="tabpanel" aria-labelledby="payment-tab-fill">
                                            <div class="row custom-options-checkable g-1 mb-1">
                                                <div class="col-md-6">
                                                    <input class="custom-option-item-check" type="radio" name="product_type" id="product_type1" value="pay" {{ old('product_type') ? (old('product_type') == 'pay' ? 'checked' : '') : 'checked' }} />
                                                    <label class="custom-option-item p-1" for="product_type1">
                                                        <span class="d-flex justify-content-between flex-wrap mb-50">
                                                            <span class="fw-bolder">Pay</span>
                                                        </span>
                                                        <small class="d-block">This product will be sold according to the specified nominal.</small>
                                                    </label>
                                                </div>

                                                <div class="col-md-6">
                                                    <input class="custom-option-item-check" type="radio" name="product_type" id="product_type2" value="free" {{ old('product_type') == 'free' ? 'checked' : '' }} />
                                                    <label class="custom-option-item p-1" for="product_type2">
                                                        <span class="d-flex justify-content-between flex-wrap mb-50">
                                                            <span class="fw-bolder">Free</span>
                                                        </span>
                                                        <small class="d-block">All users can claim this license for free.</small>
                                                    </label>
                                                </div>
                                            </div>
                                            <div id='area_price'>
                                                <div class="row">
                                                    <div class="col-12 col-xl-6 col-lg-6">
                                                        <div class="mb-1">
                                                            <label>Price USD</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text">$</span>
                                                                <input type="text" name="price_usd" class="form-control" placeholder="10" value="{{ old('price_usd') }}" autocomplete="off" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6 col-lg-6">
                                                        <div class="mb-1">
                                                            <label>Price IDR</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text">IDR</span>
                                                                <input type="text" name="price_idr" class="form-control" value="{{ old('price_idr') }}" placeholder="10000" autocomplete="off" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6 col-lg-6">
                                                        <div class="mb-1">
                                                            <label>Discount USD</label>
                                                            <div class="input-group input-group-merge">
                                                                <input type="number" name="discount_usd" class="form-control" value="{{ old('discount_usd') }}" placeholder="1-100" autocomplete="off" />
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                            <small>leave blank if you don't give a discount</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6 col-lg-6">
                                                        <div class="mb-1">
                                                            <label>Discount IDR</label>
                                                            <div class="input-group input-group-merge">
                                                                <input type="number" name="discount_idr" class="form-control" value="{{ old('discount_idr') }}" placeholder="1-100" autocomplete="off" />
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                            <small>leave blank if you don't give a discount</small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="meta-fill" role="tabpanel" aria-labelledby="meta-tab-fill">
                                            <div class="text-center">
                                                <p>Save first to edit the meta tag.</p>
                                                <button class="btn btn-outline-primary" name="btn" value="save and edit" type="submit"><i data-feather="check" class="me-25"></i> Save & Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4 col-lg-4">
                            <div class="card">
                                <div class="card-body p-1">
                                    <h5 class="card-title">Categories</h5>
                                    <select class="select2 form-select" name="category" id="select2-basic">
                                        @foreach ($categories as $cat)
                                            <option {{ old('category') == $cat->id ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body p-1">
                                    <img class="card-img mb-1" id="preview" src="https://via.placeholder.com/800x470.png?text=thumbnail" alt="">
                                    <input class="form-control" onchange="loadFile(event)" type="file" name="image" />
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body p-1">
                                    <h5 class="card-title">Tags</h5>
                                    <select class="select2 form-select" id="select2-nested" name="tags[]" multiple>
                                        @foreach ($tags as $tag)
                                            <option {{ old('tags') ? (in_array($tag->id, old('tags')) ? 'selected' : '') : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body p-1">
                                    <h5 class="card-title">Status</h5>
                                    <select class="form-select" name="status">
                                        <option {{ old('status') == 'published' ? 'selected' : '' }} value="published">Published</option>
                                        <option {{ old('status') == 'archived' ? 'selected' : '' }} value="archived">Archived</option>
                                        <option {{ old('status') == 'draft' ? 'selected' : '' }} value="draft">Draft</option>
                                    </select>
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
        var pageLoginForm = $('.submit-form');
        if (pageLoginForm.length) {
            var result = pageLoginForm.validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 5
                    },
                    slug: {
                        required: true
                    },
                    'tags[]': {
                        required: true
                    },
                    'category': {
                        required: true
                    },
                    'discount': {
                        max: 100,
                    },
                    'product_type': {
                        required: true
                    },
                }
            });
        }

        @if (old('product_type') == 'free')
            $('input[name=price_usd]').attr('required', false);
            $('input[name=price_idr]').attr('required', false);
            $('input[name=price_usd]').val();
            $('input[name=price_idr]').val();
            $('input[name=discount_idr]').val();
            $('input[name=discount_usd]').val();
            $('#area_price').hide();
        @endif

        // radio change name product_type
        $('input[type=radio][name=product_type]').change(function() {
            if (this.value == 'free') {
                $('input[name=price_usd]').attr('required', false);
                $('input[name=price_idr]').attr('required', false);
                $('input[name=price_usd]').val();
                $('input[name=price_idr]').val();
                $('input[name=discount_idr]').val();
                $('input[name=discount_usd]').val();
                // hiden
                $('#area_price').hide();
            } else {
                $('input[name=price_usd]').attr('required', true);
                $('input[name=price_idr]').attr('required', true);
                $('#area_price').show();
            }
        });

        $(document).on('keyup', 'input[name="name"]', function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $('input[name="slug"]').val(Text);
        });

        $(document).on('keyup', 'input[name="slug"]', function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $(this).val(Text);
        });

        var loadFile = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        };

        tinymce.init({
            selector: '#body',
            plugins: 'link lists image advlist fullscreen media code table emoticons hr preview codesample',
            height: 400,
            menubar: false,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            toolbar: [
                'formatselect bold italic underline strikethrough forecolor backcolor bullist numlist blockquote subscript superscript alignleft aligncenter alignright alignjustify image media link table hr removeformat preview code codesample fullscreen',
            ],
            codesample_languages: [{
                    text: 'HTML/XML',
                    value: 'html'
                },
                {
                    text: 'JavaScript',
                    value: 'javascript'
                },
                {
                    text: 'CSS',
                    value: 'css'
                },
                {
                    text: 'PHP',
                    value: 'php'
                },
                {
                    text: 'Ruby',
                    value: 'ruby'
                },
                {
                    text: 'Python',
                    value: 'python'
                },
                {
                    text: 'Java',
                    value: 'java'
                },
                {
                    text: 'C',
                    value: 'c'
                },
                {
                    text: 'C#',
                    value: 'csharp'
                },
                {
                    text: 'C++',
                    value: 'cpp'
                }
            ],
            file_picker_callback(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

                tinymce.activeEditor.windowManager.openUrl({
                    url: '{{ route('files.tinymce5') }}',
                    title: 'Laravel File manager',
                    width: x * 1,
                    height: y * 1,
                    onMessage: (api, message) => {
                        callback(message.content, {
                            text: message.text
                        })
                    }
                })
            },
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent(`{!! old('body') !!}`);
                });
            },
        });
    </script>
    <script src="{{ asset('adminpanel') }}/js/scripts/forms/form-select2.js"></script>
@endsection
