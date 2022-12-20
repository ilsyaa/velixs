@extends('admin.layouts.main')

@section('title', 'Trash Users')

@section('js')
    <script src="{{ asset('adminpanel/js/datatables_json.js') }}"></script>
    <script>
        datatables_luxion(
            '.datatables-basic',
            '{{ route('users.json', $show) }}',
            '{{ route('users.forcedelete') }}',
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
                    data: 'main',
                },
                {
                    data: 'role'
                },
                {
                    data: 'status'
                },
                {
                    data: 'delete_at'
                },
                {
                    data: 'recovery'
                },
            ],
            [{
                text: feather.icons['trash'].toSvg({
                    class: 'me-50 font-small-4'
                }) + 'Force Delete',
                className: 'btn btn-outline-danger is-button-delete',
            }, {
                text: feather.icons['users'].toSvg({
                    class: 'me-50 font-small-4'
                }) + 'All Users',
                className: 'create-new btn btn-primary',
                action: function() {
                    window.location = '{{ route('users.index') }}';
                }
            }],
            'User List Removed'
        );
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
                            <h2 class="content-header-title float-start mb-0">Manage Recovery</h2>
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
                                            <th>Profile</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Deleted at</th>
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
