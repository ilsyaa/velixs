@extends('admin.layouts.main')

@section('title', 'Manage Images for ' . $product->name)

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Images</h2>
                            <div class="breadcrumb-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">For {{ $product->name }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="#" class="dropzone dropzone-area" id="dpz-multiple-files">
                                    <div class="dz-message">Drop files here or click to upload.</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Image</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal fade" id="show" tabindex="-1" aria-labelledby="show" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="preview-show"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendorcss')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/css/plugins/forms/form-file-uploader.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/animate/animate.min.css">
@endsection

@section('js')
    <script src="{{ asset('adminpanel/js/datatables_json.js') }}"></script>
    <script>
        datatables_luxion(
            '.datatables-basic',
            "{!! route('product.images', $product->id . '?type=json') !!}",
            '{{ route('product.images.destroyall') }}',
            [{
                    data: 'responsive_id'
                },
                {
                    data: 'id',
                },
                {
                    data: 'image',
                },
                {
                    data: 'created_at',
                },
                {
                    data: 'action',
                }
            ],
            [{
                text: feather.icons['trash'].toSvg({
                    class: 'me-50 font-small-4'
                }) + 'Delete',
                className: 'btn btn-outline-danger is-button-delete',
            }, {
                text: feather.icons['corner-down-left'].toSvg({
                    class: 'me-50 font-small-4'
                }) + 'Back Products',
                className: 'create-new btn btn-secondary',
                action: function() {
                    window.location = '{{ route('product.index') }}';
                }
            }]
        );


        function imageshow(id) {
            $('#show').modal('show');
            // loading
            $('#preview-show').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            $.ajax({
                url: '{{ route('product.images.show') }}?id=' + id,
                type: 'GET',
                success: function(data) {
                    $('#preview-show').html(data);
                }
            });
        }
    </script>
@endsection

@section('vendorjs')
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/file-uploaders/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#dpz-multiple-files", {
            url: '{{ route('product.images.store', $product->id) }}',
            acceptedFiles: "image/*",
            paramName: 'image',
            params: {
                _token: '{{ csrf_token() }}',
            }
        });

        // dropzone event finished
        myDropzone.on("complete", function(file) {
            myDropzone.removeFile(file);
            $('.datatables-basic').DataTable().ajax.reload();
        });
    </script>
@endsection
