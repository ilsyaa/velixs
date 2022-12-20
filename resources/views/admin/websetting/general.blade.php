@extends('admin.layouts.main')

@section('title', 'Websetting')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Websetting</h2>
                            <div class="breadcrumb-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                </div>
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        {{-- <h4 class="card-title"></h4> --}}
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 'general' ? 'active' : '' }}" id="general-tab-fill" data-bs-toggle="pill" href="#general-fill" aria-expanded="true">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 'style' ? 'active' : '' }}" id="style-tab-fill" data-bs-toggle="pill" href="#style-fill" aria-expanded="true">Style</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 'addons' ? 'active' : '' }}" id="addons-tab-fill" data-bs-toggle="pill" href="#addons-fill" aria-expanded="true">Addons Script</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 'maintenance' ? 'active' : '' }}" id="maintenance-tab-fill" data-bs-toggle="pill" href="#maintenance-fill" aria-expanded="true">Maintenance</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane {{ $tab == 'general' ? 'active' : '' }}" id="general-fill" aria-labelledby="general-tab-fill" aria-expanded="true">
                                <form action="{{ route('websetting.general.update') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="tab" value="general">
                                    <div class="mb-1">
                                        <label class="form-label" for="app_title">App Title</label>
                                        <input class="form-control" type="text" name="app_title" value="{{ old('app_title') ? old('app_title') : $websetting->app_title }}" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="meta_title">Meta Title</label>
                                        <input class="form-control" type="text" name="meta_title" value="{{ old('meta_title') ? old('meta_title') : $websetting->meta_title }}" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="meta_title">Meta Description</label>
                                        <textarea class="form-control" name="meta_description"rows="5">{{ old('meta_description') ? old('meta_description') : $websetting->meta_description }}</textarea>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="meta_title">Meta Keywords</label>
                                        <input class="form-control" type="text" autocomplete="off" name="meta_keywords" value="{{ old('meta_keywords') ? old('meta_keywords') : $websetting->meta_keywords }}" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="meta_title">Meta Author</label>
                                        <input class="form-control" type="text" autocomplete="off" name="meta_author" value="{{ old('meta_author') ? old('meta_author') : $websetting->meta_author }}" />
                                    </div>
                                    <div class="p-1 text-end">
                                        <button class="btn btn-primary" type="submit"><i data-feather="save" class="me-25"></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane {{ $tab == 'style' ? 'active' : '' }}" id="style-fill" aria-labelledby="style-tab-fill" aria-expanded="true">
                                <div class="mb-3"></div>
                                <form action="{{ route('websetting.style.update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="tab" value="style">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-xl-6 col-lg-6">
                                            <div class="card border-1">
                                                <div class="card-header p-1">
                                                    <h4 class="card-title">Logo</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                    <img class="mb-1" src="{{ $websetting->logo() }}" style="height: 60px">
                                                    <input type="file" name="logo" class="form-control">
                                                    <small>Size 60x60</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 col-lg-6">
                                            <div class="card border-1">
                                                <div class="card-header p-1">
                                                    <h4 class="card-title">Favicon</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                    <img class="mb-1" src="{{ $websetting->meta_favicon() }}" style="height: 60px">
                                                    <input type="file" name="meta_favicon" class="form-control">
                                                    <small>Size 32x32</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 col-lg-6">
                                            <div class="card border-1">
                                                <div class="card-header p-1">
                                                    <h4 class="card-title">thumbnail</h4>
                                                </div>
                                                <img class="card-img" src="{{ $websetting->meta_thumbnail() }}">
                                                <div class="card-body text-center">
                                                    <input type="file" name="meta_thumbnail" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb1">
                                                <label class="form-label" for="meta_title">Footer</label>
                                                <input class="form-control" type="text" name="footer" value="{{ old('footer') ? old('footer') : $websetting->footer }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-1 text-end">
                                        <button class="btn btn-primary" type="submit"><i data-feather="save" class="me-25"></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane {{ $tab == 'addons' ? 'active' : '' }}" id="addons-fill" aria-labelledby="addons-tab-fill" aria-expanded="true">
                                <form action="{{ route('websetting.addons.update') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="tab" value="addons">
                                    <div class="mb-1">
                                        <label class="form-label" for="meta_title">Addons Head</label>
                                        <textarea class="form-control" name="addons_head"rows="5">{!! old('addons_head') ? old('addons_head') : $websetting->addons_head !!}</textarea>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="meta_title">Addons Body</label>
                                        <textarea class="form-control" name="addons_body"rows="5">{!! old('addons_body') ? old('addons_body') : $websetting->addons_body !!}</textarea>
                                    </div>
                                    <div class="p-1 text-end">
                                        <button class="btn btn-primary" type="submit"><i data-feather="save" class="me-25"></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane {{ $tab == 'maintenance' ? 'active' : '' }}" id="maintenance-fill" aria-labelledby="maintenance-tab-fill" aria-expanded="true">
                                <form action="{{ route('websetting.maintenance.update') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="tab" value="maintenance">
                                    <div class="mb-1">
                                        <label class="form-label" for="meta_title">Maintenance</label>
                                        <select class="form-select" name="maintenance">
                                            <option value="1" {{ config('app.mt') == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ config('app.mt') == 0 ? 'selected' : '' }}>InActive</option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="meta_title">Message</label>
                                        <textarea class="form-control" id="body" name="maintenance_message"></textarea>
                                    </div>
                                    <div class="p-1 text-end">
                                        <button class="btn btn-primary" type="submit"><i data-feather="save" class="me-25"></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-fm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFullTitle">File Manager</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="content-modal-fm">
                </div>
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
        var loadFile = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        };

        tinymce.init({
            selector: '#body',
            plugins: 'link lists image advlist fullscreen media code table emoticons textcolor hr preview codesample',
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
                    editor.setContent(`{!! old('maintenance_message') ? old('maintenance_message') : $websetting->maintenance_message !!}`);
                });
            },
        });
    </script>
    <script src="{{ asset('adminpanel') }}/js/scripts/forms/form-select2.js"></script>
@endsection
