@extends('admin.layouts.main')

@section('title', $title)

@section('js')
    <script src="{{ asset('adminpanel/js/datatables_json.js') }}"></script>
    <script>
        $(".title-input").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $(".slug-input").val(Text);
        });

        $(".slug-input").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $(".slug-input").val(Text);
        });

        datatables_luxion(
            '.datatables-basic',
            '{{ route('categories.json', $type) }}',
            '{{ route('categories.destroyall') }}',
            [{
                    data: 'responsive_id'
                },
                {
                    data: 'id',
                },
                {
                    data: 'id'
                },
                {
                    data: 'image',
                },
                {
                    data: 'title'
                },
                {
                    data: 'slug'
                },
                {
                    data: 'type'
                },
                {
                    data: 'action'
                }
            ]
        );

        function modaledit(id) {
            $('#contenteditmodal').html('<div class="modal-body"><div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div></div>');
            $.ajax({
                url: `{{ route('categories.edit', 'id') }}`.replace('id', id),
                type: "GET",
                success: function(data) {
                    $('#contenteditmodal').html(data);
                }
            });
        }
    </script>
@endsection




@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{ $title }}</h2>
                            <div class="breadcrumb-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                </div>
            </div>
            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalsaddnew" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-1">
                                            <label class="form-label" for="basicInput">Name</label>
                                            <input type="text" class="form-control title-input" id="title" name="title" placeholder="Name Category" />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basicInput">Slug</label>
                                            <input type="text" class="form-control slug-input" name="slug" id="slug" />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basicInput">Image <small>size 284x142</small></label>
                                            <input type="file" name="image" class="form-control" id="image" name="image" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div id="contenteditmodal"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@section('vendorcss')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/animate/animate.min.css">
@endsection

@section('vendorjs')
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

@endsection
